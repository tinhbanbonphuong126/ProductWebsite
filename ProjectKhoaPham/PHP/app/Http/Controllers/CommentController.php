<?php

namespace App\Http\Controllers;

use App\Comment;
use App\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getXoa($id, $idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/' . $idTinTuc)->with('thongbao_comment', 'Xoa comment thanh cong');
    }

    public function postComment($id, Request $request)
    {
        $idTinTuc = $id;
        $tintuc = TinTuc::find($id);

        $comment = new Comment();
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;

        $comment->save();

        return redirect('tintuc/'. $id . '/' . $tintuc->TieuDeKhongDau. '.html#endCommentForm')->with('thongbao', 'Binh luan thanh cong');
    }
}






























