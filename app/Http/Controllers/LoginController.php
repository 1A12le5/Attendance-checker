<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        $students = \App\Models\Student::all();
        $attendances = \App\Models\Attendance::with('student')->get();
        return view('dashboard', compact('students', 'attendances'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'idnumber' => 'required',
            'password' => 'required',
            'role' => 'required|in:student,teacher',
        ]);

        if ($request->role === 'student') {
            // Check against students table
            $user = \App\Models\Student::where('student_number', $request->idnumber)->first();
            if ($user && $request->password === 'password') { // Demo password
                session(['user_id' => $user->id, 'user_name' => $user->name, 'role' => $request->role]);
                return redirect()->route('dashboard')->with('success', 'Login successful');
            }
        } elseif ($request->role === 'teacher') {
            // Check against teachers table
            $teacher = \App\Models\Teacher::where('teacher_code', $request->idnumber)->first();
            if ($teacher && $request->password === 'password') { // Demo password
                session(['user_id' => $teacher->id, 'user_name' => $teacher->name, 'role' => $request->role]);
                return redirect()->route('dashboard')->with('success', 'Login successful');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'role']);
        return redirect()->route('dashboard');
    }
}
