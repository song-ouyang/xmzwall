<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Models\Collect;
use App\Models\Idle;
use App\Models\Picture;
use App\Models\Share;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class IdleController extends Controller
{

    public function add(Request $request){
        $form_id = $request['form_id'];

        $remoteDir = config("filesystems.disks.oss.ad_upload_dir");
        $picture1=$request['picture1'];
        $picture2=$request['picture2'];

        $tu1=Updateservice::doUpload($picture1,$remoteDir);
        $tu2=Updateservice::doUpload($picture2,$remoteDir);

        $picture_id = Picture::establish($tu1,$tu2);
        // dd($picture_id);
        $text = $request['text'];
        $statue = $request['statue'];
        $price =$request['price'];
        $res = Idle::add( $form_id,$picture_id,$text,$statue,$price);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }


    public function addzan(Request $request){
        $form_id = $request['form_id'];
        $text =$request['text'];
        $id = Idle::getidd($form_id,$text);
        $res = Idle::addzan($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }
    public function collect(Request $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $praise_number = $request['praise_number'];
        $collect_number = $request['collect_number'];
        $share_number = $request['share_number'];
        $comment_number = $request['comment_number'];
        $price = $request['price'];

        $res = Collect::collect1(
            $form_id,
            $text,
            $praise_number,
            $collect_number,
            $share_number,
            $comment_number,
            $price);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    public function share(Request $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $picture_id =$request['picture_id'];

        $res = Share::share($form_id,$text,$picture_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    public function showall(){
       $res = Idle::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }


}
