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

                <form
                    enctype="multipart/form-data"
                    method="POST"
                    action="{{ route('import-invoices') }}"
                >
                    @csrf
                    <input type="hidden" name="late" value="1" />
                    <label>
                        Upload .csv file<br>
                        <input
                            type="file"
                            name="csv_invoices"
                            {{-- accept="text/csv" --}}
                        />
                    </label>
                    <br>
                    <button type="submit">
                        Submit
                    </button>
                    @include('pages.includes.errors')
                    @include('pages.includes.emails-queued')
                </form>
            </section>
        </div>
    </body>
</html>
