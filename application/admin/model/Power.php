<?php
    namespace app\admin\model;
    use think\Db;
    use think\Model;

    class Power extends Model{
        protected $pk='power_id';
        public static function selectPower(){
            return self::select();
        }
    }