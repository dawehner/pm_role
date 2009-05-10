<?php
// $Id$

// @TODO deside whether this module should be a deny or allow module :)

function pm_role_admin_settings() {
  $form = array();
  $roles = user_roles(TRUE);
  foreach ($roles as $rid1 => $role1) {
    foreach ($roles as $rid2 => $role2) {
      $form['foo_messages_role_sent_from'. $rid1 .'_to_'. $rid2] = array(
        '#type' => 'checkbox',
        '#title' => t('@role1 cannot sent to @role2'),
        '#description' => t('@role1 is not allowed to sent messages to @role2'),
      );
    }
  }
  return system_settings_form($form);
}

