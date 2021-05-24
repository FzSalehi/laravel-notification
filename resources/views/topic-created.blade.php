@component('mail::message')
# {{$introduction}}

Hello {{$fullname}},

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
