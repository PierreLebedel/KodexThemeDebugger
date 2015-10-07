<?php

global $shortcode_tags;

$this->admin_page_header();

if( !empty($shortcode_tags) ){
	?><table class="widefat" style="clear:none;width:auto;">
		<thead>
			<tr>
				<th colspan="2"><b><?php _e("Shortcodes", 'kodex'); ?></b></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach($shortcode_tags as $k=>$v): $i++; ?>
			<tr class="<?php echo($i%2==0)?'alternate':''; ?>">
				<th scope="row"><b><?php echo $k; ?></b></th>
				<td><code>[<?php echo $k; ?>]</code></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table><?php
}else{
	?><p><?php _e("No shortcode", 'kodex'); ?></p><?php
}

$this->admin_page_footer();