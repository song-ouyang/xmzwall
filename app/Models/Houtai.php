<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Houtai extends Model
{
    /**
     * 吐槽发布展示
     */
    public static function tcshow(){
        try {

            $res=DB::table('tucao')
                ->where('statue','=',1)
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 表白发布展示
     */
    public static function bbshow(){
        try {

            $res=DB::table('love')
                ->where('statue','=',1)
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 闲置发布展示
     */
    public static function xzshow(){
        try {

            $res=DB::table('idle')
                ->where('statue','=',1)
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 吐槽发布展示通过
     */
    public static function tcpass($form_id){
        try {

            $res=DB::table('tucao')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>null,
                    'statue'=>2
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 表白发布展示通过
     */
    public static function bbpass($form_id){
        try {

            $res=DB::table('love')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>null,
                    'statue'=>2
                ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 闲置发布展示通过
     */
    public static function xzpass($form_id){
        try {

            $res=DB::table('idle')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>null,
                    'statue'=>2
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 吐槽发布展示驳回
     */
    public static function tcreject($form_id,$reason){
        try {

            $res=DB::table('tucao')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>$reason,
                    'statue'=>0
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 表白发布展示驳回
     */
    public static function bbreject($form_id,$reason){
        try {

            $res=DB::table('love')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>$reason,
                    'statue'=>0
                ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 闲置发布展示驳回
     */
    public static function xzreject($form_id,$reason){
        try {

            $res=DB::table('idle')
                ->where('form_id','=',$form_id)
                ->update([
                    'reason'=>$reason,
                    'statue'=>0
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

}
