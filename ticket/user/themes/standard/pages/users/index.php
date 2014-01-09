<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Users'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$get_array = array();

if (isset($_GET['filter'])) {
	if (isset($_GET['like_search']) && !empty($_GET['like_search'])) {
		$get_array['like_search'] 	= $_GET['like_search'];
		$like_search_temp			= $_GET['like_search'];
	}
	if (isset($_GET['user_level']) && !empty($_GET['user_level'])) {
		$get_array['user_level'] 	= (int) $_GET['user_level'];
		$user_level_temp			= $_GET['user_level'];
	}
}

$users_array = $users->get($get_array);

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="users-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Users')); ?></h2>
			</div>
			<div class="right">
				<a href="<?php echo $config->get('address'); ?>/users/add/" class="button grey"><?php echo safe_output($language->get('Add')); ?></a>
			</div>
			
			<div class="clear"></div>

			<p class="label short"><?php echo safe_output($language->get('Users')); ?></p><p class="result"><?php echo count($users_array); ?></p>
			<div class="clear"></div>
		
		</div>
		
		<div id="user-search" class="widget">
			<form method="get" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">
				<p class="label short"><?php echo safe_output($language->get('Search')); ?></p>
				<p class="result">
					<input type="text" name="like_search" value="<?php if (isset($like_search_temp)) echo safe_output($like_search_temp); ?>" size="15" />
				</p>
				<div class="clear"></div>
							
				<p class="label short"><?php echo safe_output($language->get('Permissions')); ?></p>
				<p class="result">
					<select name="user_level">
						<option value=""></option>
						<option value="1"<?php if (isset($user_level_temp) && $user_level_temp == 1) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Submitter')); ?></option>
						<option value="3"<?php if (isset($user_level_temp) && $user_level_temp == 3) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('User')); ?></option>
						<option value="4"<?php if (isset($user_level_temp) && $user_level_temp == 4) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Staff')); ?></option>
						<option value="5"<?php if (isset($user_level_temp) && $user_level_temp == 5) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Moderator')); ?></option>
						<option value="6"<?php if (isset($user_level_temp) && $user_level_temp == 6) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Global Moderator')); ?></option>
						<option value="2"<?php if (isset($user_level_temp) && $user_level_temp == 2) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Administrator')); ?></option>
					</select>
				</p>
				
				<div class="clear"></div>				
					
				<br />
				<div class="right"><p><button type="submit" name="filter" class="grey"><?php echo safe_output($language->get('Filter')); ?></button> <a href="<?php echo safe_output($config->get('address')); ?>/users/" class="button grey"><?php echo safe_output($language->get('Clear')); ?></a></p></div>
				<div class="clear"></div>
			</form>		
		</div>

	</div>
	
	<div id="box">

		<div id="content">		


			<table class="data-table">
				<tr>
					<th><?php echo safe_output($language->get('Name')); ?></th>
					<th><?php echo safe_output($language->get('Username')); ?></th>
					<th><?php echo safe_output($language->get('Email')); ?></th>
					<th><?php echo safe_output($language->get('Permissions')); ?></th>
				</tr>
				<?php
					$i = 0;
					foreach ($users_array as $user) {
				?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><a href="<?php echo $config->get('address'); ?>/users/view/<?php echo (int) $user['id']; ?>/"><?php echo safe_output($user['name']); ?></a></td>
					<td class="centre"><?php echo safe_output($user['username']); ?></td>
					<td class="centre"><?php echo safe_output($user['email']); ?></td>
					<td class="centre">
					<?php switch($user['user_level']) {
					
						case 1:
							echo safe_output($language->get('Submitter'));
						break;
						case 2:
							echo safe_output($language->get('Administrator'));
						break;
						case 3:
							echo safe_output($language->get('User'));
						break;
						case 4:
							echo safe_output($language->get('Staff'));
						break;
						case 5:
							echo safe_output($language->get('Moderator'));
						break;
						case 6:
							echo safe_output($language->get('Global Moderator'));
						break;					
					}
					?>
					</td>
				</tr>
				<?php $i++; } ?>
			</table>

			<div class="clear"></div>

		</div>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>