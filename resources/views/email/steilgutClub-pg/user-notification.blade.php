@component('mail::message')
    Dear, **Steilgut**!<br/><br/>My name is **{{ $customer['LFP'] }}**.<br />I would like to **register** in your **Steilgut Club**.<br /><hr /><br />**Short Info**<br />*Email*: {{ $customer['email'] }}<br />*Phone*: {{ $customer['phone'] }}<br /><hr /><br />Best regard,*{{ $customer['LFP'] }}*
@endcomponent
