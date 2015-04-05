<?php
/**
 * @file
 * hso_extension_november2013.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function hso_extension_november2013_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['block-call_2_action_block'] = array(
    'cache' => -1,
    'custom' => 0,
    'machine_name' => 'call_2_action_block',
    'module' => 'block',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  $export['nodeblock-4421'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 4421,
    'module' => 'nodeblock',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '',
    'visibility' => 0,
  );

  $export['nodeblock-4426'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 4426,
    'module' => 'nodeblock',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  $export['nodeblock-4579'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 4579,
    'module' => 'nodeblock',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  $export['nodeblock-4580'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 4580,
    'module' => 'nodeblock',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  $export['nodeblock-4581'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 4581,
    'module' => 'nodeblock',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'hso_theme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'hso_theme',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  return $export;
}
