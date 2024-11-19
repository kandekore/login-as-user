<?php
/**
 * Plugin Name: Admin Login As User
 * Description: Allows admin to log in as any non-admin user and revert back to the admin account.
 * Version: 1.1.0
 * Author: Darren Kandekore
 * Author URI: darrenk.uk
add_action('init', 'alau_start_session');
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Start the session if it's not already started
function alau_start_session() {
    if (!session_id()) {
        session_start();
    }
}

// Function to display the "Login As" link in user list
function alau_add_login_as_user_link($actions, $user) {
    if (current_user_can('administrator') && !in_array('administrator', $user->roles)) {
        $url = wp_nonce_url(
            add_query_arg(
                array(
                    'action' => 'login_as_user',
                    'user_id' => $user->ID,
                ),
                admin_url('users.php')
            ),
            'login_as_user_' . $user->ID
        );
        $actions['login_as_user'] = '<a href="' . esc_url($url) . '">Login As User</a>';
    }
    return $actions;
}
add_filter('user_row_actions', 'alau_add_login_as_user_link', 10, 2);

// Function to handle the login as user action
function alau_login_as_user() {
    if (isset($_GET['action']) && $_GET['action'] === 'login_as_user' && isset($_GET['user_id']) && current_user_can('administrator')) {
        $user_id = intval($_GET['user_id']);
        $nonce = sanitize_text_field($_GET['_wpnonce']);

        if (!wp_verify_nonce($nonce, 'login_as_user_' . $user_id)) {
            wp_die('Security check failed.');
        }

        $user = get_user_by('ID', $user_id);
        if ($user && !in_array('administrator', $user->roles)) {
            // Store original admin ID in a session variable
            $_SESSION['original_admin_id'] = get_current_user_id();

            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);

            wp_redirect(home_url());
            exit;
        } else {
            wp_die('Invalid user.');
        }
    }
}
add_action('admin_init', 'alau_login_as_user');

// Function to add revert link in the admin bar
function alau_add_revert_link($wp_admin_bar) {
    if (is_user_logged_in() && current_user_can('administrator') && isset($_SESSION['original_admin_id'])) {
        $url = wp_nonce_url(
            add_query_arg(
                array(
                    'action' => 'revert_to_admin',
                ),
                home_url()
            ),
            'revert_to_admin'
        );
        $wp_admin_bar->add_node(array(
            'id' => 'revert_to_admin',
            'title' => 'Revert to Admin',
            'href' => $url,
        ));
    }
}
add_action('admin_bar_menu', 'alau_add_revert_link', 100);

// Function to handle the revert to admin action
function alau_revert_to_admin() {
    if (isset($_GET['action']) && $_GET['action'] === 'revert_to_admin' && isset($_SESSION['original_admin_id'])) {
        $nonce = sanitize_text_field($_GET['_wpnonce']);

        if (!wp_verify_nonce($nonce, 'revert_to_admin')) {
            wp_die('Security check failed.');
        }

        $admin_id = intval($_SESSION['original_admin_id']);
        $user = get_user_by('ID', $admin_id);

        if ($user) {
            wp_set_current_user($admin_id);
            wp_set_auth_cookie($admin_id);

            // Clear the session variable
            unset($_SESSION['original_admin_id']);

            wp_redirect(admin_url());
            exit;
        } else {
            wp_die('Invalid admin user.');
        }
    }
}
add_action('template_redirect', 'alau_revert_to_admin');

// Clear session on logout
function alau_clear_session_on_logout() {
    if (!session_id()) {
        session_start();
    }
    unset($_SESSION['original_admin_id']);
}
add_action('wp_logout', 'alau_clear_session_on_logout');

?>
