<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\jadwal;
use App\Http\Resources\jadwal as jadwalResource;


class JadwalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = jadwal::all();
        return $this->sendResponse(jadwalResource::collection($movie), 'Data ditampilkan');
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
            'id_movies' => 'required',
            'kursi' => 'required',
            'tanggal' => 'required',
            'harga' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $movie = new jadwal();
        $movie->id_movies = $input['id_movies'];
        $movie->kursi = $input['kursi'];
        $movie->tanggal = $input['tanggal'];
        $movie->harga = $input['harga'];
        $movie->save();

        return $this->sendResponse(new jadwalResource($movie), 'Data ditambahkan!');
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
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = jadwal::find($id);
        if(is_null($movie)) {
            return $this->sendError('Data does not exist.');
        }
        return $this->sendResponse(new jadwalResource($movie), 'Data ditampilkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $input = $request->all();

        $movie = jadwal::find($id);
        if(!is_null($movie)) {
            $validator = Validator::make($input, [
                'id_movies' => 'required',
                'kursi' => 'required',
                'tanggal' => 'required',
                'harga' => 'required'
            ]);
    
            if($validator->fails()){
                return $this->sendError($validator->errors());       
            }
    
            $movie->id_movies = $input['id_movies'];
            $movie->kursi = $input['kursi'];
            $movie->tanggal = $input['tanggal'];
            $movie->harga = $input['harga'];
            $movie->save();
        }

        return $this->sendResponse(new jadwalResource($movie), 'Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = jadwal::find($id);
        if(!is_null($movie)) {
            $movie->delete();
        }

        return $this->sendResponse([], 'Data deleted');
    }
}
