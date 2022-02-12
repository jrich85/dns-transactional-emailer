<?php
$formData = [
    'action' => route('import-invoices'),
    'inputName' => 'csv_invoices',
    'isLate' => true,
];
?>
<!DOCTYPE>
<html>
    <head>
        @include('pages.includes.head')
    </head>
    <body>
        <div class="wrapper">
            @include('pages.includes.header')
            <aside>
                @include('pages.includes.navigation')
            </aside>
            <section class="content">
                <h1>Send Reminder Invoices</h1>
                @include('pages.includes.file-upload')
            </section>
        </div>
    </body>
</html>
