@component('mail::message')
# Introduction

The body of your message.

- one
- two
- three

@component('mail::button', ['url' => 'www.facebook.com'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
    Here's you go!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
