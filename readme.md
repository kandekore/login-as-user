# Admin Login As User

**Plugin Name:** Admin Login As User  
**Description:** Allows admin to log in as any non-admin user and revert back to the admin account.  
**Version:** 1.1.0  
**Author:** Darren Kandekore  
**Author URI:** [darrenk.uk](http://darrenk.uk)  

---

## Table of Contents

- [Description](#description)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Logging in as a User](#logging-in-as-a-user)
  - [Reverting to Admin](#reverting-to-admin)
- [Security](#security)
- [FAQ](#faq)
- [Changelog](#changelog)
- [License](#license)
- [Credits](#credits)

---

## Description

**Admin Login As User** is a WordPress plugin that empowers administrators to seamlessly log in as any non-admin user without needing their password. This functionality is particularly useful for troubleshooting user-specific issues, testing user roles and capabilities, or providing direct support to users.

---

## Features

- **Login as Non-Admin Users:** Administrators can log in as any non-admin user directly from the user list.
- **Revert Back to Admin Account:** Easily switch back to your original admin account with a single click.
- **Secure Session Handling:** Original admin credentials are securely stored using PHP sessions.
- **Non-Intrusive:** Does not alter any user data or settings; purely session-based switching.
- **User Role Checks:** Only available for users with 'administrator' capabilities, and cannot be used to log in as other administrators.

---

## Installation

1. **Download the Plugin:**
   - Clone or download the plugin files to your computer.

2. **Upload to WordPress:**
   - Upload the plugin folder to the `/wp-content/plugins/` directory of your WordPress installation.

3. **Activate the Plugin:**
   - Log in to your WordPress admin dashboard.
   - Navigate to **Plugins** → **Installed Plugins**.
   - Find **Admin Login As User** in the list and click **Activate**.

---

## Usage

### Logging in as a User

1. **Navigate to Users:**
   - Go to **Users** → **All Users** in the WordPress admin dashboard.

2. **Locate the User:**
   - Find the non-admin user you wish to log in as.

3. **Login As User:**
   - Hover over the user's row to reveal action links.
   - Click on **Login As User**.
   - You will be redirected to the site's homepage as the selected user.

### Reverting to Admin

1. **Access the Admin Bar:**
   - While logged in as another user, look at the top admin bar.

2. **Revert to Admin:**
   - Click on **Revert to Admin**.
   - You will be switched back to your original admin account and redirected to the admin dashboard.

---

## Security

- **Capability Checks:** Only users with the 'administrator' capability can use the login and revert functions.
- **Nonce Verification:** All actions are protected with WordPress nonces to prevent CSRF attacks.
- **Session Management:** The original admin ID is stored in a PHP session variable (`$_SESSION['original_admin_id']`), ensuring it's not exposed to the client side.
- **Role Restrictions:** Administrators cannot log in as other administrators, maintaining the integrity of admin accounts.

---

## FAQ

### Q1: Can I log in as another administrator?

**A:** No, the plugin restricts logging in as users with the 'administrator' role for security reasons.

### Q2: Is this plugin compatible with multisite installations?

**A:** This plugin is primarily designed for single-site installations. Multisite compatibility has not been tested.

### Q3: Does this plugin store any user passwords?

**A:** No, the plugin does not store or require any user passwords. It uses WordPress functions to switch user sessions securely.

### Q4: What happens if I log out while logged in as another user?

**A:** Logging out will end the session and you will need to log back in with your admin credentials.

---

## Changelog

### Version 1.1.0

- Initial release.
- Added functionality to log in as non-admin users.
- Implemented secure session handling for reverting to admin.

---

## License

This plugin is licensed under the **GNU General Public License v2.0 or later**.  
[https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)

---

## Credits

- **Author:** Darren Kandekore
- **Author URI:** [darrenk.uk](http://darrenk.uk)

---

**Note:** Always ensure you have appropriate permissions and consents when accessing user accounts. Use this plugin responsibly and in compliance with all applicable laws and regulations.