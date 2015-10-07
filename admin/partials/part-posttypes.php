<?php



$this->admin_page_header();

$post_types =  get_post_types(array(), 'objects');
//$this->debug($post_types);

?><h3><?php _e("Post types", 'kodex'); ?> (<?php echo count($post_types); ?>)</h3><?php

if( !empty($post_types) ){
	?><table class="widefat" style="clear:none;width:auto;">
		<thead>
			<tr>
				<th><?php _e("Label", 'kodex'); ?></th>
				<th><?php _e("Name", 'kodex'); ?></th>
				<th><?php _e("Public", 'kodex'); ?></th>
				<th><?php _e("Hierarchical", 'kodex'); ?></th>
				<th><?php _e("Exclude from search", 'kodex'); ?></th>
				<th><?php _e("Taxonomies", 'kodex'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach($post_types as $k=>$v): $i++; ?>
			<tr class="<?php echo($i%2==0)?'alternate':''; ?>">
				<th scope="row" valign="top"><b><?php echo $v->label; ?></b></th>
				<td><?php echo $v->name; ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->public); ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->hierarchical); ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->exclude_from_search); ?></td>
				<td><?php if(!empty($v->taxonomies)){
					foreach($v->taxonomies as $t){
						echo $t.'<br>';
					}
				} ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table><?php
}else{
	?><p><?php _e("No post types", 'kodex'); ?></p><?php
}

$taxonomies =  get_taxonomies(array(), 'objects');
//$this->debug($taxonomies);

?><br><h3><?php _e("Taxonomies", 'kodex'); ?> (<?php echo count($taxonomies); ?>)</h3><?php

if( !empty($taxonomies) ){
	?><table class="widefat" style="clear:none;width:auto;">
		<thead>
			<tr>
				<th><?php _e("Label", 'kodex'); ?></th>
				<th><?php _e("Name", 'kodex'); ?></th>
				<th><?php _e("Public", 'kodex'); ?></th>
				<th><?php _e("Hierarchical", 'kodex'); ?></th>
				<th><?php _e("Show admin column", 'kodex'); ?></th>
				<th><?php _e("Post types", 'kodex'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach($taxonomies as $k=>$v): $i++; ?>
			<tr class="<?php echo($i%2==0)?'alternate':''; ?>">
				<th scope="row" valign="top"><b><?php echo $v->label; ?></b></th>
				<td><?php echo $v->name; ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->public); ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->hierarchical); ?></td>
				<td align="center"><?php echo $this->get_bool_icon($v->show_admin_column); ?></td>
				<td><?php if(!empty($v->object_type)){
					foreach($v->object_type as $pt){
						echo $pt.'<br>';
					}
				} ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table><?php
}else{
	?><p><?php _e("No post types", 'kodex'); ?></p><?php
}

$this->admin_page_footer();