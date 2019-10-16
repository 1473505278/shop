<?php
    namespace app\admin\controller;
    use app\admin\Common;
    use app\admin\model\Cate;
    use app\admin\model\Power;
    use app\admin\service\Service;
    use think\facade\Session;

    class Cates extends Common{
        public function show(){
            $data=Cate::selectCate();
            $data=Service::getCateOrder($data);
            return view('',['data'=>$data]);
        }

        public  function add(){
            return view();
        }
    }