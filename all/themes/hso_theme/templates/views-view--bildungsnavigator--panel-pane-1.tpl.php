<?php
	drupal_add_js(drupal_get_path('theme', 'hso_theme') .'/js/jquery.imagemapster.js', 'file');
	drupal_add_js(drupal_get_path('theme', 'hso_theme') .'/js/bildungsnavigator.js', 'file');
	$items = array();
	$internal_ids = array();
	$segments_ids = array();
	foreach ($view->result as $n) {
		$item = new StdClass();
		$item->nid = $n->nid;
		$item->link = url('node/' . $n->nid);
		$item->title = $n->field_field_bn_title[0]['rendered']['#markup'];
		$item->description = $n->field_field_bn_description[0]['rendered']['#markup'];
		$item->related_ids = empty($n->field_field_bn_related_ids) ? array() : array_map('trim', explode(',', $n->field_field_bn_related_ids[0]['raw']['value']));
		$item->links = '';
		foreach($n->field_field_banner_links as $link) {
			$item->links .= render($link);
		}
		$item->segment_id = $n->field_field_segment[0]['raw']['tid'];
		if (!array_key_exists('segment_' . $item->segment_id, $segments_ids)) $segments_ids['segment_' . $item->segment_id] = array();
		$segments_ids['segment_' . $item->segment_id][] = $n->field_field_internal_id[0]['raw']['value'];
		$items[$n->field_field_internal_id[0]['raw']['value']] = $item;
		$internal_ids[] = $n->field_field_internal_id[0]['raw']['value'];
	}
?>
<script type="text/javascript">
	Drupal.bildungsnavigator_items = <?php print json_encode($items); ?>;
	Drupal.bildungsnavigator_items_ids = <?php print json_encode($internal_ids); ?>;
	Drupal.bildungsnavigator_items_ids_by_segment = <?php print json_encode($segments_ids); ?>;
</script>
<div id="bildungsnavigator_main_wrapper">
	<div id="bildungsnavigator_wrapper">
		<img src="<?php print base_path(); ?>sites/all/themes/hso_theme/images/bildungsnavigator_940.jpg" alt="" usemap="#bildungsmap" />
		<div id="bildungsnavigator_pin"></div>
	</div>
	<div id="bildungsnavigator_tooltip" style="display: none;">
		<img src="<?php print base_path(); ?>sites/all/themes/hso_theme/images/bildungsnavigator.jpg" alt="" />
	</div>
	<div id="bildungsnavigator_witercho"></div>
	<div id="bildungsnavigator_witercho_details" class="clearfix">
		<div id="witercho_related"></div>
		<div id="witercho_details">
			<div class="witercho_breadcrumb">
				<a href="javascript:void(0);">Bildungsnavigator</a>
			</div>
			<div class="legend">
				Mit ihrem einmaligen, durchgehend aufeinander abgestimmten Programm macht die HSO den Bildungsweg frei,
				von der kaufm&#228;nnischen Grundbildung bis zum betriebswirtschaftlichen Doktorat.
			</div>
			<div class="legend2">Ihr gew&#228;hlter Lehrgang</div>
			<div class="course_item">
				<h2></h2>
				<p class="details"></p>
				<div class="links"></div>
			</div>
		</div>
	</div>
</div>
<map id="bildungs_map" name="bildungsmap">
	<area href="#" shape="rect" alt="" title="" coords="5,68,936,126" data-key="97,all,segment_4" />
	<area href="#" shape="rect" alt="" title="" coords="5,163,85,425" data-key="93,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="90,206,170,425" data-key="90,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="175,206,509,265" data-key="91,all,segment_4" />
	<area href="#" shape="rect" alt="" title="" coords="515,206,764,265" data-key="92,all,segment_4" />
	<area href="#" shape="rect" alt="" title="" coords="770,206,849,265" data-key="71,all,segment_4" />
	<area href="#" shape="rect" alt="" title="" coords="856,206,934,265" data-key="70,all,segment_4" />
	<area href="#" shape="rect" alt="" title="" coords="175,302,254,362" data-key="60,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="260,302,339,362" data-key="63,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="345,302,424,362" data-key="62,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="430,302,509,362" data-key="105,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="515,302,594,362" data-key="64,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="600,302,679,362" data-key="106,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="685,302,764,362" data-key="107,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="770,302,849,362" data-key="68,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="856,302,934,362" data-key="69,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="175,366,509,425" data-key="59,all,segment_3" />
  <area href="#" shape="rect" alt="" title="" coords="515,366,594,425" data-key="78,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="600,366,679,425" data-key="108,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="685,366,764,425" data-key="109,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="770,366,934,425" data-key="66,all,segment_3" />
	<area href="#" shape="rect" alt="" title="" coords="5,430,594,490" data-key="35,all,segment_2" />
	<area href="#" shape="rect" alt="" title="" coords="600,430,679,490" data-key="30,all,segment_1" />
	<area href="#" shape="rect" alt="" title="" coords="685,430,764,490" data-key="31,all,segment_1" />
	<area href="#" shape="rect" alt="" title="" coords="770,430,849,490" data-key="31,all,segment_1" />
	<area href="#" shape="rect" alt="" title="" coords="856,430,934,490" data-key="32,all,segment_1" />
	<area href="#" shape="rect" alt="" title="" coords="5,494,594,554" data-key="34,all,segment_2" />
	<area href="#" shape="rect" alt="" title="" coords="600,494,934,554" data-key="29,all,segment_1" />
</map>