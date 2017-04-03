<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function getXoa($id, $idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/' . $idTinTuc)->with('thongbao_comment', 'Xoa comment thanh cong');
    }
}
