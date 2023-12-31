<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Form;
use App\Models\GradeSetting;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    public function store(Request $request)
    {
        $current_session = Configuration::where('name', 'current_session')->first()?->value;
        $current_term = Configuration::where('name', 'current_term')->first()?->value;
        $student_ids = $request->student_ids;
        $form_id = $request->form_id;
        $arm_id = $request->arm_id;
        $subject_id = $request->subject_id;
        $ca1_scores = $request->ca1_scores;
        $ca2_scores = $request->ca2_scores;
        $ca3_scores = $request->ca3_scores;
        $exam_scores = $request->exam_scores;

        $count_students = count($student_ids);
        for ($i = 0; $i<$count_students; $i++)
        {
            $student_id = $student_ids[$i];
            $student_section = Student::where('id', $student_id)->get('section_id')->first();
            $ca1_score = $ca1_scores[$i];
            $ca2_score = $ca2_scores[$i];
            $ca3_score = $ca3_scores[$i];
            $exam_score = $exam_scores[$i];
            $total_score = $ca1_score + $ca2_score + $ca3_score + $exam_score;
            $grade_id = GradeSetting::match(['section_id' => $student_section->section_id, 'form_id' => $form_id])->where('min_score', '<=', $total_score)->where('max_score', '>=', $total_score)->first()?->id;

            Result::updateOrCreate(['session_id' => $current_session, 'term_id' => $current_term, 'student_id' => $student_id, 'subject_id' => $subject_id], ['session_id' => $current_session, 'term_id' => $current_term, 'form_id' => $form_id, 'arm_id' => $arm_id, 'student_id' => $student_id, 'subject_id' => $subject_id, 'ca1_score' => $ca1_score, 'ca2_score' => $ca2_score, 'ca3_score' => $ca3_score, 'exam_score' => $exam_score, 'total_score' => $total_score, 'grade_id' => $grade_id]);
        }

        return back()->with('message', 'Scores Saved');
    }

    public function print(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'form_id' => 'required',
            'arm_id' => 'required',
            'session_id' => 'required',
            'term_id' => 'required'
        ]);

        $meta = [
            'session' => Session::find($request->session_id)?->name,
            'term' => Term::find($request->term_id)?->name,
            'result_form' => Form::find($request->form_id)?->name
        ];

        $dompdf = Pdf::setOptions(['isRemoteEnabled' => true]); /*->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );*/

        if ($request->admission_number)
        {
            $student = Student::where('admission_number', $request->admission_number)->with(['results' => function ($query) use ($request) {
                $query->where('session_id', $request->session_id);
                $query->where('term_id', $request->term_id);
                $query->where('form_id', $request->form_id);
                $query->where('arm_id', $request->arm_id);
            }])->first();
            $pdf = $dompdf->loadView('printouts.result', ['student' => $student, 'meta' => $meta]);
            return $pdf->download('result.pdf');
        }

        $student_ids = Result::where('session_id', $request->session_id)
        ->where('term_id', $request->term_id)
        ->where('form_id', $request->form_id)
        ->where('arm_id', $request->arm_id)
        ->pluck('student_id')
        ->unique()
        ->toArray();
        $students = Student::whereIn('id', $student_ids)->with(['results' => function ($query) use ($request) {
            $query->where('session_id', $request->session_id);
            $query->where('term_id', $request->term_id);
            $query->where('form_id', $request->form_id);
            $query->where('arm_id', $request->arm_id);
        }])->get();
        $pdf = $dompdf->loadView('printouts.result_all', ['students' => $students, 'meta' => $meta]);
        return $pdf->download('class_result.pdf');
    }
}
