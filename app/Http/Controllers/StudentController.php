<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['active'] = 'student';
        $data['students'] = Student::with('teacher')->orderByDesc('id')->get();
        return view('student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['active'] = 'student';
        $data['teachers'] = Teacher::orderByDesc('id')->get();
        return view('student.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'age' => 'required|numeric',
                'gender' => 'required|in:m,f,o',
                'teacher' => 'required'
            ];
            
            $validator = Validator::make(request()->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
            }

            $data = [
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'teacher_id' => $request->teacher,
            ];

            Student::create($data);
            return response()->json(['success' => true, 'msg' => "Succussfully added"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "Something went wrong"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['active'] = 'student';
        $data['student'] = Student::where('id', $id)->with('teacher')->first();
        $data['teachers'] = Teacher::all();
        return view('student.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'name' => 'required',
                'age' => 'required|numeric',
                'gender' => 'required|in:m,f,o',
                'teacher' => 'required'
            ];
            
            $validator = Validator::make(request()->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
            }

            $data = [
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'teacher_id' => $request->teacher,
            ];

            Student::where('id', $id)->update($data);
            return response()->json(['success' => true, 'msg' => "Succussfully updated"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "Something went wrong"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Student::where('id', $id)->delete();
            return response()->json(['success' => true, 'msg' => "Succussfully Deleted"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "Something went wrong"]);
        }
    }
}
