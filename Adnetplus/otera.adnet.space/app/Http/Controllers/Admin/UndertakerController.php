<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Undertaker;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UndertakerRequest;

class UndertakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $name = '';
        $query = Undertaker::query();
        $query->where('delflag',0);
        if(Input::has('name') && Input::get('name')!=''){
            $name = Input::get('name');
            $query->where('undertaker_name', 'LIKE', '%'.Input::get('name').'%');
        }
        $query->orderBy('id','DESC');
        $undertaker = $query->paginate(\Config::get('setting.paginate'));

        return view('admin.undertaker.index', compact('undertaker','name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.undertaker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UndertakerRequest $request)
    {
        
        $requestData = $request->all();

        $requestData['password'] = \Hash::make($request->get('password'));

        $requestData['encrypt_pass'] = encryptIt($request->get('password'));

        $user = Undertaker::create($requestData);

        $this->sendMailRegister($user,$request->get('password'));

        Session::flash('flash_message', trans('commons.create_success'));

        return redirect('admin/undertaker');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $undertaker = Undertaker::findOrFail($id);

        return view('admin.undertaker.show', compact('undertaker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $undertaker = Undertaker::findOrFail($id);

        return view('admin.undertaker.edit', compact('undertaker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UndertakerRequest $request)
    {
        
        $requestData = $request->all();
        
        $undertaker = Undertaker::findOrFail($id);
        $undertaker->update(clearPaswordAccount(clearData($requestData)));

        Session::flash('flash_message', trans('commons.update_success'));

        return redirect('admin/undertaker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Undertaker::where('id',$id)->update([
            'delflag' => 1
        ]);
        return redirect('admin/undertaker');
    }

    public function sendMailRegister($user,$password){
        $mail_from      = \Config::get("setting.admin_email");
        $mail_to        = $user->emails;
        $mail_from_name = "管理者";

        $subject = "葬儀社登録";

        $header = "From: ".$mail_from_name." <".$mail_from.">\n";
        $header .= "MIME-Version: 1.0\n";

        $message = "";
        $message .= $user->undertaker_name."\n";
        $message .= "派遣管理システムに登録されました。 \n\n";
        $message .= "ID: ".$user->account_id."\n";
        $message .= "パスワード: ".$password."\n\n";
        $message .= "上記のIDとパスワードで下記のURLのログイン画面よりログインしてください。 \n";
        $message .= url("/auth/login");

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        mb_send_mail($mail_to, $subject, $message,$header);
    }
}
