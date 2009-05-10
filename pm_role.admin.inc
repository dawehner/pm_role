<?php
// $Id$

// @TODO deside whether this module should be a deny or allow module :)

function foo_admin_role_settings() {
  $form = array();
  $roles = user_roles(TRUE);
  foreach ($roles as $rid1 => $role1) {
    foreach ($roles as $rid2 => $role2) {
      $form['foo_messages_role_sent_from'. $rid1 .'_to_'. $rid2] = array(
        '#type' => 'checkbox',
        '#title' => t('@role1 sent to @role2'),
        '#description' => t('@role1 can sent messages to @role2'),
      );
    }
  }
  return system_settings_form($form);
}

