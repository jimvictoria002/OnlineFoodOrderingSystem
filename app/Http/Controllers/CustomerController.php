<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function home()
    {
        $productsNot = Product::where('bestseller', 'no')->get();

        $productsYes = Product::where('bestseller', 'yes')->orderBy('updated_at', 'desc')->get();

        $categories = Category::orderBy('created_at', 'desc')
        ->get();
        
        return view("customer.home",
         ["productsNot"=> $productsNot,
         "productsYes"=> $productsYes,
         "categories"=> $categories]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

    public function viewproduct($category, $product_id)
    {   
        $this->checkProduct($category, $product_id);
        $relatedProducts = Product::where('category', $category)->get();
        $product = Product::find($product_id);
        return view("customer.viewproduct", ['product' => $product, 'relatedProducts' => $relatedProducts]);
    }

    public function buyproduct($category, $product_id, $user_id)
    {   
        $this->checkProduct($category, $product_id);
        $order = Order::create([
            'product_id'=> $product_id,
            'customer_id' => $user_id
        ]);

        return redirect('/myorders/view');
    }

    public function myorders($view)
    {
        $orders = Order::where('customer_id', Auth::user()->id)
        ->where('status','!=', 'completed')
        ->where('status','!=', 'cancelled')
        ->join('products','orders.product_id','=','products.id')
        ->select('orders.id as order_id', 'products.id as product_id', 'orders.*', 'products.*')
        ->orderBy('orders.created_at','desc')->get();

        if($view == 'completed' || $view == 'cancelled'){
            $orders = Order::where('customer_id', Auth::user()
            ->id)->where('status', $view)
            ->join('products','orders.product_id','=','products.id')
            ->select('orders.id as order_id', 'products.id as product_id', 'orders.*', 'products.*')
            ->orderBy('orders.updated_at','desc')->get();
        }

        return view('customer.myorders', ['orders' => $orders]); 
    }

    public function cancelorder($order_id)
    {   
        $order = Order::find($order_id);
        $order->status = 'cancelled';
        $order->save();

        return redirect('/myorders/cancelled');
    }

    public function category($category)
    {
        $this->checkCategory($category);

        $productsNot = Product::where('category', $category)
        ->where('bestseller', 'no')->orderBy('created_at', 'desc')->get();

        $productsYes = Product::where('category', $category)
        ->where('bestseller', 'yes')->orderBy('updated_at', 'desc')->get();
        
        return view("customer.category",
         ["productsNot"=> $productsNot,
         "productsYes"=> $productsYes,
          "category"=> $category]);
    }


    //check if exist methods
    public function checkCategory($category)
    {
        $categoryExists = Category::where('category_name', $category)->exists();
        if (!$categoryExists) {
            abort(404, 'Category not found');
        }
    }

    public function checkProduct($category, $product_id)
    {
        $categoryExists = Category::where('category_name', $category)->exists();
        $productExists = Product::where('id', $product_id)->exists();
        if (!$categoryExists || !$productExists) {
            abort(404, 'Category not found');
        }
    }

}
