@component('mail::message')
Dear, **Steilgut**! 

My name is **{{ $degustation['LFP'] }}**.
I would like to **register** on a degustation.

*Detailed Info*
@component('mail::panel')
<pre>
<em>Email:</em>  <strong>{{ $degustation['email'] }}</strong><br>
<em>Phone:</em>  <strong>{{ $degustation['phone'] }}</strong><br>
<em>Place:</em>   <strong>{{ $degustation['place'] }}</strong><br>
<em>Date:</em>   <strong>{{ $degustation['date'] }}</strong><br>
<em>Time:</em>   <strong>{{ $degustation['time'] }}</strong><br>
</pre>
@endcomponent

Best regard, 
*{{ $degustation['LFP'] }}*
@endcomponent