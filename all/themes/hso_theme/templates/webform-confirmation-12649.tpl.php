<?php
/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $confirmation_message: The confirmation message input by the webform author.
 * - $sid: The unique submission ID of this submission.
 */

module_load_include('inc', 'webform', 'includes/webform.submissions');
$submission = webform_get_submission($node->nid, $sid);

// get course node
$webform_components = $node->webform['components'];
foreach ($webform_components as $key => $data) {
  if ($data['form_key'] == 'course_nid') {
    $course_nid = $submission->data[$key]['value'][0];
    break;
  }
}

if ($course_nid) {
  $course = node_load($course_nid);
  if ($course && !empty($course->field_brochure)) {
    $brochure = node_load($course->field_brochure[LANGUAGE_NONE][0]['target_id']);
    if ($brochure && !empty($brochure->field_file)) {
      $pdf = $brochure->field_file[LANGUAGE_NONE][0]['uri'];
      hso_anmeldung_transfer_pdf($pdf, 'Kurs-Details.pdf', true);
    }
  }
}
?>

<div class="webform-confirmation">
  <?php if ($confirmation_message): ?>
    <?php print $confirmation_message ?>
  <?php else: ?>
    <p>Besten Dank für Ihr Interesse an unseren Ausbildungs-Lehrgängen. Der angeforderte Prospekt ist zur Zeit leider nicht verfügbar.<p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/' . $course_nid); ?>">Zurück zum Kurs/Lehrgang</a>
</div>

