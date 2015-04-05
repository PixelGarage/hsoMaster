<?php drupal_add_library('system', 'ui.tabs'); $slugs = array(); ?>
<ul>
	<?php foreach ($view->result as $id => $data): ?>
		<?php
			$node = node_load($data->nid);
			$title = empty($node->field_tab_title) ? $node->title : $node->field_tab_title[LANGUAGE_NONE][0]['safe_value'];
 			$slug = str_replace('.', '_', transliteration_clean_filename(trim($title)));
			$slugs[$id] = $slug;
		?>
		<li><a href="#<?php print $slug; ?>"><?php print $title; ?></a></li>
	<?php endforeach; ?>
	<li><a href="#startdaten">Startdaten</a></li>
</ul>
<?php foreach ($rows as $id => $row): ?>
  <div <?php if ($classes_array[$id]) { print 'class="' . $classes_array[$id] .'"';  } ?> id="<?php print $slugs[$id] ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>