<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Http\Controllers\File\FileController;
use App\Models\Picture;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function add($tu1,$tu2){
        //$fileObj = $request['file'];

        $res = Picture::establish($tu1,$tu2);

        return $res?
            $res:
            false;
            /*json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);*/

    }

    public function show(Request $request){
        $picture_id =$request['picture_id'];
        $res =Picture::show($picture_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

}
