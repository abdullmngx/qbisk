<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, Searchable;

    public function owner(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => $att['owner_type'] == 'applicant' ? Applicant::find($att['owner_id']) : Student::find($att['owner_id']));
    }

    public function InvoiceType(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => InvoiceType::find($att['invoice_type_id'])?->name);
    }

    public function sessionName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Session::find($att['session_id'])?->name);
    }

    public function termName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Term::find($att['term_id'])?->name);
    }

    public function formName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Form::find($att['form_id'])?->name);
    }
}
