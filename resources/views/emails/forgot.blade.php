@component('mail::message')
Dear {{ $user->first_name.' '.$user->last_name }},

<p>We understand it happens. </p>

@component('mail::button', ['url'=>url('password-reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have issues recovering your password, please contact us. </p>

Kind Regards,<br>
{{ config('app.name') }}
@endcomponent