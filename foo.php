<?php
// $Id$

/**
 * Implementation of hook_form_privatemsg_new_alter().
 */
function foo_form_privatemsg_new_alter(&$form, &$form_state) {
  $form['#validate'][] = 'foo_form_privatemsg_new_validate';
}

function foo_form_privatemsg_new_validate(&$form, &$form_state) {
}

/**
 * Implementation of hook_menu_alter().
 */
function foo_menu_alter() {
  $callbacks['messages/user-name-autocomplete']['page callback'] = 'foo_messages_autocomplete_callback';
}

/**
 * This function does the same as the normal privatemsg autocomplete but only returns valid users.
 * @see privatemsg_user_name_autocomplete
 *
 * @TODO
 *   Don't use the default one :)
 */
function foo_messages_autocomplete_callback($string) {
  $names = array();
  // 1: Parse $string and build list of valid user names.
  $fragments = explode(',', $string);
  foreach ($fragments as $index => $name) {
    $name = trim($name);
    if ($error = module_invoke('user', 'validate_name', $name)) {
      // Do nothing if this name does not validate.
    }
    else {
      $names[$name] = $name;
    }
  }

  // By using user_validate_user we can ensure that names included in $names are at least logisticaly possible.
  // 2: Find the next user name suggestion.
  $fragment = array_pop($names);
  if (!empty($fragment)) {
    $query = "SELECT name FROM {users} u WHERE name like '%s%%'";
    $query .= " AND name NOT IN ('". implode("', '", $names) ."')"; // This will prevent suggesting a name that is already in our list.
    $query .= " AND status <> 0 ORDER BY name ASC";
    $result = db_query_range($query, $fragment, 0, 10);
    $prefix = count($names) ? implode(", ", $names) .", " : '';
    // 3: Build proper suggestions and print.
    $matches = array();
    while ($user = db_fetch_object($result)) {
      $matches[$prefix . $user->name .", "] = $user->name;
    }
    print drupal_to_js($matches);
    exit();
  }
}

/**
 * Implementation of hook_menu().
 */
function foo_menu() {
  // @TODO
  //   Invent a way to display role to role settings.
  //   Make a admin page for it.
}