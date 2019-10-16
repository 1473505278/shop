<?php
    namespace app\admin\controller;
    use app\admin\Common;
    use app\admin\model\Power;
    use think\facade\Request;
    use think\facade\Session;

    class Powers extends Common{
        public function add(){
            if(Request::isGet()){
                return view();
            }
            if(Request::isPost()){
                $power_name=input("post.power_name",'');
                $power_pid=input("post.power_pid",'');
                $power_controller=input("post.power_controller",'');
                $power_action=input("post.power_action",'');
                $power_url=$power_controller."/".$power_action;
                $power=new Power;
                $power->power_name=$power_name;
                $power->power_pid=$power_pid;
                $power->power_controller=$power_controller;
                $power->power_action=$power_action;
                $power->power_url=$power_url;
                $power->save();
                if($power->power_id){
                    echo json_encode(['status'=>1,'msg'=>'ok']);
                }
            }
        }
    }