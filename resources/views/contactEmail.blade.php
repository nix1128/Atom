@component('mail::message')
    # Contact Form

    <p>From: {{ $details['name'] }}</p>

    <p>Email: {{ $details['email'] }}</p>


    {{ $details['phone'] }}
    {{ $details['message'] }}
    Thanks,<br>

@endcomponent
