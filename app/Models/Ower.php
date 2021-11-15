<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ower extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /*
     * 个人信息展示
     */
    public static function look(){
        try {
            $id = auth('api')->user()->id;
            $res=self::where('id',$id)
                ->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /*
     * 驳回的展示
     */
    public static function tshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("tucao")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 0
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    public static function bshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("love")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 0
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function xshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("idle")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 0
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /*
      * 通过的展示
      */
    public static function tcshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("tucao")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 2
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    public static function bbshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("love")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 2
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function xzshow(){
        try {
            $id = auth('api')->user()->id;
            $res=DB::table("idle")
                ->where([
                    'form_id'=>$id,
                    'statue'=> 2
                ])->get();

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


    public static function sign($sign){
        try {
            $id = auth('api')->user()->id;
            $res=self::where('id',$id)
                ->update([
                    'sign'=>$sign
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
