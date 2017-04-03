<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\TheLoai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach', ['loaitin' => $loaitin]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.them', ['theloai' => $theloai]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:2|max:10',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Ban chua nhap ten loai tin',
                'Ten.unique' => 'Ten loai tin da ton tai',
                'Ten.min' => 'Ten loai tin qua ngan hoac qua dai',
                'Ten.max' => 'Ten loai tin qua ngan hoac qua dai',

                'TheLoai.required' => 'Ban chua chon the loai',
            ]);

        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle( $request->Ten );
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao', 'Ban da them thanh cong');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua', ['loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function postSua(Request $request, $id)
    {

        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:2|max:10',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Ban chua nhap ten loai tin',
                'Ten.unique' => 'Ten loai tin da ton tai',
                'Ten.min' => 'Ten loai tin qua ngan hoac qua dai',
                'Ten.max' => 'Ten loai tin qua ngan hoac qua dai',

                'TheLoai.required' => 'Ban chua chon the loai',
            ]);

        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);

        $loaitin->save();

        return redirect('admin/loaitin/sua/'. $id)->with('thongbao', 'Ban da sua thanh cong');
    }


    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xoa thanh cong');
    }
}
