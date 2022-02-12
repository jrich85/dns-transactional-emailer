<?php
$formData = [
    'action' => route('import-receipts'),
    'inputName' => 'csv_receipts',
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
                <h1>Send Receipts</h1>
                @include('pages.includes.file-upload')
            </section>
        </div>
    </body>
</html>
