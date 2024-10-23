@component('mail::message')
<div style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 12px !important; width: 70%; margin-right:0; margin-left: auto;">
		Hallo, {{ $LFP }}!<br><br>
		vielen Dank für Ihre Nachricht and Ihr Interesse an unserem Weingut.<br><br>
		Wir haben Ihre Bestellung unter der Bestellnummer <i>{{ $orderNumberStr }}</i> erhalten und werden Sie in
		Kürze
		kontaktieren.
</div>
<div style="text-align: center; font-size: 1.25rem; border: 0.0625rem solid #000000; border-top: none; width: 70%; margin-right:0; margin-left: auto;">Prüfen Sie
		die Zusammenfassung:</div>

<div style="border: 0.0625rem solid #000000; border-top: none; font-size: 1.25rem!important; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		<em>Bestellung vom: </em> <strong>{{ $createdAt }}</strong><br>
		<em>Zahlungsart: </em> <strong> {{ $paymentOption }}</strong><br>
		<em>Vorname und Nachname: </em> <strong> {{ $LFP }}</strong><br>
		<em>Land: </em> <strong> {{ $country }}</strong><br>
		<em>Adresse: </em> <strong>{{ $address }}</strong><br>
		@if ($zipCode)
				<em>PLZ: </em> <strong>{{ $zipCode }}</strong><br>
		@endif
		<em>Telefon: </em> <strong>{{ $phone }}</strong><br>
		<em>E-Mail: </em> <strong>{{ $email }}</strong><br><br>
</div>

<div
		style="text-align: center; font-size: 1.25rem; border: 0.0625rem solid #000000; border-top: none; border-bottom: none; width: 70%; margin-right:0; margin-left: auto;">
		Bestellbericht</div>

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
		<em>Zwieschensumme: </em> <strong>{{ $orderData->getSummaryPrice() }} €</strong><br>
		<em>Versand: </em> <strong>{{ $deliveryPrice }} €</strong><br>
		<em>Gesamtsumme: </em> <strong>{{ $orderData->getSummaryPrice() + $orderData->delivery_price }}
				€</strong><br>
</div>
<div
		style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 8px!important; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		<em>Bestellstatus: </em> <strong>{{ $status }}</strong><br>
		<em>Lieferung: </em> <strong>{{ $delivery }}</strong><br>
</div>

<div
		style="border: 0.0625rem solid #000000; font-size: 1.25rem!important; padding: 8px!important; border-top: none; padding: 14px !important; width: 70%; margin-right:0; margin-left: auto;">
		Bei Fragen stehen wir jederzeit zur Verfügung.
		Telefonischer Kontakt: +4915156959421<br><br>
		Viele Grüße,<br>
		Irina Akimova und Philipp Franzen<br><br>
		<a href="www.steilgut.wine" alt="Steilgut" title="Steilgut">www.steilgut.wine</a>
</div>
@endcomponent
