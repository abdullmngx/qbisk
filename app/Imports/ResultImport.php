<?php

namespace App\Imports;

use App\Models\Configuration;
use App\Models\GradeSetting;
use App\Models\Result;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultImport implements ToModel, WithHeadingRow
{
    public $subject_id;

    public function __construct($subject_id)
    {
        $this->subject_id = $subject_id;
    }
    public function model(array $row)
    {
        $student = Student::where('admission_number', $row['admission_number'])->first();
        $current_session = Configuration::where('name', 'current_session')->first()?->value;
        $current_term = Configuration::where('name', 'current_term')->first()?->value;
        $total_score = intval($row['ca1_score']) + intval($row['ca2_score']) + intval($row['test_score']) + intval($row['exam_score']);
        $grade_id = GradeSetting::match(['section_id' => $student->section_id, 'form_id' => $student->form_id])->where('min_score', '<=', $total_score)->where('max_score', '>=', $total_score)->first()?->id;
        return Result::updateOrCreate(['session_id' => $current_session, 'term_id' => $current_term, 'student_id' => $student->id, 'subject_id' => $this->subject_id], ['session_id' => $current_session, 'term_id' => $current_term, 'form_id' => $student->form_id, 'arm_id' => $student->arm_id, 'student_id' => $student->id, 'subject_id' => $this->subject_id, 'ca1_score' => intval($row['ca1_score']), 'ca2_score' => intval($row['ca2_score']), 'ca3_score' => intval($row['test_score']), 'exam_score' => intval($row['exam_score']), 'total_score' => $total_score, 'grade_id' => $grade_id]);
    }
}
