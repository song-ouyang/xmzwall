<?php

namespace App\Http\Controllers\OYS;

use App\Http\Controllers\Controller;

use App\Models\Happyrun;
use App\Models\User;
use Illuminate\Http\Request;

class HappyrunController extends Controller
{

    //发布
    ///aaa
    public function HappyrunCreate(Request $request){
        $form_id = $request['form_id'];
        $text = $request['text'];
        $statue = 1;
        $res = Happyrun::HappyrunCreate($form_id,$text, $statue);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    //接受
    public function HappyrunAccept(Request $request){
        $id = $request['id'];
        $res = Happyrun::HappyrunAccept($id);
        $res2=User::oys_selectUser($res);
        return $res2 ?
            json_success('操作成功!', $res2, 200) :
            json_fail('操作失败!', null, 100);
    }

    //查看所有乐跑信息
    public function HappyrunSelect(Request $request){
        $res = Happyrun::HappyrunSelect();
        return $res ?
            json_success('查看所有乐跑信息成功!', $res, 200) :
            json_fail('查看所有乐跑信息失败!', null, 100);
    }


}
