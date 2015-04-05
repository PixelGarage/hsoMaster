<?php drupal_add_library('system', 'ui.tabs'); $slugs = array(); ?>
<ul>
	<?php foreach ($view->result as $id => $data): ?>
		<?php
			$slug = str_replace('.', '_', transliteration_clean_filename($data->node_title));
			$slugs[$id] = $slug;
		?>
		<li><a href="#<?php print $slug; ?>"><?php print check_plain($data->node_title); ?></a></li>
	<?php endforeach; ?>
</ul>
<?php foreach ($rows as $id => $row): ?>
  <div <?php if ($classes_array[$id]) { print 'class="' . $classes_array[$id] .'"';  } ?> id="<?php print $slugs[$id] ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
