<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [];

    public function paymentCategory(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => PaymentCategory::find($att['payment_category_id'])?->short_name);
    }

    public function session(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => Session::find($att['session_id'])?->name);
    }

    public function term(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => Term::find($att['term_id'])?->name);
    }

    public function section(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => Section::find($att['section_id'])?->name);
    }

    public function form(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => Form::find($att['form_id'])?->name);
    }

    public function arm(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => Arm::find($att['arm_id'])?->name);
    }
}
