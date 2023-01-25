<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'first_name' => ['required' , 'string' , 'max:50'],
            'last_name' => ['required' , 'string' , 'max:100'],
            'company' => ["nullable"],
            'email' => ['email',"nullable",'unique:employees,email'],
            'phone' => ['max:15' , "nullable"],
        ]);
        $emp = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        if($request->input('email')){
            $user = User::create([
                'name' => $request->input('first_name'),
                'email' => $request->email,
                'emp_id' => $emp->id,
                'password' => Hash::make($request->input('first_name')),
            ]);
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
    public function edit(Request $request)
    {
        return Employee::find($request->input('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $request -> validate([
            'first_name' => ['required' , 'string' , 'max:50'],
            'last_name' => ['required' , 'string' , 'max:100'],
            'company' => ["nullable"],
            'email' => ['email',"nullable",Rule::unique('employees')->ignore($request->input('id'))],
            'phone' => ['max:15' , "nullable"],
        ]);
        if($request->input('email')){
            $user = User::where('emp_id' , '=' ,$request->input('id'))->update([
                'name' => $request->input('first_name'),
                'email' => $request->email,
                'password' => Hash::make($request->input('first_name')),
            ]);
        }
        else{
            User::where('email' , '=' ,$request->input('email'))->delete();
        }
        Employee::find($request->input('id'))->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Employee::find($request->input('id'))->delete();
    }

    public static function getAllCompanie(){
        return Employee::getAllCompanie();
    }
}
