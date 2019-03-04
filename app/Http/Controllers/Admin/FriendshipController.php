<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use App\Models\tp_friendship;
use DB;
class friendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $list = $request->all();
        $tp_fs = new tp_friendship;
        $count = $request->input('count',5);
        $search = $request->input('search','');
        $data = $tp_fs::where('fs_name','like','%'.$search.'%')->paginate($count);
        $i = 1;
        return view('admin/friendship/index',['data' => $data,'i' => $i,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/friendship/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        //
        $data = $request->except('_token');
        // dump($data);

        $file = $request->file('fs_logo');
        // dd($data['fs_logo']);
        if ($file == true) {
            // 获取文件后缀
            $ext = $file->extension();
            // 拼接文件名
            $logo_name = time().rand(100,999).'.'.$ext;
            // 执行文件上传
            $res = $file->storeAs('public',$logo_name);
            if ($res == false) {
                return back()->with('图片添加失败');
            }
        }else{
            // 未选择则默认logo图片
            $logo_name = time().rand(100,999).'.jpg';
        }


        // 执行写入数据库
        $tp_fs = new tp_friendship;
        $tp_fs->fs_name = $data['fs_name'];// 链接名称
        $tp_fs->fs_link = $data['fs_link'];// 链接网址
        $tp_fs->fs_note = $data['fs_note'];// 公司名字
        $tp_fs->fs_logo = $logo_name;// logo名字
        $tp_fs->fs_status = 0;// 是否启用 默认0启用
        $bool = $tp_fs->save();// 写入
        if ($bool == true) {
            return redirect('admin/friendship')->with('success','添加成功');
        }else{
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
        //
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tp_fs = new tp_friendship;
        $data = $tp_fs->first();
        dd($data);
        return view('admin/friendship/edit');
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
    }
}
