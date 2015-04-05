<?php
	$link = false;
	if (!empty($node->field_link)) {
		$link = $node->field_link[LANGUAGE_NONE][0]['url'];
	} elseif (!empty($node->field_file)) {
		$link = file_create_url($node->field_file[LANGUAGE_NONE][0]['uri']);
	}
	$picture_output = render($content['field_picture']);
	if ($link) {
		$picture_output = str_replace(array('><img ', ' /></div>'), array('><a href="' . $link . '" target="_blank"><img ', ' /></a></div>'), $picture_output);
	}
?>
<article<?php print $attributes; ?>>
	<?php print render($title_prefix); ?>
	<?php print $picture_output; ?>
	<?php if ($title): ?>
	<header>
		<h2<?php print $title_attributes; ?>><?php print $title ?></h2>
	</header>
	<?php endif; ?>
	<?php print render($title_suffix); ?>
	<div<?php print $content_attributes; ?>>
		<?php
			// We hide the comments and links now so that we can render them later.
			hide($content['comments']);
			hide($content['links']);
			print render($content);
		?>
	</div>
</article>