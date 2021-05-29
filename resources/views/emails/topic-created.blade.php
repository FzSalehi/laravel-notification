@component('mail::message')
# {{$introduction}}

Hello {{$textview}},

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
