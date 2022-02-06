@php
$nav = [
    ['route' => 'prompt-invoices', 'title' => 'Send Invoices'],
    ['route' => 'preview-invoice-email', 'title' => 'Preview Invoice Email'],
    ['route' => 'preview-invoice-pdf', 'title' => 'Preview Invoice PDF'],
    ['route' => 'prompt-invoice-reminders', 'title' => 'Send Reminder Invoices'],
    ['route' => 'preview-invoice-reminder-email', 'title' => 'Preview Reminder Invoice Email'],
    ['route' => 'prompt-receipts', 'title' => 'Send Receipt'],
    ['route' => 'preview-receipt-email', 'title' => 'Preview Receipt Email'],
    ['route' => 'preview-receipt-pdf', 'title' => 'Preview Receipt PDF']
];
@endphp
<nav>
    <ul>
        @foreach($nav as $page)
            <li>
                <a href="{{ route($page['route']) }}"
                    @class([
                        'active' => $active === route($page['route'])
                    ])
                >
                    {{ $page['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
