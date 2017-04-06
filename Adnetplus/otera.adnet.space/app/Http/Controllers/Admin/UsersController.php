<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $name = '';
        $query = User::query();
        $query->where('role','<>',1);
        //$query->where('delflag',0);
        if(Input::has('name') && Input::get('name')!=''){
            $name = Input::get('name');
            $query->where('name', 'LIKE', '%'.Input::get('name').'%');
        }
        $query->orderBy('id','DESC');
        $users = $query->paginate(\Config::get('setting.paginate'));

        return view('admin.users.index', compact('users','name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = $this->getSelectType();
        return view('admin.users.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UsersRequest $request)
    {
        
        $requestData = $request->all();

        $requestData['password'] = \Hash::make($request->get('password'));

        $requestData['encrypt_pass'] = encryptIt($request->get('password'));

        $user = User::create(clearData($requestData));

        $this->sendMailRegister($user,$request->get('password'));

        Session::flash('flash_message', trans('commons.create_success'));

        return redirect('admin/users');
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
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
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
        $user = User::findOrFail($id);
        $types = $this->getSelectType();
        return view('admin.users.edit', compact('user','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UsersRequest $request)
    {
        
        $requestData = $request->all();
        
        $user = User::findOrFail($id);
        $user->update(clearPaswordAccount(clearData($requestData)));

        Session::flash('flash_message', trans('commons.update_success'));

        return redirect('admin/users');
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
        User::where('id',$id)->delete();
        return redirect('admin/users');
    }

    public function getSelectType(){
        $typeSelect = [];
        $types = Type::all();
        if(!is_null($types) && count($types) > 0){
            foreach($types as $type){
                $typeSelect[$type->id] = $type->name;
            }
        }
        return $typeSelect;
    }

    /**
     * send mail for user
     * @param $user
     * @param $password
     */
    public function sendMailRegister($user,$password){
        $mail_from      = \Config::get("setting.admin_email");
        $mail_to        = $user->emails;
        $mail_from_name = "管理者";

        $subject = "派遣社員登録";

        $header = "From: ".$mail_from_name." <".$mail_from.">\n";
        $header .= "MIME-Version: 1.0\n";

        $message = "";
        $message .= "派遣社員名: ".$user->name."\n";
        $message .= "派遣管理システムに登録されました。 \n\n";
        $message .= "ID: ".$user->account_id."\n";
        $message .= "パスワード: ".$password."\n\n";
        $message .= "上記のIDとパスワードで下記のURLのログイン画面よりログインしてください。 \n";
        $message .= url("/staff/login");

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        mb_send_mail($mail_to, $subject, $message,$header);
    }
}
