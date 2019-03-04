<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use App\Model\Admin\tp_admin_users;
use App\Model\Admin\tp_admin_user_infos;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //dump($request->all());
        $count = $request->input('count',5);


        $i = 1;
        $uname = $request->input('user','');
        $tp_data = tp_admin_users::where('admin_name','like','%'.$uname.'%')->paginate($count);

        return view('admin.users.index',['data'=>$tp_data,'i'=>$i,'request'=>$request->all() or ""]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        /*开启事务   DB::beginTransaction();
        提交事务    DB::commit()
        回滚事务   DB::rollBack()*/

            DB::beginTransaction();
            //接收数据

           $data = $request->except(['_token','admin_repassword','admin_avatar']);
           //dump($data);
            //创建文件对象

            $file = $request->file('admin_avatar');
            if (!$file == null) {

                //移动文件路径
                $res = $file->storeAs('home_avatar',time().rand(2,100000000000).'.jpg');
                    $data['admin_avatar'] = $res;
            } else {
                $res = 'user_avatar.jpg';//如果用户没有头像，就直接用系统的统一头像；
                    $data['admin_avatar'] = $res;
            }

            $users = new tp_admin_users;
            $users->admin_name = $data['admin_name']; // 用户名
            $users->admin_password = Hash::make($data['admin_password']); // 密码
            $users->admin_email = $data['admin_email']; // 邮箱
            $users->admin_phon = $data['admin_phon']; // 电话号码
            $users->admin_level = $data['admin_permission']; // 权限
            $data_user = $users->save(); // 写入
            $id = $users->id;

            $userinfo = new tp_admin_user_infos;
            $userinfo->uid = $id;
            $userinfo->admin_text = $data['admin_itn'];
            $userinfo->admin_avatar = $data['admin_avatar'];
            $data_user_info = $userinfo->save(); // 写入

            if ($data_user && $data_user_info == true) {
                DB::commit();

                return redirect('admin/user')->with('success','添加成功');
            }else{
                echo "提交失败";
                DB::rollBack();
               return back()->with('error','添加失败');
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            echo 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            echo $id;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo 3;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo 4   ;
        //
    }
}
