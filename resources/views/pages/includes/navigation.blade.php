@php
$nav = [
    ['url' => '/invoice', 'title' => 'Send Invoices'],
    ['url' => '/preview/email/invoice', 'title' => 'Preview Invoice Email'],
    ['url' => '/preview/pdf/invoice', 'title' => 'Preview Invoice PDF'],
    ['url' => '/receipt', 'title' => 'Send Receipt'],
    ['url' => '/preview/email/receipt', 'title' => 'Preview Receipt Email'],
    ['url' => '/preview/pdf/receipt', 'title' => 'Preview Receipt PDF']
];
@endphp
<nav>
    <ul>
        @foreach($nav as $page)
            <li>
                <a href="{{ $page['url'] }}"
                    @class([
                        'active' => $active === $page['url']
                    ])
                >
                    {{ $page['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
