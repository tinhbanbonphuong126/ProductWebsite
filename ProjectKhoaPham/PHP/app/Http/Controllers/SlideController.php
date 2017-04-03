<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\Slide;
use App\TheLoai;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach', ['slide' => $slide]);
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,

            [
                'Ten' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'Ten.required' => 'Ban chua nhap ten slide',
                'NoiDung.required' => 'Ban chua nhap noi dung'
            ]);

        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;

        if($request->has('Link'))
        {
            $slide->link = $request->Link;
        }

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();

            if ($duoi != 'jpg' && $duoi != 'PNG' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('loi', 'ban chi duoc nhap file jpg vs png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4) . "_" . $name;
            while (file_exists("uploads/slide" . $Hinh)) {
                $Hinh = str_random(4) . "_" . $name;
            }
            $file->move("uploads/slide", $Hinh);
            $slide->Hinh = $Hinh;
        } else {
            $slide->Hinh = '';
        }


        $slide->save();

        return redirect('admin/slide/them')->with('thongbao','Them slide thanh cong');
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua', ['slide' => $slide]);

    }

    public function postSua(Request $request, $id)
    {
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;

        if ($request->has('Link')) {
            $slide->link = $request->Link;
        }

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();

            if ($duoi != 'jpg' && $duoi != 'PNG' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('loi', 'ban chi duoc nhap file jpg vs png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4) . "_" . $name;
            while (file_exists("uploads/slide" . $Hinh)) {
                $Hinh = str_random(4) . "_" . $name;
            }

            if(file_exists('uploads/slide/' . $slide->Hinh))
            {
                unlink("uploads/slide/" . $slide->Hinh);
            }
            $file->move("uploads/slide", $Hinh);
            $slide->Hinh = $Hinh;
        }


        $slide->save();

        return redirect('admin/slide/sua/' . $id)->with('thongbao', 'Sua slide thanh cong');
    }


    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao', 'Xoa thanh cong');
    }
}
