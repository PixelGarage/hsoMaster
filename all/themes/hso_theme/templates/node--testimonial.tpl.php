<article<?php print $attributes; ?>>
	<div class="front">
		<?php print render($content['field_picture']); ?>
		<?php print render($title_prefix); ?>
		<?php if ($title): ?>
		<header>
			<h2<?php print $title_attributes; ?>><?php print $title ?></h2>
			<div class="position"><?php print render($content['field_position_function']); ?></div>
		</header>
		<?php endif; ?>
		<?php print render($title_suffix); ?>
		<span class="arrow"></span>
	</div>
	<div class="back">
		<div<?php print $content_attributes; ?>>
			<h2<?php print $title_attributes; ?>><?php print $title ?></h2>
			<div class="position"><?php print render($content['field_position_function']); ?></div>
			<?php
				// We hide the comments and links now so that we can render them later.
				hide($content['comments']);
				hide($content['links']);
				print render($content);
			?>
		</div>
		<span class="arrow"></span>
	</div>
</article>