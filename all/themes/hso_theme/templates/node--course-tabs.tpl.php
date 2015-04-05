<?php
 hide($content['field_tab_title']);
?>
<article<?php print $attributes; ?>>
	<?php print render($title_prefix); ?>
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
<div class="anmelden_wrapper"><a href="#startdaten" class="anmelden_button">Anmelden</a></div>