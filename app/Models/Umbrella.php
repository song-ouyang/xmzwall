<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umbrella extends Model
{
    protected $table = 'umbrella';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    /***
     * 存乐跑信息
     * oys
     * @return $res
     */
    public static function UmbrellaCreate($form_id,$text,$statue,$location)
    {
        try {
            //创建表成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'text'=>$text,
                    'statue'=>$statue,
                    'location'=>$location,
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
    public static function UmbrellaLuck($location)
    {
        try {
            $res=self::where('location',$location)->where('statue',1)
                ->inRandomOrder()
                ->take(1)
                ->value('id'); //随机找数
            $res1=self::where('id',$res)->update(['statue'=>2,]);  //修改状态
            $res2=self::where('id',$res)->value('form_id');
            return $res2;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }
}
