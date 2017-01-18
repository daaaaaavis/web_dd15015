<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
// use Image; // Alias to Intervention 
// use App\images\Photo as Photo;
use App\images\app\Photo as Photo;

class ImageController extends BaseController{
  public function getIndex()
  {
    //Loads the form
    return view('tpl.index');
  }


  public function postIndex() // posting 
	{
  $validation = \Validator::make(Input::all(),Photo::$upload_rules);

  if($validation->fails()) {
    return Redirect::to('/')->withInput()->withErrors($validation);
  }
  else {
    
    //Upload the image to thedatabase and process it
    $image = Input::file('image');

    $filename = $image->getClientOriginalName();
    $filename = pathinfo($filename, PATHINFO_FILENAME);

    //Salting filename / url friendly
    $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();

    $destinationPath =public_path(). '/upload/' .Input::get('folder');
    $upload = $image->move($destinationPath,$fullname);
    }
    
  
    if($upload) {

      $insert_id = \DB::table('photos')->insertGetId(
        array(
          'title' => Input::get('title'),
          'image' => $fullname
        )
      );

      //Redirect
      return Redirect::to(\URL::to('snatch/'.$insert_id))->with('success','Your image is uploaded successfully!');
    } else {
      //image cannot be uploaded
      return Redirect::to('/images')->withInput()->with('error','Sorry, the image could not be uploaded, please try again later');
    // }
  }
}

// finds the image in database
public function getSnatch($id) {
  $image = Photo::findOrFail($id);
  if($image) {
    return View::make('tpl.permalink')->with('image',$image);
  } else {
    return Redirect::to('/')->with('error','Image not found');
  }
}

public function getAll(){

  $all_images = \DB::table('photos')->orderBy('id','desc')->paginate(6);
  return \View::make('tpl.all_images')->with('images',$all_images);
}

public function getDelete($id) {

  $image = Photo::find($id);


  if($image) {
  	 File::delete(Config::get('image.upload_folder').'/'.$image->image);
	   File::delete(Config::get('image.thumb_folder').'/'.$image->image);
	return Redirect::to('/')->with('success','Image deleted successfully'); 
  } else { 
	 	return Redirect::to('/')->with('error','No image with given ID found'); } }
    //First, let's delete the images from FTP

}
