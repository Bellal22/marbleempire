<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\ProductB ;
class ProductBController extends Controller
{
    // public $x = '0000'  ; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response-
     */
    public function changePassword(Request $request){
        DB::table('users')
            ->where('id', 1)
            ->update(['password' => $request->get('password')]);
        return view('updatePassword') ; 
    }
    public function index()
    {
        $sinks = DB::select('select * from product_b where type = "Sinks"');
        $antiques = DB::select('select * from product_b where type = "Antiques"');
        $pushhummereds = DB::select('select * from product_b where type = "Pushhummered"');
        $tumbleds = DB::select('select * from product_b where type = "Tumbled"');
        $mountains = DB::select('select * from product_b where type = "Mountains"');

        return view('products', ['sinks' => $sinks, 'antiques'=> $antiques, 'pushhummereds' => $pushhummereds, 'tumbleds'=> $tumbleds, 'mountains'=> $mountains]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginValidation(Request $request)
    {
        $y = DB::table('users')->where('id','1')->get();
        
         
        if($request->get('email')== $y[0]->email && $request->get('password') == $y[0]->password) {
            return redirect()->to('dashboard');
        }else {
            return view('errorLogin');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new ProductB([
            'product_name' => $request->get('product_name'),
            // 'product_no' => $request->get('product_no'),
            'describtion'=> $request->get('describtion'),
            'details'=> $request->get('details'),
            'type'=> $request->get('type'),
          ]);
          $product->save();
          return redirect()->to('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAddProducts()
    {
        return view('dashboardB'); 
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request)
    {
        
        
        DB::table('product_b')->where('product_name', '=', $request->get('product_name'))->delete();
        return redirect()->to('dashboard');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addSitePhoto(Request $request)
    {
        // to write the code which upload Site photo
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
    }
}
