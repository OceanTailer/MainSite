<?php

class Inventories extends CI_Model {
    //including country tables info and crud

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function listing_scale()
    {
    	$this->db->select('*');  
    	$result = $this->db->get('scale');
    	return $result->result();
    }

    function add($data)
    {
        $this->db->insert('inventory',$data);
        return $this->db->insert_id();
    }

    function update($data,$id,$where)
    {
        $this->db->where($where, $id);
        $this->db->update('inventory', $data);
    }

    function delete($where,$value)
    {
        $this->db->like($where,$value);
        $this->db->delete('inventory');
        return true;
    }

    function detail($id)
    {
        $this->db->select('*');
        $this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English
        $this->db->where('inventory.i_id', $id);
        $result = $this->db->get('inventory');
        
        if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
    }

    function total_quantity($i_id)
    {
        $this->db->select('ic_quan');
        $this->db->where('i_id', $i_id);
        $result = $this->db->get('inventory_child');

        $result = $result->result();
        $quan = 0;
        foreach($result as $row)
        {
            $quan += $row->ic_quan;
        }

        return $quan;
    }

    function range_price($i_id)
    {
        $this->db->select('ic_price');
        $this->db->where('i_id', $i_id);
        $this->db->order_by('ic_price', 'asc');
        $result = $this->db->get('inventory_child');

        $result = $result->result();

        if(count($result) == 0)
            return 'N/A';
        elseif(count($result) == 1)
            return $result[0]->ic_price;
        else
            return $result[0]->ic_price.' ~ '.$result[1]->ic_price;
    }

    function add_image($data)
    {
        $this->db->insert('inventory_image',$data);
        return $this->db->insert_id();
    }

    function list_image($id, $limit ="",$featured = false)
    {
        $this->db->select('*');
        $this->db->where('i_id', $id);
        if($limit != "")
        {
            $this->db->limit($limit);
        }
        if($featured)
        {
            $this->db->where('ii_feat', 1);
        }
        $result = $this->db->get('inventory_image');

        return $result->result();
    }

    function listings($name = '',$manu = '',$brand = '',$ucp_ean = '',$manunum = '')
    {
        $this->db->select('*');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        if($name != "")
            $this->db->like('tr_title', $name);

        if($manu != "")
            $this->db->like('manufacturer.m_name', $manu);

        if($brand != "")
            $this->db->like('brand.b_name', $brand);

        if($ucp_ean != "")
            $this->db->where('ucp_ean', $ucp_ean);

        if($manunum != "")
            $this->db->where('manuf_num', $manunum);

        $this->db->group_by('inventory.i_id');

        $result = $this->db->get('inventory');

        return $result->result();
    }

    function listings_advance($where = "")
    {
        $this->db->select('*');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        if($where != "")
            $this->db->where($where);

        $this->db->group_by('inventory.i_id');

        $result = $this->db->get('inventory');

        return $result->result();
    }

    function search_forAddProduct($search_value, $only_product_name = false)
    {
        if ($only_product_name)
             $this->db->select('tr_title, inventory.i_id');
        else
            $this->db->select('*');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->or_like('ucp_ean', $search_value);

        $this->db->or_like('manuf_num', $search_value);

        $this->db->or_like('tr_title', $search_value);

        $this->db->group_by('inventory.i_id');

        $result = $this->db->get('inventory');

        return $result->result();
    }

    function search_forProductSearch($search_value, $only_product_name = false, $cats, $manus,$from,$to, $supplier = "")
    {
        if ($only_product_name)
             $this->db->select('tr_title, inventory.i_id');
        else
            $this->db->select('*');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('inventory', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        

/*        $this->db->or_like('ucp_ean', $search_value);

        $this->db->or_like('manuf_num', $search_value);*/

        if($from != '' && $to != '')
               $this->db->where('ic_price BETWEEN '.$from.' AND '.$to.'');

        if($supplier != '')
        {
             $this->db->where('inventory_child.u_id', $supplier);
        }

        $this->db->like('tr_title', $search_value);
        $cat_where_string = '';
        $manu_where_string = '';
        if(is_array($cats))
        {

            $cat_where_string = '(';
            $cat_counter = 0;
            foreach($cats as $cat)
            {   
                if($cat_counter == 0)
                    $cat_where_string .= 'inventory.c_id = '.$cat;
                else
                     $cat_where_string .= ' OR inventory.c_id = '.$cat;
                $cat_counter++;
            }

             $cat_where_string .= ')';


            $this->db->where($cat_where_string);
        }

        if(is_array($manus))
        {

            $manu_where_string = '(';
            $manu_counter = 0;
            foreach($manus as $manu)
            {   
                if($manu_counter == 0)
                    $manu_where_string .= 'inventory.m_id = '.$manu;
                else
                     $manu_where_string .= ' OR inventory.m_id = '.$manu;
                $manu_counter++;
            }

             $manu_where_string .= ')';


            $this->db->where($manu_where_string);
        }

        $this->db->group_by('inventory.i_id');

        $result = $this->db->get('inventory_child');

        //echo $this->db->last_query();

        return $result->result();
    }

    function search_forPriceRange($from , $to, $cats, $manus)
    {
        $this->db->select('*');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('inventory', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->where('ic_price BETWEEN '.$from.' AND '.$to.'');

        $cat_where_string = '';
        $manu_where_string = '';
        if(is_array($cats))
        {

            $cat_where_string = '(';
            $cat_counter = 0;
            foreach($cats as $cat)
            {   
                if($cat_counter == 0)
                    $cat_where_string .= 'inventory.c_id = '.$cat;
                else
                     $cat_where_string .= ' OR inventory.c_id = '.$cat;
                $cat_counter++;
            }

             $cat_where_string .= ')';


            $this->db->where($cat_where_string);
        }

        if(is_array($manus))
        {

            $manu_where_string = '(';
            $manu_counter = 0;
            foreach($manus as $manu)
            {   
                if($manu_counter == 0)
                    $manu_where_string .= 'inventory.m_id = '.$manu;
                else
                     $manu_where_string .= ' OR inventory.m_id = '.$manu;
                $manu_counter++;
            }

             $manu_where_string .= ')';


            $this->db->where($manu_where_string);
        }

        $this->db->group_by('inventory.i_id');
        
        $result = $this->db->get('inventory_child');
       // echo $this->db->last_query();
        return $result->result();
    }

    function add_product_translation($data)
    {
        $this->db->insert('translation', $data);
        return $this->db->insert_id();
    }

    function list_product_translation($id)
    {
        $this->db->select('*');
        $this->db->where('i_id', $id);
        $this->db->join('country', 'country.c_id = translation.c_id', 'left');

        $result = $this->db->get('translation');

        return $result->result();

    }

    function update_featured_image($data_remove_set,$data_new_set,$id_sel,$product_id){

        $this->db->where('i_id', $product_id);
        $this->db->update('inventory_image', $data_remove_set);


        $this->db->where('ii_id', $id_sel);
        $this->db->update('inventory_image', $data_new_set);
    }

    function delete_image($ii_id)
    {
        $this->db->where('ii_id',$ii_id);
        $this->db->delete('inventory_image');
        return 1;
    }

    function translation_detail($tr_id)
    {
        $this->db->select('*');
        $this->db->where('tr_id',$tr_id);
        $result = $this->db->get('translation');

        if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
    }

    function update_translation($array_update,$tr_id)
    {
        $this->db->where('tr_id',$tr_id);
        $this->db->update('translation', $array_update);
    }

    function translation_delete($tr_id)
    {
        $this->db->where('tr_id', $tr_id);
        $this->db->delete('translation');
    }

    function add_stock($data)
    {
        $this->db->insert('inventory_child',$data);
        return $this->db->insert_id();
    }

    function update_stock($data,$where,$value)
    {
        $this->db->where($where, $value);
        $this->db->update('inventory_child',$data);
    }

    function list_translation_product($i_id, $field = "*")
    {
        $this->db->select($field);
        $this->db->where('i_id', $i_id);
        $this->db->join('country', 'country.c_id = translation.c_id', 'left');
        $result = $this->db->get('translation');

        return $result->result();
    }    
}

?>