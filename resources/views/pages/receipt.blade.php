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

                <form
                    enctype="multipart/form-data"
                    method="POST"
                    action="{{ route('import-receipts') }}"
                >
                    @csrf
                    <label>
                        Upload .csv file<br>
                        <input
                            type="file"
                            name="csv_receipts"
                            {{-- accept="text/csv" --}}
                        />
                    </label>
                    <br>
                    <button type="submit">
                        Submit
                    </button>
                    @if (isset($errors) && count($errors))
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }} </li>
                            @endforeach
                        </ul>
                    @endif
                </form>
            </section>
        </div>
    </body>
</html>
