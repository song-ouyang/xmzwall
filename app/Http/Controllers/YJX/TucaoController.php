<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tucao\collectRequest;
use App\Http\Requests\Tucao\commentRequest;
use App\Http\Requests\Tucao\memeRequest;
use App\Http\Requests\Tucao\shareRequest;
use App\Http\Requests\Tucao\topicRequest;
use App\Http\Requests\Tucao\TucaoAddRequest;
use App\Http\Requests\Tucao\TucaoChangeRequest;


use App\Http\Requests\Tucao\zanRequest;
use App\Models\Collect;
use App\Models\Comment;
use App\Models\Meme;
use App\Models\Picture;
use App\Models\Share;
use App\Models\Topic;
use App\Models\Tucao;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class TucaoController extends Controller
{
    /***
     * yjx
     * 添加吐槽
     * @param TucaoAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(TucaoAddRequest $request){
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
        $gongkai =$request['gongkai'];
        $res = Tucao::add( $form_id,$picture_id,$text,$statue,$gongkai);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }


    /**
     * yjx
     * 改变公开
     * @param TucaoChangeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changegongkai(TucaoChangeRequest $request){
        $form_id = $request['form_id'];
        $text =$request['text'];
        $id = Tucao::getidd($form_id,$text);
        $res = Tucao::change($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 得到一个meme
     * @param memeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getmeme(memeRequest $request){
        $id = $request['id'];
        $res = Meme::getmeme($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 得到所有meme
     * @return \Illuminate\Http\JsonResponse
     */
    public function showallmeme(){
        $res = Meme::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 得到一个标签
     *
     * @param topicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gettopic(topicRequest $request){
        $id = $request['id'];
        $res = Topic::gettopic($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /***
     * yjx
     *所有标签
     * @return \Illuminate\Http\JsonResponse
     */
    public function showalltopic(){

        $res =Topic::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 点赞
     * @param zanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addzan(zanRequest $request){
        $form_id = $request['form_id'];
        $text =$request['text'];
        $id = Tucao::getidd($form_id,$text);
        $res = Tucao::addzan($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 收藏
     * @param collectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function collect(collectRequest$request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $praise_number = $request['praise_number'];
        $collect_number = $request['collect_number'];
        $share_number = $request['share_number'];
        $comment_number = $request['comment_number'];

        $res = Collect::collect(
            $form_id,
            $text,
            $praise_number,
            $collect_number,
            $share_number,
            $comment_number);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /***
     * yjx
     * 分享
     * @param shareRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(shareRequest $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $picture_id =$request['picture_id'];

        $res = Share::share($form_id,$text,$picture_id);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /***
     * yjx
     * 评论
     * @param commentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(commentRequest $request){
        $form_id = $request['form_id'];
        $title = $request['title'];
        $reply_id = $request['reply_id'];
        $res = Comment::comment($form_id,$title,$reply_id);
         return $res?
             json_success('操作成功!', $res, 200) :
             json_fail('操作失败!', $res, 100);
    }
    /***
     * yjx
     * 得到操作数据的id
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

    /***
     * 得到所有吐槽
     * yjx
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = Tucao::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }


}
