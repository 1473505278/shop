<?php
    namespace app\admin\service;
    use app\admin\model\Admin;
    use app\admin\model\Power;
    use app\admin\model\Role;

    class Service {
        public static function getCateOrder($data,$pid=0,$level=0){
            $cateOrder=[];
            foreach($data as $k=>$v){
                if($v['cate_pid']==$pid){
                    $v['level']=$level;
                    $cateOrder[]=$v;
                    $cateOrder=array_merge($cateOrder,self::getCateOrder($data,$v['cate_id'],$level+1));
                }
            }
            return $cateOrder;
        }
        public static function getPowerOrder($data,$pid=0,$level=0){
            $powerOrder=[];
            foreach($data as $k=>$v){
                if($v['power_pid']==$pid){
                    $v['level']=$level;
                    $powerOrder[]=$v;
                    $powerOrder=array_merge($powerOrder,self::getPowerOrder($data,$v['power_id'],$level+1));
                }
            }
            return $powerOrder;
        }
        public static function findPowerByAdminId($admin_id){
            $admin_name=Admin::field('admin_name')->get($admin_id);
            if(in_array($admin_name['admin_name'],config("power.super_admin"))){
                return Power::all();
            }
            $power=[];
            $powers=[];
            $role=Admin::get($admin_id)->role;
            foreach($role as $k=>$v){
                $res=Role::get($v['role_id'])->power;
                foreach($res as $key=>$val){
                    $power[]=$val['power_id'];
                }
            }
            $power=array_unique($power);
            foreach($power as $k=>$v){
                $power=Power::get($v);
                $powers[$k]=$power;
            }
            return $powers;
        }
        public static function findPower($admin_id){
            $power=[];
            $role=Admin::get($admin_id)->role;
            foreach($role as $k=>$v){
                $res=Role::get($v['role_id'])->power;
                foreach($res as $key=>$val){
                    $power[]=$val['power_id'];
                }
            }
            $power=array_unique($power);
            return $power;
        }
    }