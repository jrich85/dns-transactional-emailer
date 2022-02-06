@php
$nav = [
    ['route' => route('prompt-invoices'), 'title' => 'Send Invoices'],
    ['route' => route('preview-invoice-email'), 'title' => 'Preview Invoice Email'],
    ['route' => route('preview-invoice-pdf'), 'title' => 'Preview Invoice PDF'],
    ['route' => route('prompt-invoice-reminders'), 'title' => 'Send Reminder Invoices'],
    ['route' => route('preview-invoice-reminder-email'), 'title' => 'Preview Reminder Invoice Email'],
    ['route' => route('prompt-receipts'), 'title' => 'Send Receipt'],
    ['route' => route('preview-receipt-email'), 'title' => 'Preview Receipt Email'],
    ['route' => route('preview-receipt-pdf'), 'title' => 'Preview Receipt PDF']
];
@endphp
<nav>
    <ul>
        @foreach($nav as $page)
            <li>
                <a href="{{ $page['route'] }}"
                    @class([
                        'active' => $active === $page['route']
                    ])
                >
                    {{ $page['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
