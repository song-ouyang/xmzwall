<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = "picture";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * yjx
     * 图片转化
     * @param $tu1
     * @param $tu2
     * @return false
     */
    public static function establish(
        $tu1,
        $tu2
    ){
        //dd(tu1);
        try {
            $res= self::create([
                'one'=>$tu1,
                'two'=>$tu2,
            ])->where('one',$tu1)
                ->value('id');

               //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     *
     * @param $picture_id
     * @return false
     */
    public static function show($picture_id){

        try {
            $res= self::where('id',$picture_id)
                ->get();

            return $res?
                $res :
                false;
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

}
