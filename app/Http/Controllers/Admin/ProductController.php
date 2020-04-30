<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_Detail;
use Session;
use Validator;
use Illuminate\Support\Str; 
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function getCategory()
    {
        return Category::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')->where('isdelete',false);
        //$categories = $this->getCategory();
        if ($request->name) {
            $products = $products->where('name','like','%'.$request->name.'%'); 
        }
        $products = $products->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::where('isdelete',false)->pluck('name','id')->toArray();
        $category = Category::where('isdelete',false)->pluck('name','id')->toArray();
        return view('admin.product.create',compact('brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        if($request->hasFile('image'))
        {
            $imagename = '';
            foreach ($request->image as $key => $value) {
                $image=$value->getClientOriginalName();
                $value->move('images', $image);
                $imagename .=$image.',';
            }
            $imagename = substr($imagename, 0, -1);
        }
        $product = new  Product();
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->slug = Str::slug($request->slug ? $request->slug : $request->name);
        $product->image = $imagename;
        $product->promotion = $request->promotion;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->isdelete = false;
        $product->isdisplay = false;
        $product->updated_at = null;
        $product->save();
        foreach ($request->size as $key => $size) {
            $colors = 'color'.$key;
            $colors = $request->$colors;
            foreach ($colors as $key => $color) {
                $product_detail = new Product_Detail([
                    'product_id' => $product->id,
                    'size' => $size,
                    'color' => $color,
                    'isdelete' => false,
                    'isdisplay' => false,
                    'updated_at' => null
                ]);
                $product_detail->save();
            }
        }
        
        if ($product){
            return redirect('/admin/product')->with('message','Create successfully!');
        }else{
            return back()->with('err','Save error!');
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
        $product = Product::findOrfail($id);
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrfail($id);
        $brand = Brand::where('isdelete',false)->pluck('name','id')->toArray();
        $category = Category::where('isdelete',false)->pluck('name','id')->toArray();
        $product_details = Product_Detail::where('isdelete',false)->where('product_id',$id)->get();
        return view('admin.product.edit',compact('brand','category','product','product_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if($product)
        {
            if ($request->hasFile('imagee') )
            {
                $imagename = '';
                foreach ($request->imagee as $key => $value) {
                    $image=$value->getClientOriginalName();
                    $value->move('images', $image);
                    $imagename .=$image.',';
                }
                $imagename = substr($imagename, 0, -1);
            }else{
                $imagename = $request->image;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->slug = Str::slug($request->slug ? $request->slug : $request->name);
            $product->image = $imagename;
            $product->promotion = $request->promotion;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->updated_at = Carbon::now()->toDateTimeString();
            $product->isdelete = false;
            $product->isdisplay = false;
            $product->updated_at = Carbon::now()->toDateTimeString() ;
            $product->update();
            if ($request->size) {
                foreach ($request->size as $key => $size) {
                    $colors = 'color'.$key;
                    $colors = $request->$colors;
                    foreach ($colors as $key => $color) {
                        $product_detail = new Product_Detail([
                            'product_id' => $id,
                            'size' => $size,
                            'color' => $color,
                            'isdelete' => false,
                            'isdisplay' => false,
                            'updated_at' => null
                        ]);
                        $product_detail->save();
                    }
                }
            }
            return redirect('/admin/product')->with('message','Update successfully!');
        }
        return back()->with('err','Update err!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product) {
            $product->isdelete = true;
            $product->update();
            return back()->with('message','Delete success!');
        } else {
            return back()->with('err','Delete failse!');
        }  
    }
    public function setvalue(Request $request)
    {
        if ($request->ajax()) {
            $value = class_basename($request->value);
            return Response($value);
        }
    }
    public function getcolor(Request $request)
    {
        if ($request->ajax()) {
            $colors = Product_Detail::select('color')->where('isdelete',false)->where('product_id',$request->id)->where('size',$request->size)->get();
            return Response($colors);
        }
    }
}