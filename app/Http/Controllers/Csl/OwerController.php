<?php

namespace App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Csl\SignRequest;
use App\Models\Ower;
use http\Env\Request;

class OwerController extends Controller
{
    /*
     * 个人信息中心
     */
    public function Oshow()
    {
        $res=Ower::look();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /*
     * 驳回的展示
     */
    public function Bshow()
    {
        $res1=Ower::tshow();
        $res2=Ower::bshow();
        $res3=Ower::xshow();
        $res=$res1->merge($res2)->merge($res3);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /*
     * 吐槽通过的展示
     */
    public function Tcshow()
    {

        $res=Ower::tcshow();

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /*
        * 吐槽通过的展示
        */
    public function Bbshow()
    {

        $res=Ower::bbshow();

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /*
        * 吐槽通过的展示
        */
    public function Xzshow()
    {

        $res=Ower::xzshow();

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
/*
 *
 *签名
 */
    public function Sign(SignRequest $request)
    {
       $sign=$request['sign'];
        $res=Ower::sign($sign);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

}
