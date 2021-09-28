<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $item = Item::where('item_id',$request->itemId)->firstOrFail();
            $statusCode = 200;
        } catch (ModelNotFoundException $e) {
            $item=Item::create([
                'item_id'=>$request->itemId,
                'title'=>$request->itemTitle,
                'url'=>$request->itemUrl
            ]);
            $statusCode = 201;
        }

        $result= $item->users()->toggle($request->userId);

        if (array_key_exists( '0', $result['detached'])){
            $additionalData = [
                'toggle'=>'Quitado de favoritos'
            ];
        }elseif (array_key_exists( '0', $result['attached'])){
            $additionalData = [
                'toggle'=>'Agregado a favoritos'
            ];
        }

        return (new ItemResource($item))
            ->additional($additionalData)
            ->response()
            ->setStatusCode($statusCode);
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
