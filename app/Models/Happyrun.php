<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Happyrun extends Model
{

    protected $table = 'happyrun';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    /***
     * 存乐跑信息
     * oys
     * @return $res
     */
    public static function HappyrunCreate($id,$text, $statue)
    {
        try {
            //创建表成功
            $res=self::create(
                [
                    'form_id'=>$id,
                    'text'=>$text,
                    'statue'=>$statue,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }



    /***
     * 接受了乐跑以后 返回这个人信息
     * oys
     * @return $res
     */
    public static function HappyrunAccept($id)
    {
        try {
            $res=self::where('id',$id)->
            update([
                'statue'=>2,
            ]);
            $res1=self::where('id',$id)->value('form_id');
            return $res1;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /***
     * 查看所有乐跑中的信息
     * oys
     * @return $res
     */
    public static function HappyrunSelect()
    {
        try {
            $res=self::where('statue',1)->get();
            return $res;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }

}
