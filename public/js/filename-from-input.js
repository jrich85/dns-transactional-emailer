function getFilename(obj) {
    var placeholder = document.getElementById('chosen-filename');

    placeholder.innerHTML = '';

    var file = obj.value;
    var filename = file.split("\\");
    var actualFile = filename.pop();

    placeholder.innerHTML = actualFile;
    if (!!actualFile) {
        enableSubmit();
    }
}

function enableSubmit() {
    var button = document.querySelector('button[type="submit"]');

    button.removeAttribute('disabled');
    button.classList.remove('disabled');
}

function disableSubmit() {
    var button = document.querySelector('button[type="submit"]');

    button.setAttribute('disabled', "");
    button.classList.add('disabled');
}
