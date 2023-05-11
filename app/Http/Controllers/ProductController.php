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
    public function index($id = 0)
    {
        // Si id != 0 on liste par catégories sinon on liste tout.
        if ($id != 0) {
            // Afficher les Product de la catégorie par date de création
            $products = Product::where('category_id', $id)->orderBy('updated_at', 'desc')->paginate(10);
        } else {
            $products = Product::orderBy('updated_at', 'desc')->paginate(10);
        }
        $categories = Category::orderBy('name', 'ASC')->get();

        // dd($categories);

        return view('accueil', compact('products', 'categories'));
    }

    public function detail(Product $product)
    {
        // Afficher le détail du produits mais aussi les produits similaires

        $products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        // dd($products);

        return view('detail', compact('product'));
    }

}
