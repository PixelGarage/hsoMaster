<?php
	if ($view_mode == 'teaser' && !empty($node->field_centers)) {
		$output_centers = '';
		foreach ($node->field_centers[LANGUAGE_NONE] as $delta => $term) {
            $fieldValue = field_view_field('taxonomy_term', $term['taxonomy_term'], 'field_icon',
                                            array('label' => 'hidden', 'type' => 'image', 'settings' => array('image_style' => 'center', 'image_link' => 'content')));
			$output_centers .= render($fieldValue);
		}
		$content['field_centers'] = array(
			'#type' => 'markup',
			'#markup' => '<div class="center_icons">' . $output_centers . '</div>'
		);
	}
	if ($view_mode == 'full') {
		$content['field_centers']['#title'] = 'Kategorien';
	}
?>
<article<?php print $attributes; ?>>
	<?php if (!empty($node->field_picture)): ?>
	<div class="with_picture clearfix">
	<?php endif; ?>
		<?php print render($content['field_picture']); ?>
		<?php print render($title_prefix); ?>
		<?php if (!$page && $title): ?>
		<header>
			<?php if ($view_mode != 'teaser' && $view_mode != 'full'): ?>
				<div class="submitted"><?php print format_date($node->created, 'custom', 'j. F Y'); ?></div>
			<?php endif; ?>
			<h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
			<?php if ($view_mode == 'teaser'): ?>
				<div class="submitted"><?php print format_date($node->created, 'custom', 'j. F Y'); ?></div>
			<?php endif; ?>
		</header>
		<?php elseif ($page): ?>
			<div class="submitted">
				<?php
					$u = user_load($node->uid);
					$name = empty($u->field_full_name) ? $name : $u->field_full_name[LANGUAGE_NONE][0]['value'];
					print t('Submitted by !username on !datetime',
					array('!username' => $name, '!datetime' => format_date($node->created, 'custom', 'j. F Y')));
				?>
			</div>
		<?php endif; ?>
		<?php print render($title_suffix); ?>
		<div<?php print $content_attributes; ?>>
			<?php
				// We hide the comments and links now so that we can render them later.
				hide($content['comments']);
				hide($content['links']);
				hide($content['field_map_details']);
				print render($content);
			?>
		</div>
		<?php if ($view_mode == 'teaser' && !empty($content['links'])): ?>
			<nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
		<?php elseif ($view_mode != 'full'): ?>
			<nav class="links node-links clearfix"><ul class="links inline"><li class="node-readmore first last"><?php print l(t('Read more'), 'node/' . $node->nid); ?></li><ul></nav>
		<?php endif; ?>
		<?php if ($view_mode == 'full'): ?>
			<div class="block-hso-mods clearfix">
				<?php
					$block = module_invoke('hso_mods', 'block_view', 'hso_pager');
					print $block['content'];
				?>
			</div>
			<?php print render($content['comments']); ?>
		<?php endif; ?>
	<?php if (!empty($node->field_picture)): ?>
	</div>
	<?php endif; ?>
</article>


