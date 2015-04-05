<?php
	drupal_add_js(drupal_get_path('theme', 'hso_theme') .'/js/jqcloud.min.js', 'file');
	$tag_cloud = array();
	foreach ($view->result as $result) {
		$tag_cloud[] = array(
			'text' => $result->taxonomy_term_data_field_data_field_tags_name,
			'weight' => $result->node_nid,
			'link' => url('taxonomy/term/' . $result->taxonomy_term_data_field_data_field_tags_tid),
		);
  }		
?>
<div class="<?php print $classes; ?>">
  <?php if ($rows): ?>
    <div class="view-content">
    	<div id="tag-cloud"></div>
    	<script type="text/javascript">
    		jQuery(document).ready(function() {
    			jQuery('#tag-cloud').jQCloud(<?php print json_encode($tag_cloud); ?>);
    		});
    	</script>
    </div>
  <?php endif; ?>
</div>