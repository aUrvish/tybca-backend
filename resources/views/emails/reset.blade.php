<x-mail::message>
# Reset Password

Hi, {{$name}}

Forgot your password?

We received a request to reset the password for your account.

To reset your passwod, click on the link below:

<x-mail::button url="{{$link}}">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
