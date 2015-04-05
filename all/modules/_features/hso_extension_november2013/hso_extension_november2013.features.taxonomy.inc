<?php
/**
 * @file
 * hso_extension_november2013.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function hso_extension_november2013_taxonomy_default_vocabularies() {
  return array(
    'menugroup' => array(
      'name' => 'Menu-Group',
      'machine_name' => 'menugroup',
      'description' => '',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
  );
}
