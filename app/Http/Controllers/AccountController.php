<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function index()
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        return view('account', compact('categories'));
    }
}