<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ImportInvoiceCsvService
{
    private array $header;
    private array $content;
    private array $columnMap;

    public function setup(array $header, array $content): void
    {
        $this->header = $header;
        $this->content = $content;

        $this->mapHeaderToColumns();
    }

    public function validate()
    {
        $validator = Validator::make(
            [
                'header' => $this->header,
                'content' => $this->content
            ],
            $this->rules(),
            $this->errorMessages()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        return true;
    }

    private function mapHeaderToColumns(): void
    {
        foreach ($this->header as $i => $column) {
            $this->columnMap[$column] = $i;
        }
    }

    private function requiredFields(): array
    {
        return [
            'id',
            'full name',
            'prefix',
            'last name',
            'email',
            'address1',
            'city',
            'province',
            'postal code',
            'invoice date',
            'invoice number',
            'subscriber number',
            'fiscal start date',
            'fiscal end date',
            'plan type',
            'amount',
            'due date',
        ];
    }

    private function expectedColumns(): array
    {
        return [
            'id',
            'full name',
            'prefix',
            'last name',
            'email',
            'address1',
            'address2',
            'city',
            'province',
            'postal code',
            'incorporation',
            'invoice date',
            'invoice number',
            'subscriber number',
            'fiscal start date',
            'fiscal end date',
            'plan type',
            'amount',
            'due date',
        ];
    }

    private function errorMessages(): array
    {
        return [
            'header.in' => 'Headers must be all of :values'
        ];
    }

    private function rules(): array
    {
        $columns = $this->expectedColumns();
        $rules = [
            'header' => 'required|array|size:'.count($columns).'|unique|in:'.implode(',', $columns),
            'content.*' => 'required|array|min:1',
        ];
        foreach ($this->columnMap as $column => $pos) {
            $rule = 'string';
            if (in_array($column, $this->requiredFields())) {
                $rule .= '|required|min:1';
            }
            $rules["content.*.{$pos}"] = $rule;
        }

        return $rules;
    }
}
