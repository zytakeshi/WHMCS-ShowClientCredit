# WHMCS Show Client Credit

Simple WHMCS hook that adds a **Credit Balance** panel to the client-area
homepage when the logged-in client has a positive credit balance.

## Tested Version

Tested on WHMCS 8.7.3.

## Installation

Copy `showCredit.php` to:

```text
/path/to/whmcs/includes/hooks/showCredit.php
```

## Behavior

- Uses the `ClientAreaHomepagePanels` hook.
- Reads the logged-in client from `Menu::context("client")`.
- Displays the balance using WHMCS `formatCurrency()`.
- Uses WHMCS language keys for the panel label, description, and Add Funds
  button, so it follows the installed client language files.
