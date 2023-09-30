@component('mail::message')
Dear {{ $user->first_name.' '.$user->last_name }},

<p>A new account has been created for you on {{ config('app.name') }}. <br> Click the button below to reset your password </p>

<p>Your email address: {{ $user->email }}</p>

@component('mail::button', ['url'=>url('password-reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have issues recovering your password, please contact us. </p>

Kind Regards,<br>
{{ config('app.name') }}
@endcomponent