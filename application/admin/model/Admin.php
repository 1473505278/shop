<?php
    namespace app\admin\model;
    use think\Db;
    use think\facade\Request;
    use think\Model;

    class Admin extends Model{
        protected $pk="admin_id";
        public function Role(){
            return $this->belongsToMany('role');
        }
        public static function findAdminByName($name){
            return self::field('admin_id,admin_name,admin_status,admin_sult,admin_pwd')->where("admin_name",$name)->find();
        }
        public static function selectAdmin(){
            return self::select();
        }
        public static function addAdmin($name,$pwd){
            $sult=substr(rand(),-4);
            $pwd=md5(md5($pwd).$sult);
            $ip=Request::ip();
            $data=['admin_name'=>$name,'admin_pwd'=>$pwd,'admin_time'=>time(),'admin_logintime'=>time(),'admin_loginip'=>$ip,'admin_sult'=>$sult];
            return self::insertGetId($data);
        }
        public static function addAdminRole($admin_id,$role_id){
            $data=['admin_id'=>$admin_id,'role_id'=>$role_id];
            return Db::name('admin_role')->insertGetId($data);
        }
    }