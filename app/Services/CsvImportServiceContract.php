<?php

namespace App\Services;

interface CsvImportServiceContract {
    public function setup(array $header, array $content);

    public function validate();

    public function sendEmails(): int;
}
