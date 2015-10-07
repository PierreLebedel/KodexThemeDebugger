<?php

global $wp_rewrite;

if(isset($_GET['action']) && $_GET['action']=='flush'){
	$wp_rewrite->flush_rules(true);
	$this->set_message(__("Rewrite rules flushed", 'kodex'));
}

$this->admin_page_header();

?><a class="button button-primary" href="<?php echo add_query_arg(array('action'=>'flush')); ?>"><?php _e("Flush rewrite rules", 'kodex'); ?></a><br><br><?php

$kodex_rules = $wp_rewrite->wp_rewrite_rules();
if( !empty($kodex_rules) ){
	?><table class="widefat" style="clear:none;width:auto;">
		<thead>
			<tr>
				<th colspan="2"><b><?php _e("Rewrite rules", 'kodex'); ?></b></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach($kodex_rules as $k=>$v): $i++; ?>
			<tr class="<?php echo($i%2==0)?'alternate':''; ?>">
				<th scope="row"><?php echo $k; ?></th>
				<td><?php echo $v; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table><?php
}else{
	?><p><?php _e("No rewrite rules", 'kodex'); ?></p><?php
}

$this->admin_page_footer();