@component('mail::message')
    Hallo, {{ $userNotification['LFP'] }}!

    vielen Dank für Ihre Nachricht and Ihr Interesse an unserem Weingut.
    Wir antworten Ihnen in den nächsten Tagen per Email an {{ $userNotification['email'] }}.

    Viele Grüße,

    Irina Akimova und Philipp Franzen

    PS: Das Leben ist zu kurz, um schlechten Wein zu trinken.
@endcomponent
