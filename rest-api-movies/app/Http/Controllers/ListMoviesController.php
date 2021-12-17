<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\list_movies;
use App\Http\Resources\listmovies as listResource;

class ListMoviesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = list_movies::all();
        return $this->sendResponse(listResource::collection($list), 'Data ditampilkan');
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
            'judul' => 'required',
            'sinopsis' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $list = new list_movies();
        $list->judul = $input['judul'];
        $list->sinopsis = $input['sinopsis'];
        $list->save();

        return $this->sendResponse(new listResource($list), 'Data ditambahkan!');
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
     * @param  \App\Models\list_movies  $list_movies
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = list_movies::find($id);
        if(is_null($list)) {
            return $this->sendError('Data does not exist.');
        }
        return $this->sendResponse(new listResource($list), 'Data Ditampilkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\list_movies  $list_movies
     * @return \Illuminate\Http\Response
     */
    public function edit(list_movies $list_movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\list_movies  $list_movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $list = list_movies::find($id);
        if(!is_null($list)) {
            $validator = Validator::make($input, [
                'judul' => 'required',
                'sinopsis' => 'required'
            ]);
    
            if($validator->fails()){
                return $this->sendError($validator->errors());       
            }
    
            $list->judul = $input['judul'];
            $list->sinopsis = $input['sinopsis'];
            $list->save();
        }

        return $this->sendResponse(new listResource($list), 'Data diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\list_movies  $list_movies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = list_movies::find($id);
        if(!is_null($list)) {
            $list->delete();
        }

        return $this->sendResponse([], 'Data deleted');
    }
}
