<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function addStudent(){
        return view('student.add_student');
    }
    function viewStudent(){
        $students = User::where('role', 'Student')->get();
        return view('student.view_student', compact('students'));
    }
    function addStudentPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => 'Student', // Predefined role
        ]);
        return redirect()->route('view_student')->with('success', 'Staff added successfully!');
    }

    function editStudent($id)
    {
        $student = User::findOrFail($id);
        return view('student.edit_student', compact('student'));
    }

    function updateStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $student = User::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('view_student')->with('success', 'Staff updated successfully!');
    }

    function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('view_student')->with('success', 'Staff deleted successfully!');
    }
}
