<?php
// $Id$

/**
 * @TODO
 *   Clean up the settings to remove all allowed items.
 */

function pm_role_admin_settings() {
  $form = array();
  $roles = user_roles(TRUE);
  foreach ($roles as $rid1 => $role1) {
    foreach ($roles as $rid2 => $role2) {
      $form['pm_role_deny_from'. $rid1 .'_to_'. $rid2] = array(
        '#type' => 'checkbox',
        '#title' => t('@role1 cannot sent to @role2'),
        '#description' => t('@role1 is not allowed to sent messages to @role2'),
        '#default_value' => variable_get('pm_role_deny_from'. $rid1 .'_to_'. $rid2, FALSE),
      );
    }
  }
  return system_settings_form($form);
}

