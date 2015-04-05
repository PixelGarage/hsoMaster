<?php
/**
 * @file
 * hso_extension_november2013.features.fe_block_boxes.inc
 */

/**
 * Implements hook_default_fe_block_boxes().
 */
function hso_extension_november2013_default_fe_block_boxes() {
  $export = array();

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'Call to action links';
  $fe_block_boxes->format = 'html';
  $fe_block_boxes->machine_name = 'call_2_action_block';
  $fe_block_boxes->body = '<p><a class="call2action broschuere_bestellen" href="/webform/broschuere-bestellen">Broschüre bestellen</a><a class="call2action bildungsberatung" href="/webform/bildungsberatung">Bildungsberatung</a> <a class="call2action startdaten_suchen" href="/coursetimes/search">Startdaten suchen</a></p>
';

  $export['call_2_action_block'] = $fe_block_boxes;

  return $export;
}
