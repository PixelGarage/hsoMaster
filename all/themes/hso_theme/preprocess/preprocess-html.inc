<?php
function hso_theme_alpha_preprocess_html(&$vars) {
	$meta = array(
		'#tag' => 'meta',
		'#attributes' => array(
			'id' => 'meta_viewport',
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=0.60, maximum-scale=1, minimum-scale=0.60, user-scalable=no',
		),
	);
	drupal_add_html_head($meta, 'alpha-viewport');
  drupal_add_js('//platform.twitter.com/widgets.js', 'external');
  drupal_add_css('http://fast.fonts.com/cssapi/8d596996-b655-44b0-bd53-092653f91ba8.css', 'external');

  //
  // add adwebster pixel on kvcollege and handelsschule
  if (in_array('kvcollege_section', $vars['classes_array'])) {
    $ad_webster = <<<AdWebster
<!-- Begin ADWEBSTER.COM -->
<!-- img src="http://targeting.adwebster.com/img/bh.gif?n=1301&g=20&a=2267&s=1&l=1&t=i&f=1" width="1" height="1" border="0" -->
<img src="https://secure.adwebster.com/img/bh.gif?n=1301&g=20&a=2267&s=1&l=1&t=i&f=1" width="1" height="1" border="0" >
<!-- end ADWEBSTER.COM   -->
AdWebster;
    $vars['page']['page_bottom']['ad_webster'] = array(
      '#type' => 'markup',
      '#weight' => -100,
      '#markup' => $ad_webster
    );

  } else if (in_array('hscollege_section', $vars['classes_array'])) {
    $ad_webster = <<<AdWebster
<!-- Begin ADWEBSTER.COM -->
<!--img src="http://targeting.adwebster.com/img/bh.gif?n=1301&g=20&a=2266&s=1&l=1&t=i&f=1" width="1" height="1" border="0" -->
<img src="https://secure.adwebster.com/img/bh.gif?n=1301&g=20&a=2266&s=1&l=1&t=i&f=1" width="1" height="1" border="0" >
<!-- end ADWEBSTER.COM   -->
AdWebster;
    $vars['page']['page_bottom']['ad_webster'] = array(
      '#type' => 'markup',
      '#weight' => -100,
      '#markup' => $ad_webster
    );
  }

  //
  // add facebook script on front page
  if (drupal_is_front_page()) {
		$fb_js = <<<FS_JS
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=100486423397270";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
FS_JS;
		$vars['page']['page_bottom']['fb_scripts'] = array(
			'#type' => 'markup',
			'#weight' => -100,
			'#markup' => $fb_js
		);
	}

  //
  // add remarketing code to all pages
  $js_js = <<<JS_JS
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1045515944;
var google_conversion_label = "rEjgCMi2tAIQqJ3F8gM";
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1045515944/?value=0&amp;label=rEjgCMi2tAIQqJ3F8gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
JS_JS;
    $vars['page']['page_bottom']['cx_scripts'] = array(
		  '#type' => 'markup',
		  '#weight' => -100,
		  '#markup' => $js_js
	  );

}
