<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = "box";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     *yjx
     * 创建盲盒
     * @param $picture_id
     * @param $text
     * @return false|\Illuminate\Http\JsonResponse
     */
    public static function add($picture_id,$text){
        try {
            $res= self::create([
                'picture_id'=>$picture_id,
                'text'=>$text,
            ]);

            //dd($res);
            return $res?
                json_success('操作成功!', $res ) :
                json_fail('操作失败!', $res );
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 展示盲盒
     * @return false
     */
    public static function show(){

        try {
            $res = self::select()->
                //->orderby(\DB::raw(RAND()))
                /*->take(1)
                ->get();*/
            inRandomOrder()->first();
            return $res?
                $res :
                false;
        }catch (\Exception $e) {
            logError('查找不成功', [$e->getMessage()]);
            return false;
        }

    }



}
