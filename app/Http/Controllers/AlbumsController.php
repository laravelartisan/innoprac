<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;
use Input;


class AlbumsController extends Controller
{
    public function getList()
    {
        $albums = Album::with('Photos')->get();
        return view('index')
            ->with('albums',$albums);
    }
    public function getAlbum($id)
    {
        $allAlbum = new Album();
        $allAlbum=$allAlbum->all();
        $album = Album::with('Photos')->find($id);

//        dd($album);
//        return $album;
        return view('album',compact('album','allAlbum'));

    }
    public function getForm()
    {
        return view('createalbum');
    }
    public function postCreate()
    {
        $rules = array(

            'name' => 'required',
            'cover_image'=>'required|image'

        );

        $validator = \Validator::make(Input::all(), $rules);
        if($validator->fails()){

            return redirect()->route('create_album_form')
                ->withErrors($validator)
                ->withInput();
        }

        $file = Input::file('cover_image');
        $random_name = str_random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = Input::file('cover_image')
            ->move($destinationPath, $filename);

        $album = Album::create(array(
            'name' => Input::get('name'),
            'description' => Input::get('description'),
            'cover_image' => $filename,
        ));

        return redirect()->route('show_album',array('id'=>$album->id));
    }

    public function getDelete($id)
    {
        $album = Album::find($id)->first();
        $album->delete();

        return redirect()->route('index');
    }
}
