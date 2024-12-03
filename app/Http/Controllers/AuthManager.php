<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\MainHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }
    function registration(){
        return view('registration');
    }

    function teacher_dashboard(){
        return view('teacher.teacher_dashboard');
    }

    function student_dashboard(){
        return view('student.student_dashboard');
    }
    
    function main_dashboard(){
    $teacherCount = User::where('role', 'Teacher')->count();
    $studentCount = User::where('role', 'Student')->count();
    $batchCount = Batch::count();
    return view('head.main_dashboard', compact('teacherCount', 'studentCount', 'batchCount'));
        // return view('head.main_dashboard');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $mainHead = MainHead::where('email', $request->email)->first();
       
        if ($mainHead && Hash::check($request->password, $mainHead->password)) {
            // Log in as MainHead using the custom guard
            Auth::guard('main_head')->login($mainHead);
            return redirect()->route('main_dashboard')->with('success', 'Welcome');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
        
            if ($user->unique_id) {
                return redirect()->route('main_dashboard');
            }
            if ($user->role === 'Teacher') {
                return redirect()->route('teacher_dashboard')->with('success', 'Login successful!');;
            } elseif ($user->role === 'Student') {
                return redirect()->route('student_dashboard')->with('success', 'Login successful!');;
            }
        }        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
   


    function logout (Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect()->route('login')->with('success', 'You have successfully logged out.');;
    }

//     public function counts()
// {
//     // Fetch count of teachers
//     $teacherCount = User::where('role', 'Teacher')->count();

//     // Fetch count of students
//     $studentCount = User::where('role', 'Student')->count();

//     // Fetch count of batches
//     $batchCount = Batch::count();

//     // Pass data to the view
//     return view('head.main_dashboard', compact('teacherCount', 'studentCount', 'batchCount'));
// }



}
