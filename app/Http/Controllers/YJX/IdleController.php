<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Http\Requests\Idle\addRequest;
use App\Http\Requests\Idle\IdleCollectRequest;
use App\Http\Requests\Idle\IdleShowRequest;
use App\Http\Requests\Tucao\shareRequest;
use App\Http\Requests\Tucao\zanRequest;
use App\Models\Collect;
use App\Models\Idle;
use App\Models\Picture;
use App\Models\Share;
use App\Models\Tucao;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class IdleController extends Controller
{
    /***
     * yjx
     * 添加闲置
     * @param addRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(addRequest $request){
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
        $price =$request['price'];
        $res = Idle::add( $id,$picture_id,$text,$statue,$price);
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
        $id = Idle::getidd($form_id,$text);
        $res = Idle::addzan($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 收藏闲置
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function collect(IdleCollectRequest $request){
        $form_id1 = auth('api')->user()->id;
        $id = $request['id'];

        $text = $request['text'];
        $praise_number = $request['praise_number'];
        $collect_number = $request['collect_number'];
        $share_number = $request['share_number'];
        $comment_number = $request['comment_number'];
        $price = $request['price'];

        Tucao::addcollectnum($id);
        $res = Collect::collect1(
            $form_id1,
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

    /***
     * yjx
     * 闲置分享
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(shareRequest $request){
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
        $price =$request['price'];

        $res1 =Idle::addsharenum($id);
        $res = Idle::add($form_id1,$picture_id,$text,$statue,$price);
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

    public function show(IdleShowRequest $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $picture_id = $request['picture_id'];
        $res = Idle::show($form_id,$text,$picture_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

}
