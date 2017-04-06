<?php

namespace App\Http\Controllers\Under;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class UContactController extends Controller
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
        $undertaker = \Auth::guard('undertaker')->user();
        return view('undertaker.ucontact.create',compact('undertaker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $undertaker = \Auth::guard('undertaker')->user();

        $header = "From: ".$undertaker->undertaker_name." <".$undertaker->emails.">\n";
        $header .= "MIME-Version: 1.0\n";

        // send mail to admin
        mb_language("japanese");
        mb_internal_encoding("UTF-8");

        //email admin
        $to = \Config::get('setting.admin_email');
        $subject = 'お問い合わせメール';
        $body = '';
        $body .= $undertaker->undertaker_name."様からお問い合わせがありました。\n";
        $body .= "メールアドレス: ".$undertaker->emails."\n\n";
        $body .= "お問い合わせ内容 \n";
        $body .= "件名: ".$request->get('subject')."\n";
        $body .= "内容: \n".mb_convert_encoding($request->get('content'),'ISO-2022-JP-MS');


        $result = mb_send_mail($to,$subject,$body,$header);

        return view('undertaker.success',compact('undertaker'));
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
    public function update(Request $request, $id)
    {
        //
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
