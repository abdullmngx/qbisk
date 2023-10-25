<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultExport implements FromCollection, WithHeadings
{
    public $students;
    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students;
    }

    public function headings(): array
    {
        return ['Admission Number', 'First Name', 'Middle Name', 'Surname', 'Ca1 Score', 'Ca2 Score', 'Test Score','Exam Score'];
    }
}
