<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Logs'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_GET['page']) && (int) $_GET['page'] != 0) {
	$page = (int) $_GET['page'];
}
else {
	$page = 1;
}

$get_array = array();

$get_array['limit']	= 50;

$page_array_temp 			= paging_start(array('page' => $page, 'limit' => $get_array['limit']));
$get_array['offset'] 		= $page_array_temp['offset'];

if (isset($_GET['filter'])) {
	if (isset($_GET['event_severity']) && !empty($_GET['event_severity'])) {
		$get_array['event_severity'] = $_GET['event_severity'];
	}
	if (isset($_GET['event_source']) && !empty($_GET['event_source'])) {
		$get_array['event_source'] = $_GET['event_source'];
	}
}

$logs_array = $log->get($get_array);

$page_array 				= paging_finish(array('events' => count($logs_array), 'limit' => $get_array['limit'], 'next_page' => $page_array_temp['next_page']));
$next_page 					= $page_array['next_page'];
$previous_page 				= $page_array_temp['previous_page'];

$page_url 		= $config->get('address') 	. '/logs/' . '?filter=&amp;limit=' . (int)$get_array['limit'];
			
if (isset($_GET['event_severity']) && !empty($_GET['event_severity'])) {
	$page_url .= '&amp;event_severity=' . safe_output($_GET['event_severity']);
}		
if (isset($_GET['event_source']) && !empty($_GET['event_source'])) {
	$page_url .= '&amp;event_source=' . safe_output($_GET['event_source']);
}
				
$page_previous 	= $page_url . '&amp;page=' . (int)$previous_page;
$page_next 		= $page_url . '&amp;page=' . (int)$next_page;

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="password-details" class="widget">
			<h2><?php echo safe_output($language->get('Logs')); ?></h2>
			<br />
		</div>
		
		<div id="filter-details" class="widget">
			<form method="get" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">
				<p class="label short"><?php echo safe_output($language->get('Severity')); ?></p>
				
				<p class="result">
				<select name="event_severity">
					<option value=""></option>
					<option value="notice"<?php if (isset($get_array['event_severity']) && ($get_array['event_severity'] == 'notice')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Notice')); ?></option>
					<option value="warning"<?php if (isset($get_array['event_severity']) && ($get_array['event_severity'] == 'warning')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Warning')); ?></option>
					<option value="error"<?php if (isset($get_array['event_severity']) && ($get_array['event_severity'] == 'error')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Error')); ?></option>
				</select>
				</p>
				<div class="clear"></div>

				<p class="label short"><?php echo safe_output($language->get('Source')); ?></p>
				<p class="result">
				<select name="event_source">
					<option value=""></option>
					<option value="auth"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'auth')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Authentication')); ?></option>
					<option value="cron"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'cron')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Cron')); ?></option>
					<option value="mailer"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'mailer')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Email')); ?></option>
					<option value="pop_system"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'pop_system')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('POP3')); ?></option>
					<option value="storage"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'storage')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Storage')); ?></option>
					<option value="tickets"<?php if (isset($get_array['event_source']) && ($get_array['event_source'] == 'tickets')) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Tickets')); ?></option>
				</select>
				</p>
				
				<div class="clear"></div>
					
				<br />
				<div class="right"><p><button type="submit" name="filter" class="grey"><?php echo safe_output($language->get('Filter')); ?></button> <a href="<?php echo safe_output($config->get('address')); ?>/logs/" class="button grey"><?php echo safe_output($language->get('Clear')); ?></a></p></div>
				<div class="clear"></div>
			</form>
		</div>
	</div>

	<div id="box">
		<div id="content">		
					
			<p>
				<a href="<?php echo $page_previous; ?>">&laquo; <?php echo safe_output($language->get('Previous')); ?></a>
				<a href="<?php echo $page_next; ?>"><?php echo safe_output($language->get('Next')); ?> &raquo;</a>
				<span class="right"><?php echo safe_output($language->get('Page')); ?> <?php echo (int)$page; ?></span>
			</p>		
					
			<table class="data-table">
				<thead>
					<tr>
						<th><?php echo safe_output($language->get('Added')); ?></th>
						<th><?php echo safe_output($language->get('IP Address')); ?></th>
						<th><?php echo safe_output($language->get('Description')); ?></th>
					</tr>
				</thead>
				<?php
					$i = 0;
					foreach ($logs_array as $log_item) {
				?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><a href="<?php echo $config->get('address'); ?>/logs/view/<?php echo (int) $log_item['id']; ?>/"><?php echo safe_output(time_ago_in_words($log_item['event_date'])); ?> <?php echo safe_output($language->get('ago')); ?></a></td>
					<td class="centre"><?php echo safe_output($log_item['event_ip_address']); ?></td>
					<td class="centre"><?php echo html_output($log_item['event_description']); ?></td>
				</tr>
				<?php $i++; } ?>
			</table>
			
			<p>
				<a href="<?php echo $page_previous; ?>">&laquo; <?php echo safe_output($language->get('Previous')); ?></a>
				<a href="<?php echo $page_next; ?>"><?php echo safe_output($language->get('Next')); ?> &raquo;</a>
				<span class="right"><?php echo safe_output($language->get('Page')); ?> <?php echo (int)$page; ?></span>
			</p>

			<div class="clear"></div>

		</div>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>