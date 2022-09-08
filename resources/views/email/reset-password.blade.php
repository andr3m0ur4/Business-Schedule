@component('mail::message')
# Introduction

The body of your message. I'm André Moura.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
