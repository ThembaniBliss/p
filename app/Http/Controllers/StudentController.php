<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();

        return view('student.index', compact('students'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('student.create');
    }

    /**
     * @param \App\Http\Requests\StudentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        $student = Student::create($request->validated());

        $request->session()->flash('student.id', $student->stud_id);

        return redirect()->route('student.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Student $student)
    {
        return view('student.show', compact('student'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * @param \App\Http\Requests\StudentUpdateRequest $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());

        $request->session()->flash('student.id', $student->stud_id);

        return redirect()->route('student.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student $student)
    {
        $student->delete();

        return redirect()->route('student.index');
    }
}
