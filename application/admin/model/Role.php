<?php
    namespace app\admin\model;
    use think\Db;
    use think\Model;

    class Role extends Model{
        protected $pk="role_id";
        public function power(){
            return $this->belongsToMany('power');
        }
        public static function selectRole(){
            return self::select();
        }
        public static function addRole($name){
            return self::insertGetId(['role_name'=>$name]);
        }
        public static function addRolePower($role_id,$power_id){
            $data=[];
            foreach($power_id as $k=>$v){
                $data[]=['role_id'=>$role_id,'power_id'=>$v];
            }
            return Db::name('role_power')->insertAll($data);
        }
    }