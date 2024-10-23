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
    'header' => 'Ordering',
    'paymentSelectionHeader' => 'Zahlungsart wählen',
    'summaryHeader' => 'Order summary', // Обзор заказа

    'reportHeader' => 'Order',

    'deliveryOptions' => 'Choose delivery options',
    'notFixedDeliveryPrice' => 'Delivery cost is negotiated personally',

    'wineryDeliveryHeader' => 'Take the order from the winery',
    'courierDeliveryHeader' => 'Form a courier delivery',
    'mailDeliveryHeader' => 'Deliver by a mail service',

    'paymentHeader' => 'Choose a payment option',
    'bankAccountPaymentHeader' => 'Transfer to a bank account',
    'cardPaymentHeader' => 'Credit card payment',
    'paypalPaymentHeader' => 'Paypal',

    'goToSmmary' => 'Summary', // Обзор заказа
    'subtotalPrice' => 'Subtotal price',
    'summaryDelivery' => 'Delivery',
    'summary' => 'Summary',
    'paymentOption' => 'Payment option',

    'bankTransferAnnouncement' => 'При выборе этого способы оплаты, мы пришлем Вам номер банковского счёта на электонную почту, после оформления заказа',
    'cardPaymentAnnouncement' => 'Мы работает с полной предоплатой. Оплатить можно картой Visa, Mastercard.',
    'paypalPaymentAnnouncement' => 'Мы работает с полной предоплатой. Оплатить можно онлайн-кошельком Paypal.',
    'paypalCheckoutAnnouncement' => 'You will be redirected to the PayPal checkout page.',
    'agreementTitle' => 'Даю согласие на обработку персональных данных',

    'successfullOrderCreation' => "Номер Вашего заказа :order_number.",
    'failedOrderCreation' => 'Failure to create the order: :error_msg. Error code :error_code',

    'stripeErrorText' => 'Ошибка. Невозможно провести инициализацию компонента карты.',
    'stripe3dSecureHeader' => "Stripe 3D Secure. Please, follow some security steps with your bank authentication.",

    'failedPaymentAppovalText' => "Sorry, your payment has not been approved. Order with number :order_number will be removed",
    'successfulPaymentText' => "Thanks, :lfp. We received your :amount :currency payment.",

    'summary' => 'Summary',
    'back' => 'Back',
    'gotoPay' => 'Go to pay',
    'priceHeader' => 'Order price:',
    'deliveryPriceHeader' => 'Delivery price:',

    'tooManyPersonErrorMsg' => 'Found more than one person in DB with the same email',
    'orderCreationErrorMsg' => 'Sorry. Couldn\'t create the order. Error has occurred. Please, contact our system adminsitrator',

    'confirmation' => 'Your order number is :order_nomber. You will be contacted shortly by our manager.',
    'cancellation' => "Your payment was cancelled!",

    'statusHeader' => 'Order status',

    /* Email the order to client */
    'emailHeader' => 'Order number',
    'emailSubtotalTableHeader' => 'Quantity',
    'emailPriceTableHeader' => 'Price',
    'emailPriceSummary' => 'Summary',

    'openStatus' => 'Opened',
    'paiedStatus' => 'Paied',
    'closedStatus' => 'Closed',
    'unknownStatus' => 'Unknown status',
    /* END: Email the order to client */
];
