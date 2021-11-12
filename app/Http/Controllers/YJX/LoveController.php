<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Love;
use App\Models\Meme;
use App\Models\Picture;
use App\Models\Share;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class LoveController extends Controller
{

    /***
     * 严健鑫
     * 添加表白
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request){
        //$id = $request['id'];//这里应该是token拿操作者的id
        $id = auth('api')->user()->id;

        $remoteDir = config("filesystems.disks.oss.ad_upload_dir");
        $picture1=$request['picture1'];
        $picture2=$request['picture2'];

        $tu1=Updateservice::doUpload($picture1,$remoteDir);
        $tu2=Updateservice::doUpload($picture2,$remoteDir);

        $picture_id = Picture::establish($tu1,$tu2);
        // dd($picture_id);
        $text = $request['text'];
        $statue = $request['statue'];
        $gongkai =$request['gongkai'];
        $res = Love::add( $id,$picture_id,$text,$statue,$gongkai);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 公开改为1
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changegongkai(Request $request){
        $form_id = $request['form_id'];
        $text =$request['text'];
        $id = Love::getidd($form_id,$text);
        $res = Love::change($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /***
     * yjx
     * 一个表情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getmeme(Request $request){
        $id = $request['id'];
        $res = Meme::getmeme($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 所有表情
     * @return \Illuminate\Http\JsonResponse
     */
    public function showallmeme(){
        $res = Meme::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 点赞
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addzan(Request $request){
        $form_id = $request['form_id'];
        $text =$request['text'];
        $id = Love::getidd($form_id,$text);
        $res = Love::addzan($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 分享
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(Request $request){
        $form_id1 = auth('api')->user()->id;

        $id = $request['id'];
        $text = $request['text'];

        $remoteDir = config("filesystems.disks.oss.ad_upload_dir");
        $picture1=$request['picture1'];
        $picture2=$request['picture2'];
        $tu1=Updateservice::doUpload($picture1,$remoteDir);
        $tu2=Updateservice::doUpload($picture2,$remoteDir);
        $picture_id = Picture::establish($tu1,$tu2);

        $statue = $request['statue'];
        $gongkai =$request['gongkai'];

        $res1 =Love::addsharenum($id);
        $res = Love::add($form_id1,$picture_id,$text,$statue,$gongkai);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request){
        $form_id1 = auth('api')->user()->id;

        $id = $request['id'];

        $title = $request['title'];
        $reply_id = $request['reply_id'];
        // dd($form_id);
        Love::addcommentnum($id);
        $res = Comment::comment($form_id1,$title,$reply_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }


    /**
     * yjx
     * 得到评论id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getid(Request $request){
        $form_id = $request['form_id'];
        $title = $request['title'];
        $res = Comment::getid($form_id,$title);
        //dd($res);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 所有表白
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = Love::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 得到一条表白
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $picture_id = $request['picture_id'];
        $res = Love::show($form_id,$text,$picture_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

}
