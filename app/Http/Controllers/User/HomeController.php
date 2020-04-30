<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\About;
use App\Models\Slide;
use Session;
use Validator;
use Illuminate\Support\Str; 
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('isdelete','0')->orderBy('created_at', 'desc');
        $abouts = About::take(1)->get(); 
        $categories = Category::where('isdelete','0')->get(); 
        
        foreach ($categories as $key => $value) {
            $listquantity[] = $this->countProduct($value->id);
        }
        if ($request->category) {
            $category_id = Category::where('name',$request->category)->take(1)->get();
            $products = $products->where('category_id',$category_id[0]->id);
        }
        if ($request->productname) {
            $products = $products->where('name', 'like', '%'.$request->productname.'%')->where('isdelete','0');
        }
        if ($request->price) {
            

        }
        $products = $products->paginate(8)->appends(request()->query());
        return view('user.home.product',compact('products','abouts','categories','listquantity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('isdelete','0')->get(); 
        $product = Product::findOrfail($id);
        $abouts = About::take(1)->get(); 
        $colors = DB::table('product_details')->where('product_id',$id)->get();
        $sizes = DB::table('product_details')->where('product_id',$id)->get();
        return view('user.home.productdetail',compact('product','categories','abouts','colors','sizes'));
        
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
    public function homepage()
    {
        $abouts = About::take(1)->get();
        $categories = Category::where('isdelete','0')->get(); 
        $listquatity = array();
        $product_promotions = Product::where('promotion','<>','')->where('isdelete','0')->get(); 
        $slides = Slide::where('isdelete','0')->get(); 
        return view('user.home.home',compact('abouts','product_promotions','categories','slides'));
    }
    public function countProduct($id)
    {
        $quantity = Product::where('category_id',$id)->count(); 
        return $quantity;
    }
}
