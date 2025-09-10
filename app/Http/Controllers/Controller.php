<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    public function listOfStudent()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        return $students;
    }

    public function addStudent(HttpRequest $request)
    {
        $rules = array(
            'name' => 'required | string | max:30 | min:2',
            'email' => 'required | string | email',
            'phone' => 'required | string | min:10'
        );

        // $validation = Validator::make($request->all(), $rules)->validate();
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            if ($student->save()) {
                return ['Result' => 'Student added successfully!😁'];
            } else {
                return ['Result' => 'Add operation failed!😢'];
            }
        }
    }

    public function updateStudent(HttpRequest $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if ($student->save()) {
            return ['Result' => 'Student updated successfully!😁'];
        } else {
            return ['Result' => 'Update operation failed!😢'];
        }
    }

    public function deleteStudent($id)
    {
        $student = Student::destroy($id);
        if ($student) {
            return ['Result' => 'Student deleted successfully!😁'];
        } else {
            return ['Result' => 'Delete operation failed!😢'];
        }
    }

    public function searchStudent($name)
    {
        $student = Student::where('name', 'like', "%$name%")->get();
        if ($student) {
            return ['Result' => $student];
        } else {
            return ['Result' => 'No record found!😢'];
        }
    }
}
