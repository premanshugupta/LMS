<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/',"App\Http\Controllers\AuthManager@login")->name('login');
Route::get('/registration',"App\Http\Controllers\AuthManager@registration")->name('registration');
Route::post('/login',"App\Http\Controllers\AuthManager@loginPost")->name('login.post');
Route::get('/logout',"App\Http\Controllers\AuthManager@logout")->name('logout');





Route::middleware(['auth', 'Teacher'])->group(function () {
    // Add other teacher-specific routes here
    Route::get('/teacher_dashboard', "App\Http\Controllers\AuthManager@teacher_dashboard")->name('teacher_dashboard');
    Route::get('/assign-task', "App\Http\Controllers\StaffController@assignTaskPost")->name('assign_task');
    Route::get('/assign-task-store', "App\Http\Controllers\StaffController@storeTask")->name('assign_task.Post');
    Route::get('/assign-class', "App\Http\Controllers\StaffController@assignClass")->name('assign_class');
    Route::get('/assign-lecture', "App\Http\Controllers\StaffController@assignLecture")->name('assign_lecture');
    // Route::post('/assign-task', "App\Http\Controllers\StaffController@assignTaskPost")->name('assign_task.Post');
});


Route::middleware(['auth', 'Student'])->group(function () {

    Route::get('/student_dashboard', "App\Http\Controllers\AuthManager@student_dashboard")->name('student_dashboard');
    Route::get('/student_dashboard', "App\Http\Controllers\AuthManager@student_dashboard")->name('student_dashboard');
    Route::get('/sub-batches/{batch_id}', "App\Http\Controllers\StudentController@getSubBatches")->name('sub_batches');
    // Route::get('/sub-batches/{batch_id}', [StudentController::class, 'getSubBatches'])->name('sub_batches');
});

Route::middleware('main_head')->group(function () {
    // MainHead-specific routes
    Route::get('/main_dashboard', "App\Http\Controllers\AuthManager@main_dashboard")->name('main_dashboard');

    // Staff Route Below
    Route::get('/addStaff',"App\Http\Controllers\StaffController@addStaff")->name('add_staff');
    Route::post('/addStaff',"App\Http\Controllers\StaffController@addStaffPost")->name('add_staff.post');
    Route::get('/ViewStaff',"App\Http\Controllers\StaffController@viewStaff")->name('view_staff');
    // Route::get('/ViewStaffData',"App\Http\Controllers\StaffController@viewStaffPost")->name('view_staff.post');
    Route::get('/edit-staff/{id}',"App\Http\Controllers\StaffController@editStaff")->name('edit_staff');
    // Route::get('/edit-staff',"App\Http\Controllers\StaffController@editStaff")->name('edit_staff');
    Route::post('/update-staff/{id}',"App\Http\Controllers\StaffController@updateStaff")->name('update_staff');
    Route::get('/delete-staff/{id}',"App\Http\Controllers\StaffController@deleteStaff")->name('delete_staff');
    
    // Batch Route Below
    Route::get('/add-Batch',"App\Http\Controllers\BatchController@addBatch")->name('add_Batch');
    Route::post('/add-Batch',"App\Http\Controllers\BatchController@addBatchPost")->name('add_Batch.Post');
    Route::get('/view-Batch',"App\Http\Controllers\BatchController@viewBatch")->name('view_Batch');
    Route::post('/toggleBatchStatus/{id}',"App\Http\Controllers\BatchController@toggleBatchStatus")->name('toggle_batch_status');
    
    // Sub Batch Route
    Route::get('/add-Sub-Batch',"App\Http\Controllers\SubController@addSubBatch")->name('add_SubBatch');
    Route::post('/add-Sub-Batch',"App\Http\Controllers\SubController@addSubBatchPost")->name('add_SubBatch.Post');
    Route::get('/view-Sub-Batch',"App\Http\Controllers\SubController@viewSubBatch")->name('view_SubBatch');
    Route::patch('/toggleSubBatchStatus/{id}', "App\Http\Controllers\SubController@toggleSubBatchStatus")->name('toggleSubBatchStatus');
    Route::post('/get-sub-batches', 'App\Http\Controllers\SubController@getSubBatches')->name('getSubBatches');



    // Student Route Below
    Route::get('/add-student',"App\Http\Controllers\StudentController@addStudent")->name('add_student');
    Route::post('/add-student',"App\Http\Controllers\StudentController@addStudentPost")->name('add_student.post');
    Route::get('/view-student',"App\Http\Controllers\StudentController@viewStudent")->name('view_student');
    Route::get('/edit-student/{id}',"App\Http\Controllers\StudentController@editStudent")->name('edit_student');
    Route::post('/update-student/{id}',"App\Http\Controllers\StudentController@updateStudent")->name('update_student');
    Route::get('/delete-student/{id}',"App\Http\Controllers\StudentController@deleteStudent")->name('delete_student');
});


// Route::get('/assign-task',function() {
//     return view('assignment.assign_class');
// });