<?php

namespace App\Http\Controllers\OYS;

use App\Http\Controllers\Controller;
use App\Models\Umbrella;
use App\Models\User;
use Illuminate\Http\Request;

class UmbrellaController extends Controller
{
    //发布 伞
    public function UmbrellaCreate(Request $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $location = $request['location'];
        $statue = 1;
        $res = Umbrella::UmbrellaCreate($form_id,$text,$statue,$location);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    //拼伞  返回一个人 如果为空就 代表没有这个人
    public function UmbrellaLuck(Request $request){
        $location = $request['location'];
        $res = Umbrella::UmbrellaLuck($location);
        $res2=User::oys_selectUser($res);
        return $res2 ?
            json_success('操作成功!', $res2, 200):
            json_fail('操作失败!', null, 100);
    }
}
