<?php
namespace app\admin\controller;
use app\admin\Common;
use app\admin\model\Cate;
use app\admin\model\Power;
use app\admin\service\Service;
use think\Exception;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Session;


class Index extends Common{
    public function index(){
        return view();
    }
    public function logout(){
        if(Cookie::get('admin')) Cookie::delete('admin');
        Session::delete('admin');
        $this->success('退出成功','Login/index');
    }
    public function add(){
        if(Request::isGet()) return view('',['name'=>Session::get('admin')['admin_name']]);
        if(Request::isPost()){
            $data=input('post.');
            $result = $this->validate(
                [
                    'name'  => $data['cate_name'],
                    'order' => $data['cate_order'],
                ],
                'app\admin\validate\Index');
            if($result!==true) $this->error($result);
            $cate=Cate::create($data);
            try {
                if($cate){
                    $this->success('添加成功','show');
                }else{
                    throw new Exception();
                }
            }catch(Exception $e){
                $this->error($e->getMessage());
            }
        }
    }
}