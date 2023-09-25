<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ArmController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GradeRemarkController;
use App\Http\Controllers\GradeSettingController;
use App\Http\Controllers\InvoiceTypeController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Announcement;
use App\Models\Invoice;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $announcement = Announcement::latest()->first();
    return view('home', ['announcement' => $announcement]);
});

Route::prefix('/staff')->group(function () {
    Route::get('/login', [StaffController::class, 'login'])->name('staff.login');
    Route::post('/login', [StaffController::class, 'authenticate'])->name('staff.authenticate');
    Route::get('/forgot', [StaffController::class, 'showForgot'])->middleware('guest')->name('password.request');
    Route::post('/forgot', [StaffController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
    Route::get('/reset/{token}', [StaffController::class, 'showReset'])->middleware('guest')->name('password.reset');
    Route::post('/reset', [StaffController::class, 'reset'])->middleware('guest')->name('password.update');

    Route::group(['middleware' => 'auth.staff'], function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        // Sections Routes
        Route::get('/sections', [StaffController::class, 'sections'])->name('staff.sections');
        Route::post('/sections', [SectionController::class, 'store'])->name('staff.sections.store');
        Route::post('/sections/update', [SectionController::class, 'update'])->name('staff.sections.update');
        Route::get('/sections/delete/{id}', [SectionController::class, 'destroy'])->name('staff.sections.delete');
        // Classes/Forms Routes
        Route::get('/classes', [StaffController::class, 'classes'])->name('staff.classes');
        // Arms Routes
        Route::get('/arms', [StaffController::class, 'arms'])->name('staff.arms');
        Route::post('/arms', [ArmController::class, 'store'])->name('staff.arms.store');
        Route::post('/arms/update', [ArmController::class, 'update'])->name('staff.arms.update');
        Route::get('/arms/delete/{id}', [ArmController::class, 'destroy'])->name('staff.arms.delete');
        //Subjects routes
        Route::get('/subjects', [StaffController::class, 'subjects'])->name('staff.subjects');
        Route::post('/subjects', [SubjectController::class, 'store'])->name('staff.subject.store');
        Route::post('/subjects/update', [SubjectController::class, 'update'])->name('staff.subject.update');
        Route::get('/subjects/delete/{id}', [SubjectController::class, 'destroy'])->name('staff.subject.destroy');
        //Grades Routes
        Route::get('grades', [StaffController::class, 'grades'])->name('staff.grades');
        Route::post('/grades', [GradeSettingController::class, 'store'])->name('staff.grade.store');
        Route::post('/grades/update', [GradeSettingController::class, 'update'])->name('staff.grade.update');
        Route::get('/grades/delete/{id}', [GradeSettingController::class, 'destroy'])->name('staff.grade.destroy');
        // Grade Remarks Routes
        Route::get('/grade-remarks', [StaffController::class, 'gradeRemarks'])->name('staff.grade.remarks');
        Route::post('/grade-remarks', [GradeRemarkController::class, 'store'])->name('staff.grade.remarks.store');
        Route::post('/grade-remarks/update', [GradeRemarkController::class, 'update'])->name('staff.grade.remarks.update');
        Route::get('/grade-remarks/delete/{id}', [GradeRemarkController::class, 'destroy'])->name('staff.grade.remarks.destroy');
        // General Remarks Route
        Route::get('/remarks', [StaffController::class, 'remarks'])->name('staff.remarks');
        Route::post('/remarks', [RemarkController::class, 'store'])->name('staff.remark.store');
        Route::post('/remarks/update', [RemarkController::class, 'update'])->name('staff.remark.update');
        Route::get('/remarks/delete/{id}', [RemarkController::class, 'destroy'])->name('staff.remark.destroy');
        //Student Routes
        Route::get('/students/add', [StaffController::class, 'addStudents'])->name('staff.student.add');
        Route::get('/students/view', [StaffController::class, 'viewStudents'])->name('staff.students.view');
        Route::post('/students/add', [StudentController::class, 'store'])->name('staff.student.store');
        Route::post('/students/update', [StudentController::class, 'update'])->name('staff.student.update');
        //Other Routes
        Route::get('/class-subjects', [StaffController::class, 'classSubjects'])->name('staff.class_subjects');
        Route::post('/class-subjects', [ClassSubjectController::class, 'store'])->name('staff.class_subjects.store');
        Route::post('/class-subjects/remove', [ClassSubjectController::class, 'destroy'])->name('staff.class_subjects.destroy');
        //Result routes
        Route::get('/result/upload', [StaffController::class, 'resultUpload'])->name('staff.result.upload');
        Route::post('/result/upload', [ResultController::class, 'store'])->name('staff.result.store');
        Route::get('/result/print', [StaffController::class, 'printResult'])->name('staff.result.print');
        Route::post('/result/print', [ResultController::class, 'print'])->name('result.print');
        //Config Routes
        Route::get('/configurations', [StaffController::class, 'configurations'])->name('staff.configurations');
        Route::post('/configurations', [Controller::class, 'saveConfig'])->name('staff.save_configurations');
        //staff ROutes
        Route::get('/staff/add', [StaffController::class, 'addStaff'])->name('staff.staff.add');
        Route::post('/staff/add', [StaffController::class, 'storeStaff'])->name('staff.staff.store');
        Route::get('/staff/view', [StaffController::class, 'viewStaff'])->name('staff.staff.view');
        Route::post('/staff/update', [StaffController::class, 'updateStaff'])->name('staff.staff.update');
        //Attendance Routes
        Route::get('/attendance/mark', [StaffController::class, 'markAttendance'])->name('staff.attendance.mark');
        Route::post('/attendance/mark', [AttendanceController::class, 'store'])->name('staff.attendance.store');
        Route::get('/attendance/view', [StaffController::class, 'viewAttendance'])->name('staff.attendance.view');

        // card routes
        Route::get('/cards', [StaffController::class, 'cards'])->name('staff.cards');
        Route::post('/cards', [CardController::class, 'store'])->name('saff.card.store');
        Route::get('/cards/clear-used', [CardController::class, 'destroy'])->name('staff.card.destroy');
        Route::post('/cards/print', [CardController::class, 'print'])->name('staff.card.print');

        Route::group(['prefix' => 'payments'], function () {
            Route::get('invoice-types', [InvoiceTypeController::class, 'index'])->name('staff.invoice_types');
            Route::post('invoice-types', [InvoiceTypeController::class,'store'])->name('staff.create_invoice_types');
            Route::post('invoice-types/update', [InvoiceTypeController::class,'update'])->name('staff.update_invoice_types');
            Route::get('/invoice-types/delete/{id}', [InvoiceTypeController::class,'delete'])->name('staff.delete_invoice_types');
            Route::get('/invoice/confirm', [StaffController::class,'confirmPayment'])->name('staff.confirm_payment');
            Route::get('/invoice/confirm/{invoice_id}', [StaffController::class,'confirmInvoice'])->name('staff.confirm_invoice');
        });

        Route::group(['prefix' => 'applicants'], function () {
            Route::get('/', [StaffController::class, 'applicants'])->name('staff.applicants');
            Route::get('/{applicant_id}', [StaffController::class, 'applicant'])->name('staff.applicant');
            Route::post('/{applicant_id}', [StaffController::class, 'admitApplicant'])->name('staff.admit_applicant');
        });

        Route::get('announcements', [StaffController::class, 'announcements'])->name('staff.announcements');
        Route::post('announcements', [StaffController::class, 'saveAnnouncement'])->name('staff.save_announcement');
        Route::get('announcements/delete/{id}', [StaffController::class, 'deleteAnnouncement'])->name('staff.deleteAnnouncement');
        //logout
        Route::get('/logout', [StaffController::class, 'logout'])->name('staff.logout');
    });
});

Route::prefix('applicationportal')->group(function () {
    Route::get('/apply', [ApplicantController::class, 'index'])->name('applicant.apply');
    Route::post('/apply', [ApplicantController::class,"store"])->name('applicant.create');
    Route::get('/login', [ApplicantController::class,"login"])->name('applicant.login');
    Route::post('login', [ApplicantController::class,"authenticate"])->name('applicant.auth');

    Route::group(["middleware"=> "auth.applicant"], function () {
        Route::get("/dashboard", [ApplicantController::class,"dashboard"])->name('applicant.dashboard');
        Route::get("/profile", [ApplicantController::class,"profile"])->name("applicant.profile");
        Route::post("/profile", [ApplicantController::class,"update"])->name("applicant.update_profile");
        Route::get('/payments', [ApplicantController::class,'payments'])->name('applicant.payments');
        Route::post('/payments', [ApplicantController::class,'generateInvoice'])->name('applicant.generate_invoice');
        Route::get('/invoices/{invoice_id}', [ApplicantController::class,'viewInvoice'])->name('applicant.view_invoice');
        Route::get('/invoices/print/{invoice_id}', [ApplicantController::class,'printInvoice'])->name('applicant.print_invoice');
        Route::get('/admission', [ApplicantController::class,'admission'])->name('applicant.admission');
        Route::get("/logout", [ApplicantController::class, "logout"])->name("applicant.logout");
    });
});

Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'showLogin'])->name('student.login');
    Route::post('/login', [StudentCOntroller::class, 'authenticate'])->name('student.authenticate');

    Route::middleware(['auth.student'])->group(function () {
        Route::get('dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        Route::get('/payments', [StudentController::class,'payments'])->name('student.payments');
        Route::post('/payments', [StudentController::class,'generateInvoice'])->name('student.generate_invoice');
        Route::get('/result', [StudentController::class, 'result'])->name('student.result');
        Route::post('/result', [StudentController::class, 'printResult'])->name('student.print_result');
        Route::get('/invoices/{invoice_id}', [StudentController::class,'viewInvoice'])->name('student.view_invoice');
        Route::get('/invoices/print/{invoice_id}', [StudentController::class,'printInvoice'])->name('student.print_invoice');
        //logout
        Route::get('logout', [StudentController::class, 'logout'])->name('student.logout');
    });
});

Route::get('/payment/done', function () {
    $invoice_number = request()->get('tx_ref');
    $transaction_id = request()->get('transaction_id');
    $status = request()->get('status');

    $verification = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer '. env('FLUTTERWAVE_SECRET')
    ])
    ->get('https://api.flutterwave.com/v3/transactions/'.$transaction_id.'/verify')
    ->json();
    if ($verification['status'] == "success")
    {
        if ($verification['data']['status'] == "successful")
        {
            $data = $verification['data'];
            Invoice::where('invoice_number', $invoice_number)
            ->update([
                'payment_reference' => $data['flw_ref'],
                'payment_status' => 'successful',
                'status' => 'paid',
                'paid_at' => now(),
                'transaction_id' => $transaction_id
            ]);
            return view('payment_success');
        }
        else
        {
            return view('payment_failed');
        }
    }
    else
    {
        return view("payment_failed");
    }
});

Route::get('show', function (){
    return base64_encode('ThisIsMy$FlutterWaveSuper@SecretHashToVerify/Webhooks.16');
});

Route::get('storage/uploads/{filename}', function ($filename)
{
    // Add folder path here instead of storing in the database.
    $path = storage_path('public/uploads' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
