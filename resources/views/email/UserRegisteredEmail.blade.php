@component('mail::message')
    You registered at {{ $site_mame }}

    You entered {{ $user->email }} e-mail,

    Your confirmation code : {{ $confirmation_code }}

    Fill it to complete registration


    Best regards,
    {{ config('app.name') }}
@endcomponent

