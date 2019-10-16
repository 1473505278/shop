<?php
    namespace app\admin\controller;
    use app\admin\Common;
    use app\admin\model\Admin;
    use app\admin\model\Power;
    use app\admin\model\Role;
    use app\admin\service\Service;
    use think\facade\Request;
    use think\facade\Session;

    class Admins extends Common{
        public function update(){
            echo "我是修改";
        }
        public function del(){
            echo "我是删除";
        }
        public function show(){
            $data=Admin::all();
            return view('',['data'=>$data]);
        }
        public function add(){
            if(Request::isGet()){
                $role=Role::all();
                return view('',['role'=>$role]);
            }
            if(Request::isPost()){
                $admin_name=input("post.admin_name",'');
                $admin_pwd=input("post.admin_pwd",'');
                $role=input("post.admin_role",0);
                $admin=new Admin;
                $data=$admin->save(['admin_name'=>$admin_name,'admin_pwd'=>$admin_pwd]);
                if($role!=0){
                    $res=Admin::addAdminRole($data,$role);
                }
                if($data){
                    echo json_encode(['status'=>1,'msg'=>'ok']);
                }else{
                    echo json_encode(['status'=>0,'msg'=>'no']);
                }
            }
        }
    }