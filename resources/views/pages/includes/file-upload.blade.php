
<form
    enctype="multipart/form-data"
    method="POST"
    action="{{ $formData['action'] }}"
    onsubmit="disableSubmit()"
>
    @csrf
    @if($formData['isLate'] ?? false)
        <input type="hidden" name="late" value="1" />
    @endif
    <label class="file-upload">
        Choose .csv file...
        <span id="chosen-filename"></span>
        <input
            type="file"
            name="{{ $formData['inputName'] }}"
            onchange="getFilename(this)"
            {{-- accept="text/csv" --}}
        />
    </label>
    <br>
    <button type="submit" class="disabled" disabled>
        Submit
    </button>
    @include('pages.includes.errors')
    @include('pages.includes.emails-queued')
</form>
