<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Shop;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userproducts = Shop::where('user_id', auth()->user()->id)->get();

        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $cat = Category::all();
        $products = Shop::orderBy('created_at', 'desc')->paginate(9);
        return view('wishlist.index')->with(['userproducts' => $userproducts, 'cart' => $cart, 'wishlist' => $wishlist, 'cat' => $cat, 'products' => $products]);

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
    public function store(Request $request, $product)
    {
        //
        $item = Shop::find($product);
        $newCart = new Wishlist();
        $newCart->name = $item->name;
        $newCart->prize = $item->prize;
        $newCart->user_id = auth()->user()->id;
        $newCart->image = $item->image;
        $newCart->product_id = $item->id;
        $newCart->about = $item->about;
        $newCart->rating = $item->rating;
        $newCart->save();
        return redirect()->back()->with('success', 'item has successfully been added to wishlist ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Wishlist::find($id);
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        $userproducts = Shop::where('user_id', auth()->user()->id)->get();

        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $cat = Category::all();
        $products = Shop::orderBy('created_at', 'desc')->paginate(9);
        return view('wishlist.show')->with(['userproducts' => $userproducts, 'wishlist' => $wishlist, 'product' => $product, 'cart' => $cart, 'cat' => $cat, 'products' => $products]);

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
        $product = Wishlist::find($id);
        Storage::delete(['/storage/images', $product->image]);
        $product->delete();
        return redirect('/wishlist')->with('success', 'Item has been removed successfully from your wishlist');
    }
}