<?php
namespace app\admin;
use app\admin\service\Service;
use think\Controller;
use think\facade\Config;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Session;

class Common extends Controller{
    public function __construct()
    {
        parent::__construct();
        if(!Session::get('admin') && Cookie::get('admin')) Session::set('admin',cookie('admin'));
        if(!Session::get('admin')) $this->success('请先登录','Login/index');
        $admin_id=Session::get('admin')['admin_id'];
        $power=Service::findPowerByAdminId($admin_id);
        $power=Service::getPowerOrder($power);
        $this->assign('power',$power);
        if(!$this->checkPower()){
            if(Request::isAjax()){
                echo json_encode(['static'=>-1,'msg'=>'没权限']);
            }
            $this->error("对不起 您没有权限！");
        }

    }
    private function checkPower(){
        if(in_array(Session::get('admin')['admin_name'],config("power.super_admin"))){
            return true;
        }
        $controller=ucfirst(Request::controller());
        $action=Request::action();
        $url=$controller."/".$action;
        if(in_array($url,config("power.public_power"))){
            return true;
        }else{
            $power=Session::get('power');
            $admin_url=array_column($power,'power_url','power_id');
            if(in_array($url,$admin_url)){
                return true;
            }else{
                return false;
            }
        }
    }
}
