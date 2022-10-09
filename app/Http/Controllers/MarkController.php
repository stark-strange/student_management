<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['active'] = 'mark';
        $data['marks'] = Mark::with(['term', 'student'])->orderByDesc('id')->get();
        // dd($data['marks']);
        return view('mark.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['active'] = 'mark';
        $data['terms'] = Term::orderByDesc('id')->get();
        $data['students'] = Student::orderByDesc('id')->get();
        return view('mark.create', $data);
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
                'student' => 'required',
                'term' => 'required',
                'mark_maths' => 'required|numeric',
                'mark_science' => 'required|numeric',
                'mark_history' => 'required|numeric',
            ];
            
            $validator = Validator::make(request()->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
            }

            $data = [
                'maths' => $request->mark_maths,
                'science' => $request->mark_science,
                'history' => $request->mark_history,
                'term_id' => $request->term,
                'student_id' => $request->student,
            ];

            Mark::create($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['active'] = 'mark';
        $data['mark'] = Mark::where('id', $id)->with(['term', 'student'])->first();
        $data['students'] = Student::all();
        $data['term'] = Term::all();
        return view('mark.edit', $data);
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
                'student' => 'required',
                'term' => 'required',
                'mark_maths' => 'required|numeric',
                'mark_science' => 'required|numeric',
                'mark_history' => 'required|numeric',
            ];
            
            $validator = Validator::make(request()->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
            }

            $data = [
                'maths' => $request->mark_maths,
                'science' => $request->mark_science,
                'history' => $request->mark_history,
                'term_id' => $request->term,
                'student_id' => $request->student,
            ];

            Mark::where('id', $id)->update($data);
            return response()->json(['success' => true, 'msg' => "Succussfully Updated"]);
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
            Mark::where('id', $id)->delete();
            return response()->json(['success' => true, 'msg' => "Succussfully Deleted"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "Something went wrong"]);
        }
    }
}
