<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }

    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(Request $request)
    {



        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'Ban chua nhap ten user',
                'name.min' => 'Ten dang nhap it nhat 3 ky tu',

                'email.required' => 'Ban chua nhap ten email',
                'email.email' => 'Ban chua nhap dung dinh dang email',
                'email.unique' => 'Email da ton tai',

                'password.required' => 'Ban chua nhap password',
                'password.min' => 'Password it nhat 3 ky tu',
                'password.max' => 'Password nhieu nhat 32 ky tu',
                'passwordAgain.required' => 'Ban chua nhap lai password',
                'passwordAgain.same' => 'Password khong trung nhau'
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;

        $user->save();

        return redirect('admin/user/them')->with('thongbao', 'Them user thanh cong');
    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua', ['user' => $user]);

    }

    public function postSua(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => 'Ban chua nhap ten user',
                'name.min' => 'Ten dang nhap it nhat 3 ky tu'
            ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->quyen = $request->quyen;

        if($request->changePassword == 'on')
        {
            $this->validate($request,
                [
                    'password' => 'required|min:3|max:32',
                    'passwordAgain' => 'required|same:password'
                ],
                [
                    'password.required' => 'Ban chua nhap password',
                    'password.min' => 'Password it nhat 3 ky tu',
                    'password.max' => 'Password nhieu nhat 32 ky tu',
                    'passwordAgain.required' => 'Ban chua nhap lai password',
                    'passwordAgain.same' => 'Password khong trung nhau'
                ]);
            $user->password = bcrypt($request->password);

        }

        $user->save();

        return redirect('admin/user/sua/' . $id)->with('thongbao', 'Sua user thanh cong');
    }


    public function getXoa($id)
    {
        $user = User::find($id);

        $user->comment()->delete($id);
        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao', 'Xoa thanh cong');
    }



    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:3|max:32'
            ],
            [
                'email.required' => 'ban chua nhap Email',
                'password.required' => 'ban chua nhap password',
                'password.min' => 'password nho hown 3 ky tu',
                'password.max' => 'password khong lon hon 32 ky tu'

            ]);


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('admin/theloai/danhsach');
        } else {
            return redirect('admin/dangnhap')->with(['thongbao'=> 'Dang nhap khong thanh cong', 'old_email'=> $request->email]);
        }
    }

    public function getDangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
