@component('mail::message')
Dear, **{{ $LFP }}**!

We glad to welcome to our store Steilgut (E-mail: *info@steilgut-weine.de*).
Your order number is **{{ $orderNumberStr }}**.

*Detailed Info*
@component('mail::panel')

<pre>
<em>Price: </em>  				<strong>{{ $price }} €</strong><br>
<em>Delivery: </em>  			<strong>{{ $deliveryPrice }} €</strong><br>
<em>Summary price: </em>  <strong>{{ $summary }} €</strong><br>
<em>Country: </em>        <strong>{{ $country }}</strong><br>
<em>Address: </em>        <strong>{{ $address }}</strong><br>
<em>Zip: </em>        		<strong>{{ $zipCode }}</strong><br>
<em>Phone: </em>        	<strong>{{ $phone }}</strong><br>
<em>Status: </em>         <strong>{{ $status }}</strong><br>
<em>Delivery: </em>       <strong>{{ $delivery }}</strong><br>
</pre>

@endcomponent

Best regard,
*Steilgut*
@endcomponent
