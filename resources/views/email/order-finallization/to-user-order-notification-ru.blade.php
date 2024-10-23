@component('mail::message')
Здравствуйте, {{ $LFP }}! 

Благодарим Вас за интерес к нашей винодельне. Номер Вашего заказа - *{{ $orderNumberStr }}*.

Детальная информация по Вашему заказу представлена ниже.

@component('mail::panel')

<pre>
<em>Стоимость заказа: </em> <strong>{{ $price }} €</strong><br>
<em>Стоимость доставки: </em> <strong>{{ $deliveryPrice }} €</strong><br>
<em>Сумма: </em> <strong>{{ $summary }} €</strong><br>
<em>Страна: </em> <strong>{{ $country }}</strong><br>
<em>Указанный адрес: </em> <strong>{{ $address }}</strong><br>
<em>Индекс: </em> <strong>{{ $zipCode }}</strong><br>
<em>Телефон: </em> <strong>{{ $phone }}</strong><br>
<em>Статус заказа: </em> <strong>{{ $status }}</strong><br>
<em>Способ доставки: </em> <strong>{{ $delivery }}</strong><br>
</pre>

@endcomponent

С уважением, 
Ирина Акимова и Филипп Францен
@endcomponent