<article<?php print $attributes; ?>>
	<div class="picture_address clearfix">
		<?php print render($content['field_picture']); ?>
		<?php print render($title_prefix); ?>
		<?php if ($title): ?>
		<header>
			<h2<?php print $title_attributes; ?>><?php print $title ?></h2>
		</header>
		<?php endif; ?>
		<?php print render($title_suffix); ?>
		<?php print render($content['field_address']); ?>
	</div>
	<div class="map_details_mobile">
		<?php
			$address = $node->field_address[LANGUAGE_NONE][0];
			$address = urlencode($address['thoroughfare'] . ', ' . $address['postal_code'] . ' ' . $address['locality']);
		?>
		<a href="http://maps.google.com/maps?q=<?php print $address; ?>" target="_blank">Map</a>
	</div>
	<div class="map_details">
		<a href="http://maps.google.com/maps?q=<?php print $address; ?>" target="_blank">
			<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php print $address; ?>&language=de&size=275x190&maptype=roadmap&markers=color:red%7C<?php print $address; ?>&sensor=false" alt="" />
		</a>
		<?php print render($content['field_map_details']); ?>
	</div>
	<div<?php print $content_attributes; ?>>
		<?php
			// We hide the comments and links now so that we can render them later.
			hide($content['comments']);
			hide($content['links']);
			hide($content['field_map_details']);
			print render($content);
		?>
	</div>
</article>


