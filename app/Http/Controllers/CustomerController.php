<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function home()
    {
        $productsNot = Product::where('bestseller', 'no')->get();

        $productsYes = Product::where('bestseller', 'yes')->get();

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
}
