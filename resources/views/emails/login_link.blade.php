@component('mail::message')
    # Your Login Link

    Here's the link you requested:

    @component('mail::button', ['url' => $user->createPasswordlessLoginLink()])
        Click Here
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
