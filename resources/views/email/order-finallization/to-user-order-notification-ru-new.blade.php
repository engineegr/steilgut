@component('mail::message')
<div style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 12px !important; width: 70%; margin-right:0; margin-left: auto;">
		Уважаемый, {{ $LFP }}!<br><br>
		Благодарим вас за заказ и интерес к нашей винодельне.<br><br>
		Номер вашего заказа <i>{{ $orderNumberStr }}</i>. Мы свяжемся с вами в ближайшее время.
</div>
<div style="text-align: center; font-size: 1.25rem; border: 0.0625rem solid #000000; border-top: none; width: 70%; margin-right:0; margin-left: auto;">Проверьте ваши данные:</div>

<div style="border: 0.0625rem solid #000000; border-top: none; font-size: 1.25rem!important; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		<em>Дата и время заказа: </em> <strong>{{ $createdAt }}</strong><br>
		<em>Способ оплаты: </em> <strong> {{ $paymentOption }}</strong><br>
		<em>Фамилия Имя Отчество: </em> <strong> {{ $LFP }}</strong><br>
		<em>Страна: </em> <strong> {{ $country }}</strong><br>
		<em>Адрес: </em> <strong>{{ $address }}</strong><br>
		@if ($zipCode)
				<em>Индекс: </em> <strong>{{ $zipCode }}</strong><br>
		@endif
		<em>Телефон: </em> <strong>{{ $phone }}</strong><br>
		<em>E-Mail: </em> <strong>{{ $email }}</strong><br><br>
</div>

<div
		style="text-align: center; font-size: 1.25rem; border: 0.0625rem solid #000000; border-top: none; border-bottom: none; width: 70%; margin-right:0; margin-left: auto;">
		Детали заказа</div>

{{-- @component('mail::table')
| 			   |						   |   				|
|:------   |:-----------   |:-------- |
@foreach ($productList as $product)
|<span style="text-align: left; font-size: 1.25rem;">{{ $product->productable->shippedOrderReport1stColumn() . "\nPreis:" . $product->getFormatDiscountPrice() . "€"}}</span>|{{ "Anzahl: " . $orderData->getSubtotal($product->id) }}|{{ $orderData->getSummaryPriceById($product->id) }}|
@endforeach
@endcomponent --}}
<table style="border-collapse: collapse; width: 70%; margin-right:0; margin-left: auto;">
		<tbody>
				@foreach ($productList as $product)
						<tr>
								<td align="left"
										style="border: 0.0625rem solid #000000; padding: 14px !important; width: 20%; font-size: 1.25rem!important; border-collapse: collapse;">
										{{ $product->productable->getFormatHarvest() }}
										<br>
										{{ $product->productable->terroir }}
										<br>
										{{ $product->productable->title }}
										<br>
										{{ "Preis: " . $product->getFormatDiscountPrice() . ' €' }} 
								</td>
								<td align="left"
										style="border: 0.0625rem solid #000000; padding: 14px !important; font-size: 1.25rem!important; border-collapse: collapse; width: 25%;">
										{{ "Anzahl: " . $orderData->getSubtotal($product->id) }}</td>
								<td align="left"
										style="border: 0.0625rem solid #000000; padding: 14px !important; font-size: 1.25rem!important;border-collapse: collapse;">
										{{ $orderData->getSummaryPriceById($product->id) . ' €'}}</td>
						</tr>
				@endforeach
		</tbody>
</table>

<div
		style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 8px!important; border-top: none; border-bottom: none; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		<em>Промежуточный итог </em> <strong>{{ $orderData->getSummaryPrice() }} €</strong><br>
		<em>Стоимость доставки </em> <strong>{{ $deliveryPrice }} €</strong><br>
		<em>Общая сумма </em> <strong>{{ $orderData->getSummaryPrice() + $orderData->delivery_price }}
				€</strong><br>
</div>
<div
		style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 8px!important; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		<em>Статус заказа: </em> <strong>{{ $status }}</strong><br>
		<em>Тип доставки: </em> <strong>{{ $delivery }}</strong><br>
</div>

<div
		style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 8px!important; border-top: none; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		Мы будем рады ответить на ваши вопросы по телефону: +4915156959421<br><br>
		Ирина Акимова и Филипп Францен<br><br>
		<a href="www.steilgut.wine" alt="Steilgut" title="Steilgut">www.steilgut.wine</a>
</div>
@endcomponent
