<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Session;
use App\Http\Requests\CategoryRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $categories= DB::table('categories')->paginate(4);
        if ($request->name) {
            $categories = Category::where('name','like','%'.$request->name.'%')->get(); 
        }
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //  
        $request->validated();
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->slug ? $request->slug : $request->name);
        $category->isdelete = false;
        $category->isdisplay = false;
        $category->updated_at = null;
        $category->save();
        if ($category){
            return redirect('/admin/category')->with('message','Create successfully!');
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
        $category = Category::findOrFail($id);
        return view('admin.category.detail',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->validated();
        $category= Category::findOrfail($id);
        if (isset($category))
        {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = $request->slug ? $request->slug : $request->name; 
            $category->isdelete = false;
            $category->isdisplay = false;
            $category->updated_at = Carbon::now()->toDateTimeString() ;
            $category->update();
        }else{
            return back()->with('err','Save error!');
        }
        return redirect('admin/category
            ')->with('message','Edit successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $product = Product::where('category_id', '=', $category->id)->get();
        if ($category && $product->count()==0){
            $category->delete();
        }else{
            return redirect("admin/category")->with('message','Dữ liệu đang được sử dụng bên sản phẩm!');
        }
        return redirect("admin/category")->with('message','Xóa thành công');
    }
}