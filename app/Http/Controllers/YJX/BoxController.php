<?php

namespace App\Http\Controllers\YJX;

use App\Http\Controllers\Controller;
use App\Http\Requests\Box\BoxRequest;
use App\Models\Box;
use App\Models\Picture;
use App\Models\Updateservice;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /***
     * yjx
     * 添加盲盒
     * @param BoxRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(BoxRequest $request){
        $remoteDir = config("filesystems.disks.oss.ad_upload_dir");

        $picture1=$request['picture1'];
        $picture2=$request['picture2'];

        $tu1=Updateservice::doUpload($picture1,$remoteDir);
        $tu2=Updateservice::doUpload($picture2,$remoteDir);


        $text = $request['text'];
        $picture_id= Picture::establish($tu1,$tu2);
        //dd($picture_id);
        $res = Box::add($picture_id,$text);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***
     * yjx
     * 随机一个盲盒
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(){
        $res = Box::show();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }



}
