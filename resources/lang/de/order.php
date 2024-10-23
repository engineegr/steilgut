<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    // 'header' => 'Weiter zur Kasse', // Оформление заказа
    'header' => 'Ihre Versandadresse',
    'paymentSelectionHeader' => 'Zahlungsart wählen',
    'summaryHeader' => 'Bestellübersicht', // Обзор заказа

    'reportHeader' => 'Order',

    'deliveryOptions' => 'Wählen Sie eine Zahlungsart',
    'notFixedDeliveryPrice' => 'Versandkosten werden individuell bestimmt',

    'deliveryAddressDifferenciesTitle' => 'Lieferadresse weicht von Rechnungsadresse ab',

    'wineryDeliveryHeader' => 'Bestellung im Weingut abholen',
    'courierDeliveryHeader' => 'Form a courier delivery',
    'mailDeliveryHeader' => 'Per Post liefern',

    'paymentHeader' => 'Zahlungsart wählen',
    'bankAccountPaymentHeader' => 'Kauf per Rechnung',
    'cardPaymentHeader' => 'Zahlung per Kreditkarte',
    'paypalPaymentHeader' => 'Pay-Pall',

    'goToSummary' => 'Übersicht',

    'createOrderTitle' => 'Zahlungspflichtig bestellen',
    'subtotalPrice' => 'Zwischensumme',
    'summaryDelivery' => 'Versand',
    'summary' => 'Gesamtsumme',
    'paymentOption' => 'Zahlungsart',

    'bankTransferAnnouncement' => 'Wenn Sie diese Zahlungsmethode wählen, senden wir Ihnen nach Ihrer Bestellung Ihre Rechnung per E-Mail.',
    'cardPaymentAnnouncement' => 'Wir bieten Vorkasse oder Kreditkarte als Zahlungsweise an.',
    'paypalPaymentAnnouncement' => 'Мы работает с полной предоплатой. Оплатить можно онлайн-кошельком Paypal.',
    'paypalCheckoutAnnouncement' => 'You will be redirected to the PayPal checkout page.',

    'ruleAgreementTitle' => 'Ich habe die Allgemeinen Geschäftsbedingungen, die Datenschutzerklärung und die Widerrufsbelehrung gelesen und akzeptiere diese.',
    'agreementTitle' => 'Ich stimme zu, dass meine persönlichen Daten an den Versanddienstleister übermittelt werden.',
    'notificationAgreementTitle' => 'Bitte informieren sie mich über neue Weine in einem Newsletter an die oben angegebene E-Mail-Adress. (optinal)',

    'successfullOrderCreation' => "Ihre Bestellnummer :order_number.",
    'failedOrderCreation' => 'Failure to create the order: :error_msg. Error code :error_code',

    'stripeErrorText' => 'Fehler, die Kartendaten konnten nicht gelesen werden.',
    'stripe3dSecureHeader' => "Bitte folgen Sie den nächsten Schritten zur Authentifizierung bei Ihrer Bank.",

    'failedPaymentAppovalText' => "Ihre Bestellung wurde nicht bestätigt. Die :order_number wird entfernt.",
    'successfulPaymentText' => 'Vielen Dank, :lfp. Wir haben die Zahlung :amount :currency.',

    'summary' => 'Gesamtsumme',
    'back' => 'Zurück',
    'gotoPay' => 'Zahlungsart wählen',
    'priceHeader' => 'Zwischensumme:',
    'deliveryPriceHeader' => 'Versand:',

    'tooManyPersonErrorMsg' => 'Found more than one person in DB with the same email',
    'orderCreationErrorMsg' => 'Beim Erstellen der Bestellung ist ein Fehler aufgetreten. Bitte melden Sie telefonisch bei uns.',
    'orderCreationSuccessfulMsg' => 'Wir haben Ihre Bestellung unter der Bestellnummer :order_number erhalten und werden Sie in Kürze kontaktieren.',

    'confirmation' => 'Vielen Dank für Ihre Bestellung! Eine Bestätigung wurde Ihnen per E-Mail zugesandt. Wir werden uns innerhalb der nächsten 24 Stunden bei Ihnen melden.',
    'cancellation' => "Ihre Zahlung wurde storniert!",

    'statusHeader' => 'Bestellstatus',

    /* Email the order to client */
    'emailHeader' => 'Bestellnummer',
    'emailSubtotalTableHeader' => 'Menge',
    'emailPriceTableHeader' => 'Zwischensumme',
    'emailPriceSummary' => 'Gesamtsumme',

    'openStatus' => 'Die Bestellung wurde erstellt',
    'paiedStatus' => 'Die Ware wurde bezahlt',
    'closedStatus' => 'Die Bestellung wurde abgeschickt',
    'unknownStatus' => 'Der Bestellstatus ist unbekannt',
    /* END: Email the order to client */
];
