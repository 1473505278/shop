<?php
    namespace app\admin\controller;
    use app\admin\Common;

    class Attrs extends Common{
        public function show(){
            return view();
        }
        public function add(){
            return view();
        }
        public function del(){
            echo "我是属性的删除";
        }
        public function update(){
            echo "我是属性的修改";
        }
    }