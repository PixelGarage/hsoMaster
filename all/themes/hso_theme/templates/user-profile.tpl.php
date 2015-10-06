<?php
	$account = $variables['elements']['#account'];
  $title = !empty($account->field_title) && !empty($account->field_title[LANGUAGE_NONE][0]['value']) ?
    $account->field_title[LANGUAGE_NONE][0]['value'] . ' ' : '';
?>
<div class="user_profile clearfix"<?php print $attributes; ?>>
	<?php print render($user_profile['user_picture']); ?>
	<?php if (!empty($account->field_full_name)): ?>
		<div class="field field-name-field-full-name field-type-text field-label-hidden">
			<div class="field-items">
				<div class="field-item even"><?php print l($title . $account->field_full_name[LANGUAGE_NONE][0]['value'], 'user/' . $account->uid); ?></div>
			</div>
		</div>
    <?php hide($user_profile['field_title']); ?>
    <?php hide($user_profile['field_full_name']); ?>
	<?php else: ?>
    <?php print render($user_profile['field_title']); ?>
		<?php print render($user_profile['field_full_name']); ?>
	<?php endif; ?>
	<?php print render($user_profile['field_position_function']); ?>
	<?php print render($user_profile['field_bio']); ?>
	<?php if (!in_array('dozent', $account->roles)): ?>
		<?php print render($user_profile['field_phone']); ?>
		<div class="field-email">
			<?php print invisimail_encode_email($account->mail, 'js_entities', array('link' => true)); ?>
		</div>
	<?php else: ?>
		<?php hide($user_profile['field_phone']); ?>
	<?php endif; ?>
  <?php print render($user_profile); ?>
</div>
