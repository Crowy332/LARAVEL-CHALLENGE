<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CompanieController extends Controller
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
        $validate = [
            'name' => ['required' , 'string' , 'max:100'],
            'address' => ['string' , "nullable"],
            'email' => ['email' , 'max:100' , "nullable"],
            'website' => ['string' , 'max:100' , "nullable"],
        ];
        if($request->input("check") == 1) $validate['logo'] = ['dimensions:min_width=100px,min_height=100px' , "nullable"];
        $request -> validate($validate );
        $filename = "";
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = Str::random(10) . '.' . $logo->extension();
            $destinationPath = storage_path('app/public');
            $image = $request->file('logo')->move($destinationPath, $filename);
        }
        $Companie = Companie::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'logo' => $filename  ? $filename : "",
            'website' => $request->input('website'),
        ]);
        Mail::send('emails.email', $Companie->toArray(), function ($message) {
            $message->to('admin@admin.com', 'Admin');
            $message->subject('New Companie');
        });
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
        return Companie::find($request->input('id'));
        //  view('setting.edit_name',compact(['data']));
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
        $validate = [
            'name' => ['required' , 'string' , 'max:100'],
            'address' => ['string' , "nullable"],
            'email' => ['email' , 'max:100' , "nullable"],
            'website' => ['string' , 'max:100' , "nullable"],
        ];
        if($request->input("check") == 1) $validate['logo'] = ['dimensions:min_width=100px,min_height=100px' , "nullable"];
        $request -> validate($validate);
        $company = Companie::find($request->input('id'));
        if($request->input("check") == 0){
            $filename = $company->logo;
        }
        else if($request->input("check") == 1){
            unlink(storage_path('app/public') .'/'. $company->logo);
            $logo = $request->file('logo');
            $filename = Str::random(10) . '.' . $logo->extension();
            $destinationPath = storage_path('app/public');
            $image = $request->file('logo')->move($destinationPath, $filename);
        }
        else if($request->input("check") == 2){
            unlink(storage_path('app/public') .'/'. $company->logo);
            $filename = "";
        }
        Companie::find($request->input('id'))->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'logo' => $filename  ? $filename : "",
            'website' => $request->input('website'),
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
        Companie::find($request->input('id'))->delete();
    }
}
