<?php

class Categories extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function listings($lvl = "",$parent = "")
    {
        $this->db->select('*');
        $this->db->like('c_level',$lvl);

        if($parent != "")
            $this->db->like('c_parent',$parent);
        $result = $this->db->get('category');

        return $result->result();
    }

    function listings_by_product($search_value)
    {
        $this->db->select('category.c_id, category.c_name');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->or_like('ucp_ean', $search_value);

        $this->db->or_like('manuf_num', $search_value);

        $this->db->or_like('tr_title', $search_value);

        $this->db->group_by('category.c_id');

        $result = $this->db->get('inventory');

        return $result->result();
    }

    function listings_by_priceRange($from,$to)
    {
        $this->db->select('category.c_id, category.c_name');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('inventory', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->where('ic_price BETWEEN '.$from.' AND '.$to.'');

        $this->db->group_by('category.c_id');

        $result = $this->db->get('inventory_child');

        return $result->result();
    }


    function detail($id)
    {
        $this->db->select('*');
        $this->db->where('c_id',$id);
        $result = $this->db->get('category');

         if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
    }

    function add($data)
    {
        $this->db->insert('category', $data);
    }

    function listing_subcategory($category)
    {
        $this->db->select('*');
        $this->db->where('c_parent', $category);
        $result = $this->db->get('category');

        return $result->result();
    }

    function delete($by,$catid)
    {
        $this->db->where($by, $catid);
        $this->db->delete('category');
        return true;
    }

    function update($array_update,$where,$value)
    {
        $this->db->where($where,$value);
        $this->db->update('category',$array_update);
        return true;
    }

    function scale_dimension_listing()
    {
        $this->db->select('*');
        $result = $this->db->get('scale_dimension');

        return $result->result();
    }

    function create_breadcrumb($id, $level,$link = false)
    {
        $category = $id;
        $level = $level;

        $breadcrumb = "";

        $cat_sel = $this->categories->detail($category);
        $breadcrumb = $cat_sel->c_name;
        //echo print_r($cat_sel);
        $category = $cat_sel->c_parent;

        if(!$link)
        {
            for($i = $cat_sel->c_level; 0 < $i; $i--)
            {
                $result = $this->categories->detail($category);
                $breadcrumb = $result->c_name.">".$breadcrumb;
                $category = $result->c_parent;
            }

            echo $breadcrumb;
        }
        else
        {
            for($i = $cat_sel->c_level; 0 < $i; $i--)
            {
                $result = $this->categories->detail($category);
                if($i == 0)
                    $breadcrumb = $result->c_name.">".$breadcrumb;
                else
                {   $link_result = $this->category_product_link($result->c_id, $result->c_level);
                    $breadcrumb = "<a href='".base_url().$link_result."'>".$result->c_name."</a>>".$breadcrumb;
                }
                $category = $result->c_parent;
            }

            return $breadcrumb;
        }
    }

    function category_product_link($c_id, $lvl)
    {
        $cat_sel = $this->categories->detail($c_id);
        $link = $cat_sel->c_link;

        $category = $cat_sel->c_parent;

        for($i = $cat_sel->c_level; 0 < $i; $i--)
        {
            $result = $this->categories->detail($category);
            $link = $result->c_link."/".$link;
            $category = $result->c_parent;
        }

        return "category/info/".$lvl."/".$link;
    }

    function attached_product($c_id)
    {

            $this->db->select('c_id');
            $this->db->where('c_parent', $c_id);
            $result_cat = $this->db->get('category');

            $result_cat =  $result_cat->result();

            if(count($result_cat) == 0)
                return 0;
            else
            {
                for($i = 0; $i < count($result_cat); $i++)
                {
                    $this->db->select('c_id');
                    $this->db->where('c_id', $result_cat[$i]->c_id);
                    $count_inventory = $this->db->get('inventory');

                    $count_inventory = $count_inventory->result();
                    return count($count_inventory) + $this->attached_product($result_cat[$i]->c_id);
                }
            }

        // WTF RECURSION WIN!
    }

    function url_convert($link)
    {
       $link = str_replace(" ","-",$link);
       $link = str_replace(",","",$link);
       $link = str_replace("'","",$link);
       $link = str_replace("\"","",$link);
       return strtolower($link);
    }

    function get_category_id_linked($links)
    {
        $level = 0;

        $sel_c_id = "";
        foreach($links as $link)
        {
            $this->db->select('c_id, c_parent');
            $this->db->where('c_link',$link);
            $this->db->where('c_level', $level);

            if($sel_c_id != "")
                $this->db->where('c_parent', $sel_c_id);

            $result_link = $this->db->get('category');

            if($result_link->num_rows() == 1)
            { 
                $result_link =  $result_link->row(1);
                $level += 1;
                $sel_c_id = $result_link->c_id;
            }
        }

        return $sel_c_id;      
    }


    function generate_link_fill_db()
    {
        $this->db->select('*');
        $result = $this->db->get('category');

        $result = $result->result();

        foreach($result as $row)
        {
            $name_to_link = $this->url_convert($row->c_name);

            $update_data =  array('c_link' => $name_to_link);

            $this->db->where('c_id', $row->c_id);
            $this->db->update('category',$update_data);

        }
    } 

}

?>