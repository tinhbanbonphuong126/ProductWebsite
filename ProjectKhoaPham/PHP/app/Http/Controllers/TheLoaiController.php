<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach', ['theloai' => $theloai]);
    }

    public function getThem()
    {
        return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
         $this->validate($request,
             [
                'Ten' => 'required|min:3|max:20|unique:TheLoai,Ten'
             ],
             [
                 'Ten.required' => 'Ban chua nhap the loai',
                 'Ten.unique' => 'Ten the loai da ton tai',
                 'Ten.min' => 'Ten the loai qua ngan hoac qua dai',
                 'Ten.max' => 'Ten the loai qua ngan hoac qua dai',
             ]);

         $theloai = new TheLoai();
         $theloai->Ten = $request->Ten;
         $theloai->TenKhongDau = changeTitle($request->Ten);
         $theloai->save();

         return redirect('admin/theloai/them')->with('thongbao', 'Them thanh cong');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua', ['theloai' => $theloai]);
    }

    public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:20|unique:TheLoai,Ten'
            ],
            [
                'Ten.required' => 'Ban chua nhap the loai',
                'Ten.unique' => 'Ten the loai da ton tai',
                'Ten.min' => 'Ten the loai qua ngan hoac qua dai',
                'Ten.max' => 'Ten the loai qua ngan hoac qua dai',
            ]);

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/' . $id)->with('thongbao', 'Sua thanh cong');
    }


    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao', 'Ban da xoa thanh cong');

    }
}
