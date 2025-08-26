<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::orderBy('id','desc')->paginate(10);
        return view('index', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        
        Student::create($request->post());

        return redirect()->route('students.index')->with('success','Student has been created successfully.');
    }

    public function show(Student $student)
    {
        return view('show');
    }

    public function edit(Student $student)
    {
        return view('edit',compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        
        $student->fill($request->post())->save();

        return redirect()->route('students.index')->with('success','Student Has Been updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student has been deleted successfully');
    }
}
