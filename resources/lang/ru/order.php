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
    'header' => 'Оформление заказа',
    'paymentSelectionHeader' => 'Выберете способ оплаты',
    'summaryHeader' => 'Обзор заказа', // Обзор заказа

    'deliveryOptions' => 'Выберете способ доставки',
    'notFixedDeliveryPrice' => 'Стоимость доставки обсуждается индивидуально',

    'deliveryAddressDifferenciesTitle' => 'Адрес доставки отличается от адреса выставления счёта',

    'wineryDeliveryHeader' => 'Забрать заказ из винодельни',
    'courierDeliveryHeader' => 'Оформить курьерскую доставку',
    'mailDeliveryHeader' => 'Доставить почтой',


    'paymentHeader' => 'Выберите способ оплаты',
    'bankAccountPaymentHeader' => 'Оплата переводом на банковский счёт',
    'cardPaymentHeader' => 'Оплата картой',
    'paypalPaymentHeader' => 'Оплата онлайн кошельком',

    'goToSummary' => 'Обзор',
    'subtotalPrice' => 'Промежуточный итог',
    'summaryDelivery' => 'Доставка',
    'summary' => 'Сумма',
    'paymentOption' => 'Способ оплаты',

    'bankTransferAnnouncement' => 'При выборе этого способы оплаты, мы пришлем Вам номер банковского счёта на электонную почту, после оформления заказа',
    'cardPaymentAnnouncement' => 'Мы работает с полной предоплатой. Оплатить можно картой Visa, Mastercard.',
    'paypalPaymentAnnouncement' => 'Мы работает с полной предоплатой. Оплатить можно онлайн-кошельком Paypal.',
    'paypalCheckoutAnnouncement' => 'Вы будете перенаправлены на страничку оплаты Paypal',
    'agreementTitle' => 'Даю согласие на обработку персональных данных',

    'successfullOrderCreation' => "Номер Вашего заказа :order_number.",
    'failedOrderCreation' => 'Произошла ошибка создания заказа: :error_msg. Код ошибки :error_code.',

    'stripeErrorText' => 'Ошибка. Невозможно провести инициализацию компонента карты.',
    'stripe3dSecureHeader' => "Stripe 3D Secure. Пожалуйста, пройдите дополнительные шаги безопасности Вашего Банка.",

    'failedPaymentAppovalText' => "Извините, Ваш платеж не прошел. Заказ :order_number будет удален.",
    'successfulPaymentText' => "Спасибо, :lfp. Нам была зачислена оплата в размере :amount :currency.",

    'payTitle' => 'Оплатить',
    'createOrderTitle' => 'Оформить заказ',

    'back' => 'Назад',
    'summary' => 'Итого',
    'gotoPay' => 'Перейти к оплате',
    'priceHeader' => 'Стоимость заказа:',
    'deliveryPriceHeader' => 'Стоимость доставки:',

    'tooManyPersonErrorMsg' => 'Found more than one person in DB with the same email',

    'orderCreationErrorMsg' => 'Извините. Не удалось создать заказ. Произошла ошибка. Обратитесь к системному администратору.',
    'orderCreationSuccessfulMsg' => 'Ваш заказ № :order_number оформлен. По оставленным контактным данным в течение рабочего дня с вами свяжется менеджер для уточнения деталей заказа.',

    'cancellation' => "Ваш платеж был отменен!",

    'statusHeader' => 'Статус заказа',

    /* Email the order to client */
    'emailHeader' => 'Заказ номер',
    'emailSubtotalTableHeader' => 'Количество',
    'emailPriceTableHeader' => 'Стоимость',
    'emailPriceSummary' => 'Итого',

    'openStatus' => 'Открыт',
    'paiedStatus' => 'Оплачен',
    'closedStatus' => 'Закрыт',
    'unknownStatus' => 'Статус неизвествен',
    /* END: Email the order to client */
];
