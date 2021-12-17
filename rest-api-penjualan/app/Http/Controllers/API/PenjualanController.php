<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\penjualan;
use App\Http\Resources\penjualan as penjualanResource;



class PenjualanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sold = penjualan::all();
        return $this->sendResponse(penjualanResource::collection($sold), 'Data ditampilkan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id_jadwal'=>'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $sold = new penjualan();
        $sold->id_user = $input['id_user'];
        $sold->id_jadwal = $input['id_jadwal'];
        $sold->save();
        return $this->sendResponse(new penjualanResource($sold), 'Data ditambahkan!');
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
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sold = penjualan::find($id);
        if(is_null($sold)) {
            return $this->sendError('Data does not exist.');
        }
        return $this->sendResponse(new penjualanResource($sold), 'Data ditampilkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $sold = penjualan::find($id);
        if(!is_null($sold)) {
            $validator = Validator::make($input, [
                'id_jadwal' => 'required',
                'id_user' => 'required'
            ]);
    
            if($validator->fails()){
                return $this->sendError($validator->errors());       
            }
    
            $sold->id_user = $input['id_user'];
            $sold->id_jadwal = $input['id_jadwal'];
            $sold->save();
        }

        return $this->sendResponse(new penjualanResource($sold), 'Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    //public function delete($id)
    //{
    //    //$sold = penjualan::find($id);
    //    //$sold->delete();

    //    //return "Data Terhapus";
    //}

    public function destroy($id) {
        $sold = penjualan::find($id);
        if(!is_null($sold)) {
            $sold->delete();
        }
        return $this->sendResponse([], 'Data deleted');
    }
}
