<?php
/**
 * WHMCS - Client Credit Balance (Multilingual)
 * 
 * Adds a "Credit Balance" panel to the client area homepage with multilingual support.
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
        
        // Get translations for available credit and add funds button.
        $availableCreditLabel = Lang::trans('availcreditbal'); // Available Credit Balance label
        $availableCreditDesc = Lang::trans('availcreditbaldesc'); // Credit balance description
        $addFundsText = Lang::trans('addfunds'); // Add Funds button text
        
        // Prepare the body HTML using translations.
        $bodyHtml = '<p>' . sprintf($availableCreditDesc, $formattedCredit) . '</p>';
        
        // Add the "Credit Balance" panel to the homepage panels with translations.
        $homePagePanels->addChild('credit-balance', array(
            'label' => $availableCreditLabel,
            'icon'  => 'fa-money-bill-alt',
            'order' => 1,  // Set to 1 to make it appear at the top
            'bodyHtml' => $bodyHtml,
            'footerHtml' => '<a href="clientarea.php?action=addfunds" class="btn btn-primary">' . $addFundsText . '</a>'
        ));
    }
});
