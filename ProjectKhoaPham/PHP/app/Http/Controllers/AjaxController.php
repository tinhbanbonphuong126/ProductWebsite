<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\TheLoai;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai = 0)
    {
        if($idTheLoai==0)
        {
            $loaitin = LoaiTin::all();

            ?>
            <option value="">--</option>
            <?php

            foreach ($loaitin as $lt)
            {
                ?>
                <option value="<?= $lt->id?>"><?=$lt->Ten?></option>
                <?php

                }

        } else {
            $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();

            ?>
            <option value="">--</option>
            <?php

            foreach ($loaitin as $lt) {
                ?>
                <option value="<?= $lt->id ?>"><?= $lt->Ten ?></option>
                <?php

            }
        }
    }

    public function getTheLoai($idLoaiTin = 0)
    {
        $theloaiId = LoaiTin::find($idLoaiTin)->theloai->id;

        $theloai = TheLoai::all();


        ?>
        <option value="">--</option>
        <?php

        foreach ($theloai as $tl) {
            ?>
            <option <?php echo ($tl->id == $theloaiId) ? 'selected' : ''; ?>  value="<?= $tl->id  ?>"><?= $tl->Ten ?></option>
            <?php

        }

    }
}


