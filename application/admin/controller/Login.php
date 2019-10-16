<?php
namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\Power;
use app\admin\service\Service;
use think\Controller;
use think\Db;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Session;

class Login extends Controller
{
    public function index(){
        return view();
    }
    public function login(){
        if(Request::isGet()) return view();
        if(Request::isPost()){
            $admin_name=input('post.admin_name','');
            $admin_pwd=input('post.admin_pwd','');
            $save=input('post.save',0);
                if($admin_name=='' || $admin_pwd==''){
                    echo json_encode(['status'=>3,'msg'=>"异常"]);
                }else{
                    $data=Admin::findAdminByName($admin_name);
                    if(!$data){
                        echo json_encode(['status'=>1,'msg'=>"用户名错误"]);
                    }else{
                        if($data['admin_status']!=1){
                            echo json_encode(['status'=>3,'msg'=>'异常']);
                        }else{
                            $pwd=md5(md5($admin_pwd).$data['admin_sult']);
                            if($pwd===$data['admin_pwd']){
                                if($save==1) Cookie::set('admin',$data,3600*24*7);
                                Session::set('admin',$data);
                                $power=Service::findPowerByAdminId($data['admin_id']);
                                Session::set('power',$power);
                                echo json_encode(['status'=>0,'msg'=>'ok']);
                            }else{
                                echo json_encode(['status'=>'2','msg'=>'密码错误']);
                            }
                        }
                    }
                }
//            $code=input('post.code','');
//            if(!captcha_check($code)) $this->error("验证码错误");
//            $admin_name=input('post.admin_name','');
//            $admin_pwd=input('post.admin_pwd','','md5');
//            $save=input('post.save','0');
//            $result = $this->validate(
//                [
//                    'name'  => $admin_name,
//                    'pwd' => $admin_pwd,
//                ],
//                'app\admin\validate\Login');
//            if (true !== $result) {
//                // 验证失败 输出错误信息
//                $this->error($result);
//            }
//            $data=Db::table('shop_admin')->field('admin_id,admin_name')->where('admin_name',$admin_name)->where('admin_pwd',$admin_pwd)->find();
//            if(!$data) $this->error('密码或用户名错误');
//            if($save) Cookie::set('admin',$data,3600*24*7);
//            Session::set('admin',$data);
//            $this->success('登录成功','Index/index');
        }
    }

}
