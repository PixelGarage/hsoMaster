<?php
	$title = views_trim_text(array(
		'max_length' => 35,
		'ellipsis' => true,
	), $title)
?>
<article<?php print $attributes; ?>>
	<?php print render($title_prefix); ?>
	<?php if ($view_mode == 'teaser'): ?>
		<div class="video_thumb">
			<?php print render($content['field_video']); ?>
			<?php print render($content['field_duration']); ?>
		</div>
	<?php elseif ($view_mode == 'full'): ?>
		<div class="full_view">
	<?php endif; ?>
	<?php if (!$page && $title): ?>
	<header>
		<h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
	</header>
	<?php endif; ?>
	<?php print render($title_suffix); ?>
	<div<?php print $content_attributes; ?>>
		<?php
			// We hide the comments and links now so that we can render them later.
			if ($view_mode == 'teaser') {
				print '<div class="submitted">' . format_date($node->created, 'custom', 'j. M Y') . '</div>';
			}
			hide($content['comments']);
			hide($content['links']);
			print render($content);
		?>
	</div>
	<?php if ($view_mode == 'full'): ?>
		</div>
		<?php print render($content['comments']); ?>
	<?php endif; ?>
</article>