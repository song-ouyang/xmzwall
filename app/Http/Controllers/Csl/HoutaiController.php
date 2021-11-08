<?php

namespace App\Http\Controllers\Csl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Csl\PassRequest;
use App\Http\Requests\Csl\RejectRequest;
use App\Models\Houtai;
use Illuminate\Http\Request;

class HoutaiController extends Controller
{
    /**
     * 吐槽查询
     */
    public function Tcshow()
    {
        $res=Houtai::tcshow();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 表白查询
     */
    public function Bbshow()
    {
        $res=Houtai::bbshow();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 闲置查询
     */
    public function Xzshow()
    {
        $res=Houtai::xzshow();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 吐槽查询通过
     */
    public function Tcpass(PassRequest $request)
    {
        $form_id=$request['form_id'];
        $res=Houtai::tcpass($form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     *表白通过
     */
    public function Bbpass(PassRequest $request)
    {
        $form_id=$request['form_id'];
        $res=Houtai::bbpass($form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 闲置通过
     */
    public function Xzpass(PassRequest $request)
    {
        $form_id=$request['form_id'];
        $res=Houtai::xzpass($form_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 吐槽驳回
     */
    public function Tcreject(RejectRequest $request)
    {
        $reason=$request['reason'];
        $form_id=$request['form_id'];
        $res=Houtai::tcreject($form_id,$reason);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     *表白驳回
     */
    public function Bbreject(RejectRequest $request)
    {
        $reason=$request['reason'];
        $form_id=$request['form_id'];
        $res=Houtai::bbreject($form_id,$reason);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 闲置驳回
     */
    public function Xzreject(RejectRequest $request)
    {
        $reason=$request['reason'];
        $form_id=$request['form_id'];
        $res=Houtai::xzreject($form_id,$reason);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }












}
