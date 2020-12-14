<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if($request->has('national_id')){
            if(is_numeric($request->national_id) && $request->national_id > 0){
                $user->national_id = $request->input('national_id');
            }else{
                return back()->withErrors(['national_id' => ['رقم الهوية غير صحيح, الرجاء التاكد من كتابة ارقام فقط.']]);
            }
        }

        if($request->has('gender')){
            if($request->gender == 'male' || $request->gender == 'female'){
                $user->gender = $request->gender;
            }
        }else{
            if($user->save()){
                return redirect()->route('home');
            }else{
                return back()->withErrors(['gender' => ['حدث خطا! ','national_id' => 'لم يتم الحفظ حدث خطا الرجاء المعاوده لاحقاً!']]);
            }
        }

        if($user->save()){
            return redirect()->route('home');
        }else{
            return back()->withErrors(['gender' => ['حدث خطا! ','national_id' => 'لم يتم الحفظ حدث خطا الرجاء المعاوده لاحقاً!']]);
        }


    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function updateUser($user){

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
