<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        if(!Auth::check() || Auth::user()->role_id == 1){
            return redirect('/');
        }

        $array = DB::table('products')->orderBy('id', 'desc')->get();
        $red = DB::table('category')->get();

        $contact = DB::table('contact')
            ->leftJoin('users', 'contact.user_id', '=', 'users.id')
            ->select('contact.*', 'users.login as user_login', 'users.email as user_email')
            ->orderBy('contact.id', 'desc')
            ->get();

        return view('admin', compact('red', 'array', 'contact'));
    }

    public function delcontact($id)
    {
        DB::table('contact')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Заявка удалена');
    }


    public function delCategory(Request $request)
    {
        DB::table('category')->where('id', $request->id)->delete();
        return redirect()->back()->with('messageDelCategory','Категория удалена');
    }
    

    public function addProducts(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image'],
            'nameProducts' => ['required', 'max:100'],
            'costProducts' => ['required', 'max:255'],
            'modelProducts' => ['required', 'max:255'],
            'mileageProducts' => ['required', 'max:50'],
            'condition_percent' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $img = $request->file('image');
        $nameImg = Str::random(20) . '.' . $img->extension();
        $pathFolder = 'assets/img/';
        $img->move(public_path($pathFolder), $nameImg);

        DB::table('products')->insert([
            'name' => $request->nameProducts,
            'cost' => $request->costProducts,
            'country' => $request->countryProducts,
            'year' => $request->yearProducts,
            'model' => $request->modelProducts,
            'id_category' => $request->id_category,
            'image' => $pathFolder . $nameImg,
            'mileage' => $request->mileageProducts,
            'description' => $request->descriptionProducts,
            'segment' => $request->segment,
            'color' => $request->color,
            'condition_percent' => $request->condition_percent,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'drive_type' => $request->drive_type,
            'seats' => $request->seats,
            'deposit' => $request->deposit,
            'availability_status' => $request->availability_status,
            'body_type' => $request->body_type,
            'engine_power' => $request->engine_power,
            'engine_volume' => $request->engine_volume,
            'fuel_consumption' => $request->fuel_consumption,
        ]);

        return redirect()->back()->with('messageAddProducts','Автомобиль добавлен');
    }

    public function deleteProduct($id)
    {
        DB::table('contact')->where('product_id', $id)->delete();
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Автомобиль удален');
    }

    public function catalog(Request $request)
    {
        $query = DB::table('products');

        if($request->id_category && $request->id_category != 'all'){
            $query->where('id_category', $request->id_category);
        }

        if($request->filtr == 'yearFiltr'){
            $query->orderBy('year', 'desc');
        } elseif($request->filtr == 'nameFiltr'){
            $query->orderBy('name');
        } elseif($request->filtr == 'costFiltr'){
            $query->orderByRaw('CAST(cost AS UNSIGNED) ASC');
        } else {
            $query->orderBy('id', 'desc');
        }

        $array = $query->get();
        $categories = DB::table('category')->get();

        return view('catalog', compact('array','categories'));
    }

    public function card($id)
    {
        $array = DB::table('products')->where('id', $id)->first();
        return view('card', compact('array'));
    }

    public function editProductsView($id)
    {
        $products = DB::table('products')->where('id', $id)->first();
        return view('editProductsView', compact('products'));
    }

    public function editProducts($id, Request $request)
    {
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'country' => $request->country,
            'year' => $request->year,
            'model' => $request->model,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'segment' => $request->segment,
            'color' => $request->color,
            'condition_percent' => $request->condition_percent,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'drive_type' => $request->drive_type,
            'seats' => $request->seats,
            'deposit' => $request->deposit,
            'availability_status' => $request->availability_status,
            'body_type' => $request->body_type,
            'engine_power' => $request->engine_power,
            'engine_volume' => $request->engine_volume,
            'fuel_consumption' => $request->fuel_consumption,
        ]);

        if($request->hasFile('image')){
            $img = $request->file('image');
            $nameImg = Str::random(20) . '.' . $img->extension();
            $pathFolder = 'assets/img/';
            $img->move(public_path($pathFolder), $nameImg);

            DB::table('products')->where('id', $id)->update([
                'image' => $pathFolder . $nameImg
            ]);
        }

        return redirect()->back()->with('message','Автомобиль отредактирован');
    }

    public function magazin()
    {
        return view('magazin');
    }

    public function podbor(Request $request)
    {
        $segments = DB::table('products')->select('segment')->distinct()->orderBy('segment')->pluck('segment');
        $colors = DB::table('products')->select('color')->distinct()->orderBy('color')->pluck('color');

        $matchedCars = collect();
        $hasSelection = $request->has('find');

        if($hasSelection){
            $query = DB::table('products')->where('availability_status', 'Свободен');

            if($request->segment && $request->segment != 'Не важно'){
                $query->where('segment', $request->segment);
            }

            if($request->color && $request->color != 'Не важно'){
                $query->where('color', $request->color);
            }

            if($request->seats && $request->seats != 'Не важно'){
                $seats = (int) $request->seats;

                if($seats > 0){
                    $query->where('seats', '>=', $seats);
                }
            }

            if($request->condition_percent){
                $query->where('condition_percent', '>=', $request->condition_percent);
            }

            if($request->price_from){
                $query->whereRaw('CAST(cost AS UNSIGNED) >= ?', [$request->price_from]);
            }

            if($request->price_to){
                $query->whereRaw('CAST(cost AS UNSIGNED) <= ?', [$request->price_to]);
            }

            $matchedCars = $query->orderByRaw('CAST(cost AS UNSIGNED) ASC')->get();
        }

        return view('podbor', compact('segments', 'colors', 'matchedCars', 'hasSelection'));
    }

    public function contact(Request $request)
    {
        $selectedCar = null;

        if($request->car_id){
            $selectedCar = DB::table('products')->where('id', $request->car_id)->first();
        }

        return view('contact', compact('selectedCar'));
    }

    public function addcontact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'car' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'contact_method' => ['required', 'max:255'],
            'comment' => ['nullable', 'max:1000'],
            'product_id' => ['nullable', 'integer'],
        ]);

        $productId = $request->product_id;

        if($productId){
            $product = DB::table('products')->where('id', $productId)->first();

            if($product && $product->availability_status != 'Свободен'){
                return redirect()->back()->withInput()->withErrors([
                    'car' => 'Этот автомобиль сейчас занят'
                ]);
            }
        }

        DB::table('contact')->insert([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'name' => $request->name,
            'phone' => $request->phone,
            'car' => $request->car,
            'date' => $request->date,
            'time' => $request->time,
            'contact_method' => $request->contact_method,
            'comment' => $request->comment,
            'status' => 'Новая',
        ]);

        if($productId){
            DB::table('products')->where('id', $productId)->update([
                'availability_status' => 'Занят'
            ]);
        }

        return redirect()->route('profile')->with('success', 'Заявка оформлена');
    }

    public function profile()
    {
        $orders = DB::table('contact')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('profile', compact('orders'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->withErrors([
                'old_password' => 'Старый пароль введен неверно'
            ]);
        }

        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('password_message', 'Пароль изменен');
    }
}
