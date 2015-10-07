<?php

if( defined('DISABLE_WP_CRON') && DISABLE_WP_CRON ){
	$this->set_message(__("The DISABLE_WP_CRON constant is enabled"), 'error', false);
}

$shedules = wp_get_schedules();
//$this->debug($shedules, '$shedules');
$cron_jobs = _get_cron_array();
//$this->debug($cron_jobs, '$cron_jobs');

if( isset($_GET['do']) && !empty($_GET['do']) ){
	$cron_to_do = $_GET['do'];
	foreach($cron_jobs as $timestamp=>$tasks){
		foreach($tasks as $taskslug=>$task){
			if($taskslug==$cron_to_do){
				foreach($task as $k=>$v){
					$cron_to_do_args = $v['args'];
					//wp_schedule_single_event(time(), $cron_to_do, $cron_to_do_args);
					//$this->set_message($cron_to_do.' '.__("executed"));
				}
			}
		}
	}
}



$this->admin_page_header();




if( !empty($cron_jobs) ){
	?><table class="widefat" style="clear:none;" id="cron_tasks_table">
		<thead>
			<tr>
				<th><?php _e("Task name", 'kodex'); ?></th>
				<th colspan="3"><?php _e("Recurrence", 'kodex'); ?></th>
				<th colspan="3"><?php _e("Next execution", 'kodex'); ?></th>
				<!--th colspan="2"><?php _e("Actions", 'kodex'); ?></th-->
			</tr>
		</thead>
		<tbody>

			<?php $i=0; foreach($cron_jobs as $timestamp=>$tasks): ?>
				<?php foreach($tasks as $taskslug=>$task): ?>
					<?php foreach($task as $k=>$v): $i++; ?>
					<tr class="<?php echo($i%2==0)?'alternate':''; ?>">
						<th scope="row"><b><?php echo $taskslug; ?></b></th>
						<td><?php echo $v['schedule']; ?></td>
						<td><?php echo $shedules[$v['schedule']]['interval']; ?> <?php _e('seconds'); ?></td>
						<td><?php echo $shedules[$v['schedule']]['display']; ?></td>
						<td><?php echo $timestamp; ?></td>
						<td><?php echo date_i18n('l j F Y H:i:s', $timestamp); ?></td>
						<td class="countdown"><?php echo $timestamp-time(); ?> <?php _e("seconds left", 'kodex'); ?></td>
						<!--td><a href="<?php echo add_query_arg(array('do'=>$taskslug)); ?>" title="<?php esc_attr_e("Execute now", 'kodex'); ?>"><span class="dashicons dashicons-controls-play"></span></a></td>
						<td><a href="<?php echo add_query_arg(array('remove'=>$taskslug)); ?>" title="<?php esc_attr_e("Remove from tasks list", 'kodex'); ?>"><span class="dashicons dashicons-no"></span></a></td-->
					</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>

		</tbody>
	</table><?php
}else{
	?><p><?php _e("No scheduled task", 'kodex'); ?></p><?php
}





$this->admin_page_footer();