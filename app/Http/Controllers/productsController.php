<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Jobs\processProduct;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class productsController extends Controller
{
    public $size = 10;
    public $offset = 0;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $this->size = ($req->input('size') != "") ? $req->input('size') : $this->size;
        $this->offset = ($req->input('offset') != "") ? $req->input('offset') : $this->offset;

        $resProduct = Product::WithGroups();
        $filters = $req->input("filters");

        if(!empty($filters)) 
            $resProduct->where($filters);
        
        return [
            'total'     => $resProduct->count(),
            'perpage'   => $this->size,
            'items'     => $resProduct
            ->offset($this->offset)
            ->take($this->size)
            ->get()
        ]; 
       
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
    public function store(Request $request)
    {
        //
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
    }
}
