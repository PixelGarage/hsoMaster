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
	<area href="#" shape="rect" alt="" title="EMBA"     coords="5,68,936,126" data-key="40,all,segment_4" />
	<area href="#" shape="rect" alt="" title="FH"       coords="5,155,75,412" data-key="182,all,segment_3" />
	<area href="#" shape="rect" alt="" title="HFW"      coords="76,209,146,413" data-key="176,all,segment_3" />
	<area href="#" shape="rect" alt="" title="NDS-BWL"  coords="148,209,306,267" data-key="184,all,segment_3" />
	<area href="#" shape="rect" alt="" title="NDS-ORG"  coords="310,209,468,267" data-key="224,all,segment_3" />
  <area href="#" shape="rect" alt="" title="NDS-LOG"  coords="471,209,629,267" data-key="223,all,segment_3" />
  <area href="#" shape="rect" alt="" title="NDS-MVL"  coords="632,209,790,267" data-key="185,all,segment_3" />
	<area href="#" shape="rect" alt="" title="ML"       coords="793,209,863,267" data-key="206,all,segment_3" />
	<area href="#" shape="rect" alt="" title="VL"       coords="866,209,936,267" data-key="207,all,segment_3" />
	<area href="#" shape="rect" alt="" title="TK"       coords="148,295,218,353" data-key="164,all,segment_3" />
	<area href="#" shape="rect" alt="" title="HWD"      coords="220,295,290,353" data-key="162,all,segment_3" />
	<area href="#" shape="rect" alt="" title="DA"       coords="292,295,362,353" data-key="166,all,segment_3" />
	<area href="#" shape="rect" alt="" title="UO"       coords="363,295,433,353" data-key="172,all,segment_3" />
	<area href="#" shape="rect" alt="" title="FF"       coords="436,295,506,353" data-key="168,all,segment_3" />
  <area href="#" shape="rect" alt="" title="LOM"      coords="507,295,577,353" data-key="219,all,segment_3" />
	<area href="#" shape="rect" alt="" title="FIN"      coords="578,295,648,353" data-key="170,all,segment_3" />
	<area href="#" shape="rect" alt="" title="HR"       coords="649,295,719,353" data-key="179,all,segment_3" />
  <area href="#" shape="rect" alt="" title="TM"       coords="721,295,791,353" data-key="222,all,segment_3" />
	<area href="#" shape="rect" alt="" title="MF"       coords="793,295,863,353" data-key="174,all,segment_3" />
	<area href="#" shape="rect" alt="" title="VF"       coords="864,295,934,353" data-key="175,all,segment_3" />
	<area href="#" shape="rect" alt="" title="KVK"      coords="148,355,432,413" data-key="163,all,segment_3" />
  <area href="#" shape="rect" alt="" title="LES"      coords="434,355,504,413" data-key="167,all,segment_3" />
  <area href="#" shape="rect" alt="" title="LOA"      coords="506,355,576,413" data-key="220,all,segment_3" />
	<area href="#" shape="rect" alt="" title="SB-FIN"   coords="578,355,648,413" data-key="214,all,segment_3" />
	<area href="#" shape="rect" alt="" title="SB-HR"    coords="650,355,720,413" data-key="171,all,segment_3" />
  <area href="#" shape="rect" alt="" title="TA"       coords="722,355,792,413" data-key="221,all,segment_3" />
	<area href="#" shape="rect" alt="" title="MARKOM"   coords="794,355,934,413" data-key="173,all,segment_3" />
	<area href="#" shape="rect" alt="" title="HD-HS"    coords="5,430,468,488" data-key="215,all,segment_2" />
	<area href="#" shape="rect" alt="" title="KV-BE"    coords="472,430,586,488" data-key="148,all,segment_1" />
	<area href="#" shape="rect" alt="" title="KV-M"     coords="588,430,702,488" data-key="142,all,segment_1" />
  <area href="#" shape="rect" alt="" title="HD-KV"    coords="704,430,818,488" data-key="147,all,segment_1" />
	<area href="#" shape="rect" alt="" title="DH"       coords="820,430,934,488" data-key="48,all,segment_1" />
	<area href="#" shape="rect" alt="" title="BFD-HS"   coords="5,490,468,548" data-key="44,all,segment_2" />
	<area href="#" shape="rect" alt="" title="BFD-KV"   coords="472,490,934,548" data-key="146,all,segment_1" />
</map>