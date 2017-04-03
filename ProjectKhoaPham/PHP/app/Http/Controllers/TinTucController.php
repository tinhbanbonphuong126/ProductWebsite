<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\TinTuc;
use App\TheLoai;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();

        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them', ['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,

            [
                'TheLoai' => 'required',
                'LoaiTin' => 'required',
                'TieuDe' => 'required|min:3|max:30|unique:TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'

            ],
            [
                'TheLoai.required' => 'Ban chua nhap ten the loai',
                'LoaiTin.required' => 'Ban chua nhap ten loai tin',
                'TieuDe.required' => 'Ban chua nhap ten tieu de',
                'TomTat.required' => 'Ban chua nhap ten tom tat',
                'NoiDung.required' => 'Ban chua nhap ten noi dung',
                'TieuDe.unique' => 'Ten tieu de da ton tai',
                'Ten.min' => 'Ten loai tin qua ngan hoac qua dai',
                'Ten.max' => 'Ten loai tin qua ngan hoac qua dai',

            ]);

        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();

            if($duoi != 'jpg' && $duoi != 'PNG' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/them')->with('loi', 'ban chi duoc nhap file jpg vs png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4) . "_" . $name;
            while (file_exists("uploads/tintuc" . $Hinh))
            {
                $Hinh = str_random(4) . "_" . $name;
            }
            $file->move("uploads/tintuc", $Hinh);
            $tintuc->Hinh = $Hinh;
        } else {
            $tintuc->Hinh = '';
        }

        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao', 'Ban da them thanh cong');
    }

    public function getSua($id)
    {

        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);

        return view('admin.tintuc.sua', ['theloai' => $theloai, 'loaitin' => $loaitin, 'tintuc' => $tintuc]);

    }

    public function postSua(Request $request, $id)
    {

        $this->validate($request,
            [
                'TheLoai' => 'required',
                'LoaiTin' => 'required',
                'TieuDe' => "required|min:3|max:300|unique:TinTuc,TieuDe,$id",
                'TomTat' => 'required',
                'NoiDung' => 'required'

            ],
            [
                'TheLoai.required' => 'Ban chua nhap ten the loai',
                'LoaiTin.required' => 'Ban chua nhap ten loai tin',
                'TieuDe.required' => 'Ban chua nhap ten tieu de',
                'TomTat.required' => 'Ban chua nhap ten tom tat',
                'NoiDung.required' => 'Ban chua nhap ten noi dung',
                'TieuDe.unique' => 'Ten tieu de da ton tai',
                'Ten.min' => 'Ten loai tin qua ngan hoac qua dai',
                'Ten.max' => 'Ten loai tin qua ngan hoac qua dai',

            ]);

        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();

            if ($duoi != 'jpg' && $duoi != 'PNG' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/them')->with('loi', 'ban chi duoc nhap file jpg vs png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4) . "_" . $name;
            while (file_exists("uploads/tintuc" . $Hinh)) {
                $Hinh = str_random(4) . "_" . $name;
            }
            unlink('uploads/tintuc/' . $tintuc->Hinh);
            $file->move("uploads/tintuc", $Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();

        return redirect('admin/tintuc/sua/' . $id)->with('thongbao', 'Ban da sua thanh cong');
    }


    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        \File::delete('./uploads/tintuc/' . $tintuc->Hinh);
        $tintuc->comment()->delete();
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xoa thanh cong');
    }
}
