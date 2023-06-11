<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    //
    public function index()
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        $addresses = Address::where('user_id', Auth::user()->id)->get();

        // dd($addresses);

        return view('address', compact('categories', 'addresses'));
    }

    /**
     * Ajout
     */
    // Afficher le formulaire
    public function formAdd()
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        return view('address_edit', compact(
            'categories',
        ));
    }

    // Créer la news
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'postal' => 'required|min:2',
            'city' => 'required|min:2',
            'country' => 'required|min:2',
            'phone' => 'required|min:2',
        ]);
    
        $address = new Address;
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->address = $request->address;
        $address->postal = $request->postal;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->phone = $request->phone;
    
        // Concaténation des parties de l'adresse
        $address->full_address = $request->address . '<br>' . $request->postal . ' ' . $request->city . '<br>' . $request->country;
    
        $address->save();
    
        return Redirect::route('address');
    }
    

    public function show($id)
    {
        $addresses = Address::findOrFail($id);

        // dd($oneNews);

        return view('address', compact('addresses'));
    }

    /**
     * Edition
     */
    // Afficher le formulaire de modification
    public function formEdit($id)
    {
        $address = Address::findOrFail($id);

        $categories = Category::orderBy('name', 'asc')->get();

        // dd($address);

        return view('address_edit', compact(
            'address',
            'categories'
        ));
    }
    // Enregistrer le modification
    public function edit(Request $request, $id)
    {
        $address = Address::findOrFail($id);
    
        $request->validate([
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'postal' => 'required|min:2',
            'city' => 'required|min:2',
            'country' => 'required|min:2',
            'phone' => 'required|min:2',
        ]);
    
        $address->name = $request->name;
        $address->address = $request->address;
        $address->postal = $request->postal;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->phone = $request->phone;
    
        // Mise à jour du champ "full_address"
        $address->full_address = $request->address . '<br>' . $request->postal . ' ' . $request->city . '<br>' . $request->country;
    
        $address->save();
    
        return redirect(route('address'));
    }
    

    /**
     * Supression
     */

    public function delete($id = 0)
    {

        $address = Address::findOrFail($id);

        $address->delete();

        return redirect(route('address'));
    }
}
