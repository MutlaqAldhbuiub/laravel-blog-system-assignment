<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizedController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('confirmNationalId');
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
        //
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
        //
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
        $user = Auth::user();
        $change=false; // if there's any change in the user!
        //TODO:: DON'T FORGET TO CHECK THE LENGTH OF REQUEST->NATIONAL->ID , IF LESS THAN 10. 
        if($request->has('national_id')){
            if(is_numeric($request->national_id) && $request->national_id > 0 ){
                $user->national_id = $request->national_id;
                $change=true;
            }else{
                return back()->withErrors(['national_id' => ['Your national id is not correct, Make sure you\'ve type a number!']]);
            }
        }

        if($request->has('gender')){
            if($request->gender == 'male' || $request->gender == 'female'){
                $user->gender = $request->gender;
                $change=true;
            }
        }else{
            return back()->withErrors(['gender' => ['Please select a gender!']]);
        }

        if($user->save()){
            return redirect('home');
        }else{
            return back()->withErrors(['gender' => ['Something went wrong!! ','national_id' => 'Something went wrong!! ']]);    
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
        //
    }
}
