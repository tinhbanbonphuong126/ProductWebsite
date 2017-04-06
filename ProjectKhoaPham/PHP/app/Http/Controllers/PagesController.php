<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\Slide;
use App\TheLoai;
use App\TinTuc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
    //

    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);

        if(Auth::check())
        {
            view()->share('nguoidung', Auth::user());
        }
    }

    public function trangchu()
    {
        return view('pages.trangchu');
    }

    public function lienhe()
    {
        $theloai = TheLoai::all();
        return view('pages.lienhe');
    }

    public function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinNoiBat = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinLienQuan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();

        return view('pages.tintuc', ['tintuc' => $tintuc, 'tinLienQuan' => $tinLienQuan, 'tinNoiBat' => $tinNoiBat]);
    }

    public function getDangnhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangnhap(Request $request)
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//            if($request->previousUrl != 'http://co.co/dangnhap')
            if (session('previousUrl') != asset('') . 'dangnhap')
                return redirect(session('previousUrl'));
//                return redirect($request->previousUrl);
            else
                return redirect()->intended('trangchu');


        } else {
            return redirect('dangnhap')->with(['thongbao' => 'Dang nhap khong thanh cong', 'old_email' => $request->email]);
        }
    }

    public function getDangxuat()
    {
        Auth::logout();
        return redirect('dangnhap');
    }

    public function getNguoidung()
    {
        return view('pages.nguoidung');
    }

    public function postNguoidung(Request $request)
    {
        $user = Auth::user();
        $this->validate($request,
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => 'Ban chua nhap ten user',
                'name.min' => 'Ten dang nhap it nhat 3 ky tu'
            ]);

        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->quyen = $request->quyen;

        if ($request->changePassword == 'on') {
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
        return redirect('nguoidung')->with('thongbao', 'ban da sua thanh cong');

    }



    public function getDangky()
    {
        return view('dangky');
    }

    public function postDangky(Request $request)
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;

        $user->save();

        return redirect('dangnhap')->with('thongbao', 'chuc mung ban da dang ky thanh cong');
    }

    public function timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;

        $tintuc = TinTuc::where('TieuDe', 'like', "%$tukhoa%")
                          ->orwhere('NoiDung', 'like', "%$tukhoa%")
                          ->orwhere('TomTat', 'like', "%$tukhoa%")
                          ->take(30)->paginate(5);

        return view('pages.timkiem', ['tintuc'=>$tintuc, 'tukhoa'=>$tukhoa]);

    }
}

