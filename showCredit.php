<?php
/**
 * WHMCS - Client Credit Balance
 * 
 * Adds a "Credit Balance" panel to the client area homepage.
 */

use WHMCS\View\Menu\Item as Item;

add_hook('ClientAreaHomepagePanels', 1, function (Item $homePagePanels) {
    // Get the client information from the session.
    $client = Menu::context("client");

    // Check if client is logged in and has available credit.
    if ($client && isset($client->credit) && $client->credit > 0) {
        
        // Retrieve the client's currency.
        $clientId = (int) $client->id;
        $currency = getCurrency($clientId);
        
        // Format the credit balance.
        $formattedCredit = formatCurrency((float)$client->credit, $currency);
        
        // Add the "Credit Balance" panel to the homepage.
        $homePagePanels->addChild('credit-balance', array(
            'label' => 'Available Credit',
            'icon'  => 'fa-money-bill-alt',
            'order' => 100,
            'bodyHtml' => '<p>Your available credit is: ' . $formattedCredit . '</p>',
            'footerHtml' => '<a href="clientarea.php?action=addfunds" class="btn btn-primary">Add Funds</a>'
        ));
    }
});
