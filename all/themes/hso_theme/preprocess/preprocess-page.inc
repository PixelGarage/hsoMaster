<?php
function hso_theme_alpha_preprocess_page(&$vars) {
	$contexts = context_active_contexts();
	if (array_key_exists('kv-college', $contexts)) {
		$vars['logo'] = str_replace('logo.png', 'kv_logo.png', $vars['logo']);
	}
	if (array_key_exists('hs-college', $contexts)) {
		$vars['logo'] = str_replace('logo.png', 'hs_logo.png', $vars['logo']);
	}
	if (array_key_exists('ks-college', $contexts)) {
		$vars['logo'] = str_replace('logo.png', 'ks_logo.png', $vars['logo']);
	}
	if (array_key_exists('ex-college', $contexts)) {
		$vars['logo'] = str_replace('logo.png', 'ex_logo.png', $vars['logo']);
	}
}