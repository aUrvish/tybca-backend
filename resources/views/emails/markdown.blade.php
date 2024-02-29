<x-mail::message>
# Reminder to complete registration


Hello {{$name}},

Welcome in <a href="#">Ventures</a>!

You will be able to login to your account using the credentials below:
Username : {{$username}}
Password : {{$password}}

Note : Please change password first after login to your account

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
