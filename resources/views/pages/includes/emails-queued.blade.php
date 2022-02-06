@if (session('queued'))
    <p>{{ session('queued') }} emails have been queued to send.</p>
@endif
