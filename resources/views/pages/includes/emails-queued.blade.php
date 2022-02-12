@if (array_key_exists('queued', $_GET))
    <p>{{ $_GET['queued'] }} emails have been queued to send.</p>
@endif
