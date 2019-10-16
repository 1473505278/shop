<?php
    namespace app\admin\controller;
    use app\admin\Common;
    use app\admin\model\Brand;
    use think\facade\Request;

    class Brands extends Common{
        public function show(){
            $brand=Brand::all();
            return view('',['brand'=>$brand]);
        }
        public function add(){
            if(Request::isGet()){
                return view();
            }
            if(Request::isPost()){
                $data=$this->request->post();
                $brand=new Brand;
                $res=$brand->save($data);
                if($res){
                    echo json_encode(['status'=>1,'msg'=>'ok']);
                }
            }
        }
        public function del(){
            echo "我是品牌的删除";
        }
    }