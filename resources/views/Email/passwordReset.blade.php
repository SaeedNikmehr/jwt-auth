@component('mail::message')
# change password

to reset your password , click on this button

@component('mail::button', ['url' => 'http://localhost/root/jwtApp/public/reset-password?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
