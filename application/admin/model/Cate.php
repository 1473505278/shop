<?php

    namespace app\admin\model;

    use think\Db;
    use think\Model;

    class Cate extends Model{
        public static function selectCate(){
            return self::select();
        }
    }
