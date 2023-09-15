<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Applicant extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Searchable;
    protected $fillable = [
        'application_number',
        'first_name',
        'middle_name',
        'surname',
        'email',
        'dob',
        'gender',
        'nationality',
        'state',
        'lga',
        'address',
        'religion',
        'parent_name',
        'parent_occupation',
        'phone_number',
        'health_status',
        'health_status_description',
        'disability',
        'blood_group',
        'genotype',
        'allergies',
        'height',
        'passport',
        'session_id',
        'term_id',
        'applied_section_id',
        'applied_form_id',
        'applied_arm_id',
        'section_id',
        'form_id',
        'arm_id',
        'status',
        'password',
        'final_submission'
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => "{$att['first_name']} {$att['middle_name']} {$att['surname']}");
    }

    public function appliedSectionName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Section::find($att['applied_section_id'])?->name);
    }

    public function appliedFormName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Form::find($att['applied_form_id'])?->name);
    }

    public function sectionName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Section::find($att['section_id'])?->name);
    }

    public function formName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Form::find($att['form_id'])?->name);
    }

    public function armName(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Arm::find($att['arm_id'])?->name);
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'application_id', 'id');
    }

    public function admissionNumber(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => Student::where('application_id', $att['id'])->first()?->admission_number);
    }

    public function getFeesPaidAttribute()
    {
        $config = app('configs');
        $fees_paid = [];
        $invoices = Invoice::where('owner_type', 'applicant')
        ->where('owner_id', $this->id)
        ->where('status', 'paid')
        ->where('session_id', $config['current_session'])
        ->get();
        foreach($invoices as $invoice)
        {
            $fees_paid[] = $invoice->invoice_type;
        }
        return implode(',', $fees_paid);
    }
}
