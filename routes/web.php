<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\StaffController;
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
    Route::get('/teacher_dashboard', "App\Http\Controllers\StaffController@teacherDashboard")->name('teacher_dashboard');
    Route::get('/assign-task', "App\Http\Controllers\StaffController@assignTaskPost")->name('assign_task');
    Route::get('/assign-task-store', "App\Http\Controllers\StaffController@storeTask")->name('assign_task.Post');
    Route::get('/add-syllabus',"App\Http\Controllers\AssignmentController@showSyllabus")->name('show_syllabus');
    Route::post('/add-syllabus',"App\Http\Controllers\AssignmentController@addSyllabus")->name('add_syllabus');
    Route::get('/view-syllabus', 'App\Http\Controllers\AssignmentController@viewSyllabus')->name('view_syllabus');
    Route::get('/edit-syllabus/{id}', 'App\Http\Controllers\AssignmentController@editSyllabus')->name('edit_syllabus');
    Route::put('/update-syllabus/{id}', 'App\Http\Controllers\AssignmentController@updateSyllabus')->name('update_syllabus');
    Route::delete('/delete-syllabus/{id}', 'App\Http\Controllers\AssignmentController@deleteSyllabus')->name('delete_syllabus');

    Route::get('/add-class',"App\Http\Controllers\AssignmentController@addClass")->name('add_class');
    Route::post('/add-class',"App\Http\Controllers\AssignmentController@addClass")->name('add_class');
    Route::get('/view-class',"App\Http\Controllers\AssignmentController@viewClass")->name('view_class');
    Route::get('/edit-class/{id}',"App\Http\Controllers\AssignmentController@editClass")->name('edit_class');
    Route::put('/update-class/{id}',"App\Http\Controllers\AssignmentController@updateClass")->name('update_class');
    Route::delete('/delete-class/{id}',"App\Http\Controllers\AssignmentController@deleteClass")->name('delete_class');
    Route::get('/add-lecture',"App\Http\Controllers\AssignmentController@showLecture")->name('add_lecture');
    Route::post('/add-lecture',"App\Http\Controllers\AssignmentController@addLecture")->name('add_lecture');
    Route::get('/view-lectures',"App\Http\Controllers\AssignmentController@viewLecture")->name('view_lectures');
    Route::delete('/delete-lecture/{id}',"App\Http\Controllers\AssignmentController@deleteLecture")->name('delete_lecture');
    // Route::delete('/delete-lecture/{id}', [AssignmentController::class, 'deleteLecture'])->name('delete_lecture');

    // Route::get('/view-lectures', [AssignmentController::class, 'showLectures'])->name('view_lectures');

    // Route::post('/add-lecture', [AssignmentController::class, 'addLecture'])->name('add_lecture');
// Route::post('/lectures/store', [AssignmentController::class, 'store'])->name('lectures.store');
});


Route::middleware(['auth', 'Student'])->group(function () {

    Route::get('/student_dashboard', "App\Http\Controllers\AuthManager@student_dashboard")->name('student_dashboard');
    Route::get('/student_dashboard', "App\Http\Controllers\StudentController@studentDashboard")->name('student_dashboard');
    Route::get('/sub-batches/{batch_id}', "App\Http\Controllers\StudentController@getSubBatches")->name('sub_batches');
});

Route::middleware('main_head')->group(function () {
    // MainHead-specific routes
    Route::get('/main_dashboard', "App\Http\Controllers\AuthManager@main_dashboard")->name('main_dashboard');

    // Staff Route Below
    Route::get('/addStaff',"App\Http\Controllers\StaffController@addStaff")->name('add_staff');
    Route::post('/addStaff',"App\Http\Controllers\StaffController@addStaffPost")->name('add_staff.post');
    Route::get('/ViewStaff',"App\Http\Controllers\StaffController@viewStaff")->name('view_staff');
    Route::get('/edit-staff/{id}',"App\Http\Controllers\StaffController@editStaff")->name('edit_staff');
    Route::post('/update-staff/{id}',"App\Http\Controllers\StaffController@updateStaff")->name('update_staff');
    Route::get('/delete-staff/{id}',"App\Http\Controllers\StaffController@deleteStaff")->name('delete_staff');
    Route::get('/get-sub-batches-by-batch',"App\Http\Controllers\StaffController@getSubBatchesByBatch")->name('getSubBatchesByBatch');



    
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
