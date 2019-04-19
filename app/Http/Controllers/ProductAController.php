<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProductA ;

class ProductAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egyptians = DB::select('select * from product_a where type = 0 AND class= 0');
        $imports = DB::select('select * from product_a where type = 0 AND class= 1');
        
        return view('marble', ['egyptians' => $egyptians, 'imports' => $imports]);

    }
    public function indexGranite()
    {
        $egyptians = DB::select('select * from product_a where type = 1 AND class= 0');
        $imports = DB::select('select * from product_a where type = 1 AND class= 1');
        
        return view('granite', ['egyptians' => $egyptians, 'imports' => $imports]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMarble(Request $request)
    {
        // dd($request->get('product_name'));
        $product = new ProductA([
            'product_name' => $request->get('product_name'),
            'describtion'=> $request->get('describtion'),
            'details'=> $request->get('details'),
            'type'=> $request->get('type'),
            'class'=> $request->get('class')
          ]);
          $product->save();
        
        
           return redirect()->to('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productDetails($id)
    {
        
        $marble = DB::table('product_a')->where('id','=',$id)->get(); 
        
        if(!($marble->isEmpty())){
            $itemDetails =$marble[0] ; 
            return view('itemDetails', ['itemDetails' => $itemDetails]);
        }else{
            return view('home'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ProductDetailsB($id)
    {
        
        $marble = DB::table('product_b')->where('id','=',$id)->get(); 
        
        if(!($marble->isEmpty())){
            $itemDetails =$marble[0] ; 
            return view('itemDetails', ['itemDetails' => $itemDetails]);
        
        }else {
            return view('home'); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMarble(Request $request)
    {
        
        
        DB::table('product_a')->where('product_name', '=', $request->get('product_name'))->delete();
        return redirect()->to('dashboard');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateA(Request $request)
    {
        $check = $request->get('product_name'); 
        $data  = DB::table('product_a')->select('*')->where('product_name','=',$check)->get(); 
        try{
            if(!($data->isEmpty())){
                $dataBlade =$data[0] ; 
                return view('dashboardUpdateA', ['dataBlade' => $dataBlade]);
            }elseif($data->isEmpty()) {
                $data  = DB::table('product_b')->select('*')->where('product_name','=',$check)->get();
                $dataBlade =$data[0] ; 
                return view('dashboardUpdateB', ['dataBlade' => $dataBlade]);
            }else {
                return redirect()->to('dashboard');
            }
        }catch(\Exception $e){
            return view('wrongInput');
        }
        
    }
    public function newA(Request $request){
        
        DB::table('product_a')
            ->where('id', $request->get('id'))
            ->update(
            ['product_name' => $request->get('product_name'),
            // 'product_no' => $request->get('product_no'),
            'describtion'=> $request->get('describtion'),
            'details'=> $request->get('details'),
            'type'=> $request->get('type'),
            'class'=> $request->get('class')]);
            return redirect()->to('dashboard');

    }
    public function newB(Request $request){
        
        DB::table('product_b')
            ->where('id', $request->get('id'))
            ->update(
            ['product_name' => $request->get('product_name'),
            // 'product_no' => $request->get('product_no'),
            'describtion'=> $request->get('describtion'),
            'details'=> $request->get('details'),
            'type'=> $request->get('type')
            ]);
            return redirect()->to('dashboard');

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
