@component('mail::message')
Hallo, {{ $LFP }}!

vielen Dank für Ihre Nachricht and Ihr Interesse an unserem Weingut.

Wir haben Ihre Bestellung unter der Bestellnummer *{{ $orderNumberStr }}* erhalten und werden Sie in Kürze
kontaktieren.

*Prüfen Sie die Zusammenfassung:*

@component('mail::panel')

<pre>
<em>Zwischensumme: </em> <strong>{{ $price }} €</strong><br>
<em>Versand: </em> <strong>{{ $deliveryPrice }} €</strong><br>
<em>Gesamtsumme: </em> <strong>{{ $summary }} €</strong><br>
<em>Land: </em> <strong>{{ $country }}</strong><br>
<em>Addresse: </em> <strong>{{ $address }}</strong><br>
@if ($zipCode)
<em>PLZ: </em> <strong>{{ $zipCode }}</strong><br>
@endif
<em>Telefon: </em> <strong>{{ $phone }}</strong><br>
<em>Bestellstatus: </em> <strong>{{ $status }}</strong><br>
<em>Wählen Sie eine Zahlungsart: </em> <strong>{{ $delivery }}</strong><br>
</pre>

@endcomponent

Viele Grüße,

Irina Akimova und Philipp Franzen

PS: Das Leben ist zu kurz, um schlechten Wein zu trinken.
@endcomponent
