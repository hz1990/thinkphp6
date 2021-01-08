<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\Request;

class Admin
{
    /*
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //管理员列表页
        $data = Db::name('admin')->paginate('25');
        View::assign('data',$data);
        return View::fetch();
    }

    /*
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //管理员添加页
        return View::fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //管理员添加操作
        if(request()->isPost()){
            if($_FILES['file']['size'] !=0){
                $file = request()->file('file');
                $savename = \think\facade\Filesystem::disk('public')->putFile( 'avatar', $file);
            }
            $data['username'] = input('post.username');
            $data['truename'] = input('post.truename');
            $data['sex'] = input('post.sex');
            $data['phone'] = input('post.phone');
            $data['email'] = input('post.email');
            $data['password'] = sha1(md5(input('post.password')));
            $data['avatar'] = $savename;
            $data['regtime'] = time();
            $data['regip'] = getIp();
            if(Db::name('admin')->insert($data)){
                return 1;
            }else{
                return 0;
            }
        }
    }

    /*
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //详情页显示
        $data = Db::name('admin')->where(['id'=>$id])->find();
        View::fetch('data',$data);
        return View::fetch();
    }

    /*
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //修改页
        $data = Db::name('admin')->where(['id'=>$id])->find();
        View::assign('data',$data);
        return View::fetch();
    }

    /*
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        //修改操作
        if($request->isPost()){
            $data = input('post.');
            if(empty($data['password'])){
                unset($data['password']);
            }else{
                $data['password'] = sha1(md5(input('post.password')));
            }
            unset($data['avatar']);
            if(isset($_FILES['file']) && $_FILES['file']['size'] !=0){
                $file = request()->file('file');
                $savename = \think\facade\Filesystem::disk('public')->putFile( 'avatar', $file);
                $data['avatar'] = $savename;
            }
            if(Db::name('admin')->update($data)){
                return 1;
            }else{
                return 0;
            }
        }
    }

    /*
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //伪删除
        if(request()->isPost()){
            if(Db::name('admin')->where(['id'=>$id])->update(['status'=>2])){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function deleteAll($ids)
    {
        //伪删除
        $ids = explode(',',$ids);
        if(request()->isPost()){
            if(Db::name('admin')->whereIn('id',$ids)->update(['status'=>2])){
                return 1;
            }else{
                return 0;
            }
        }
    }
}
