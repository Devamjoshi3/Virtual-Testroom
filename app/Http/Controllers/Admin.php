<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oex_category;
use Validator;
class Admin extends Controller
{
    public function index()
	{
		return view('admin.dashboard');
	}
	public function exam_category()
	{
		$data['category']=Oex_category::orderBy('id','desc')->get()->toArray();
		return view('admin.exam_category',$data);
	}
	public function add_new_category(Request $request)
	{
		$validator=Validator::make($request->all(),['name'=>'required']);
		if($validator->passes())
		{
			$cat = new Oex_category();
			$cat->name=$request->name;
			$cat->status=1;
			$cat->save();
			$arr=array('status'=>'true','message'=>'success','reload'=>url('/admin/exam_category'));
		}
		else
		{
			$arr=array('status'=>'false','message'=>$validator->errors()->all());
		}
		echo json_encode($arr);
	}
	public function delete_category($id)
	{
		$cat = Oex_category::where('id',$id)->get()->first();
		$cat->delete();
		return redirect(url('admin/exam_category'));
	}
	public function edit_category($id)
	{
		$category = Oex_category::where('id',$id)->get()->first();
		return view('admin.edit_category',['category'=>$category]);
	}
	public function edit_new_category(Request $request)
	{
		$cat = Oex_category::where('id',$request->id)->get()->first();
		$cat->name=$request->name;
		$cat->update();
		echo json_encode(array('status'=>'true','message'=>'Category Successfully Updated','reload'=>url('/admin/exam_category')));
	}
	public function category_status($id)
	{
		$cat=Oex_category::where('id',$id)->get()->first();
		print_r($cat);
		if($cat->status==1)
		{
			$status=0;
		}	
		else
		{
			$status=1;
		}	
		$cat1=Oex_category::where('id',$id)->get()->first();
		$cat1->status=$status;
		$cat1->update();	
	}

}
