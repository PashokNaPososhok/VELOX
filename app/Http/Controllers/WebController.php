<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function index()
    {
        $array = DB::table('slider')->limit(5)->get();
        return view('home', compact('array'));
    }
    public function admin()
    {
        $array = DB::table('products')->get();
        $red = DB::table('category')->get();
        $contact = DB::table('contact')->get();
//        if(Auth::user()->id_role==2){
//            $categories = DB::table('category')->get();
//            return view('admin',compact('categories'));
//        }
//        else {
//            return redirect('/');
//        }
        return view('admin', compact('red', 'array', 'contact'));
    }
    public function delcontact($id)
    {
        DB::table('contact')->where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Заявка удалена');
    }
    public function addCategory(Request $request)
    {
        DB::table('category')->insert(['name'=>$request->nameCategory]);
        return redirect()->back()->with('messageAddCategory','Category added seccessfully');
    }
    public function delCategory(Request $request)
    {
        DB::table('category')->where('id','=',$request->id)->delete();
        return redirect()->back()->with('messageDelCategory','Category deleted successfully');
    }
    public function addProducts(Request $request){
        $img = $request->file('image');
        $typeImg = $img->extension();

        $uniqName = Str::random();
        $nameImg = $uniqName.'.'.$typeImg;
        $pathFolder = 'assets/img/';

        $img->move(public_path($pathFolder), $nameImg);

        DB::table('products')->insert([
            'name' => $request->nameProducts,
            'cost' => $request->costProducts,
            'country' => $request->countryProducts,
            'year' => $request->yearProducts,
            'model' => $request->modelProducts,
            'id_category' => $request->id_category,
            'path_products' => $pathFolder . $nameImg
        ]);
        return redirect()->back()->with('messageAddProducts','Продукт добавлен');
    }
    public function delProducts($id)
    {
        DB::table('products')->where('id','=',$id)->delete();
        return redirect()->back()->with('messageDelProducts','Products deleted successfully');
    }
    public function catalog(Request $request)
    {
        if(isset($request->filtr)){
            if($request->filtr=='yearFiltr'){$array = DB::table('products')->orderBy('year')->get();}
            else if($request->filtr=='nameFiltr'){$array = DB::table('products')->orderBy('name')->get();}
            else $array = DB::table('products')->orderBy('cost')->get();}
        if(isset($request->id_category)){$array = DB::table('products')->where('id_category','=',$request->id_category)->get();}
        else{$array = DB::table('products')->get();}
        $categories = DB::table('category')->get();
        return view('catalog', compact('array','categories'));
    }
    public function card($id)
    {
        $array = DB::table('products')->where('id','=',$id)->first();
        return view('card', compact('array'));
    }

    public function editProductsView($id) {
        $products = DB::table('products')->where('id','=',$id)->first();
        return view('editProductsView', compact('products'));
    }

    public function editProducts($id, Request $request){
        DB::table('products')->where('id','=',$id)->update([
            'name'=>$request->name,
            'cost'=>$request->cost
        ]);
        if(isset($request->image)){
            $img = $request->file('image');
            $typeImg = $img->extension();

            $uniqName = Str::random();
            $nameImg = $uniqName.'.'.$typeImg;
            $pathFolder = 'assets/img/';

            $img->move(public_path($pathFolder), $nameImg);

            DB::table('products')->where('id','=',$id)->update([
                'image'=>$pathFolder . $nameImg
            ]);
        }
        return redirect()->back()->with('message','Продукт отредактирован');
    }
    public function magazin()
    {
        return view('magazin');
    }
    public function contact()
    {
        return view('contact');
    }
    public function addcontact(Request $request)
    {
    $request->validate([
        'name' => ['required', 'regex:/^[A-Za-zа-яА-ЯёЁ\-\s]+$/u', 'max:255'],
        'phone' => ['required', 'max:255'],
        'car' => ['required', 'max:255'],
        'date' => ['required', 'date'],
        'time' => ['required'],
        'contact_method' => ['required', 'max:255'],
        'comment' => ['nullable', 'max:1000'],
    ]);

    DB::table('contact')->insert([
        'name' => $request->name,
        'phone' => $request->phone,
        'car' => $request->car,
        'date' => $request->date,
        'time' => $request->time,
        'contact_method' => $request->contact_method,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Заявка на тест-драйв успешно отправлена');
    }
    public function profile()
    {
        return view('profile');
    }
}
