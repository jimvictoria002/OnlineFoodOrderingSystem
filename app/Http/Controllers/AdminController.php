<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function home()
    {
        $productsNot = Product::where('bestseller', 'no')->get();

        $productsYes = Product::where('bestseller', 'yes')->get();

        $categories = Category::orderBy('created_at', 'desc')
        ->get();
        
        return view("admin.home",
         ["productsNot"=> $productsNot,
         "productsYes"=> $productsYes,
         "categories"=> $categories]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

    public function addproduct($category)
    {
        $categoryExists = Category::where('category_name', $category)->exists();

        if (!$categoryExists) {
            abort(404, 'Category not found');
        }
        return view("admin.addproduct", ["category"=> $category]);
    }

    public function storeproduct(Request $request, $category)
    {
        
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_img' => 'required|mimes:jpeg,jpg,png,gif,tiff,webp|max:10000',
        ]);

        $validated['category'] = $category;

        $FullFileName = $request->file('product_img');

        $filename = pathinfo($FullFileName, PATHINFO_FILENAME);

        $extension = $request->file('product_img')->getClientOriginalExtension();

        $filenameToStore = $filename .'_'.time().'.'. $extension;

        $validated['product_img'] = $filenameToStore;

        $request->file('product_img')->storeAs('public/products', $filenameToStore);

        Product::create($validated);

        return redirect()
        ->route('admin.category', ['category' => $category])
        ->with('success', 'Product added');
    }

    public function updateproduct(Request $request, $category , $product_id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
        ]);
        $product = Product::find($product_id);
        if ($request->hasFile('product_img')) {
            $request->validate([
                'product_img' => 'required|mimes:jpeg,jpg,png,gif,tiff,webp|max:10000',
            ]);

            $FullFileName = $request->file('product_img');

            $filename = pathinfo($FullFileName, PATHINFO_FILENAME);

            $extension = $request->file('product_img')->getClientOriginalExtension();

            $filenameToStore = $filename .'_'.time().'.'. $extension;

            $validated['product_img'] = $filenameToStore;

            $request->file('product_img')->storeAs('public/products', $filenameToStore);
            Storage::delete('public/products/' . $product->product_img);
        }
       
        $product->update($validated);

        return back()->with("success","Product updated");
    }

    public function markbestseller($category, $product_id)
    {   
        $product = Product::find($product_id);
        
        if( $product->bestseller == 'yes'){
            $product->bestseller = 'no';
        }else{
            $product->bestseller = 'yes';
        }
        $product->save();
        return back()->with("success","Product marked as best seller");
    }

    public function viewproduct($category, $product_id)
    {   
        $categoryExists = Category::where('category_name', $category)->exists();
        $productExists = Product::where('id', $product_id)->exists();
        if (!$categoryExists || !$productExists) {
            abort(404, 'Category not found');
        }
        $product = Product::find($product_id);
        return view("admin.viewproduct", ['product' => $product]);
    }

    public function deleteproduct($category, $product_id)
    {   
        Product::destroy($product_id);
        return redirect("/admin/$category")->with('success','Product deleted');
    }

    public function category($category)
    {
        $categoryExists = Category::where('category_name', $category)->exists();

        if (!$categoryExists) {
            abort(404, 'Category not found');
        }
        $productsNot = Product::where('category', $category)
        ->where('bestseller', 'no')->orderBy('created_at', 'desc')->get();

        $productsYes = Product::where('category', $category)
        ->where('bestseller', 'yes')->get();
        
        return view("admin.category",
         ["productsNot"=> $productsNot,
         "productsYes"=> $productsYes,
          "category"=> $category]);
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);
        Category::create([
            "category_name" => $request->category
        ]);
        return redirect("/admin/$request->category");
    }

    public function deletecategory(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        $category->destroy($category_id);
        Product::where("category", $category->category_name)->delete();
        return redirect("/admin/home");
    }

    public function updatecategory(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        Product::where("category", $category->category_name)->update([
            "category"=> $request->category
        ]);
        $category->update([
            "category_name"=> $request->category
        ]);
        return redirect("/admin/home");
    }
}
