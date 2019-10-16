<?php
    namespace app\admin\controller;
    use app\admin\Common;
    use app\admin\model\Power;
    use app\admin\model\Role;
    use app\admin\service\Service;
    use think\facade\Request;
    use think\facade\Session;

    class Roles extends Common{
        public function update(){
            echo "我是修改";
        }
        public function del(){
            echo "我是删除";
        }
        public function show(){
            $data=Role::selectRole();
            return view('',['data'=>$data]);
        }
        public function add(){
            if(Request::isGet()){
                $powers=Power::all();
                $powers=Service::getPowerOrder($powers);
                return view('',['powers'=>$powers]);
            }
            if(Request::isPost()){
                $role_name=input("post.role_name",'');
                $power_id=input("post.power_id",[]);
                $data=Role::addRole($role_name);
                if(!empty($power_id)){
                    $res=Role::addRolePower($data,$power_id);
                }
                if($data){
                    echo json_encode(['status'=>1,'msg'=>'ok']);
                }

            }
        }

    }