@component('mail::message')
Dear, **Steilgut**! 

A new notification from **{{ $userNotification['LFP'] }}** (e-mail: {{ $userNotification['email'] }}).

*Message Text*
@component('mail::panel')

    {{ $userNotification['message'] }}

@endcomponent

Best regard, 
*{{ $userNotification['LFP'] }}*

@endcomponent