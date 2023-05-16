<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public function index($category = 0)
    {
        //Lister les produits et les categories et filtrer les categories par les produits

        $products = Product::OrderBy('created_at', 'asc')->paginate(10); // liste de mes produits

        if ($category != 0) {
            # code...
            $products = Product::Where('category_id', $category)->OrderBy('created_at', 'asc')->paginate(10);
        }

        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        // dd($products) ;

        return view('welcome', compact('products', 'categories')); 

    }

    public function detail(Product $product)
    {

        //selectionner 4 produits qui ont la même catégorie qu'un produit aléatoirement
        $products = Product::Where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        return view('detail', compact('product', 'products', 'categories')); 

    }

}
