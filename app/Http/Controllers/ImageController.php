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
use App;

class ImageController extends BaseController{
  public function getIndex()
  {
    //Loads the form
    return view('tpl.index');
  }


  public function postIndex() // posting 
	{

    /*
  $validation = \Validator::make(Input::all(),Photo::$upload_rules);

  if($validation->fails()) {
    return Redirect::to('/')->withInput()->withErrors($validation);
  }
  else {
    */
    //Upload the image to thedatabase and process it
    $image = Input::file('image');

    //This is the original uploaded client name of theimage
    $filename = $image->getClientOriginalName();
    //Because Symfony API does not provide filename//without extension, we will be using raw PHP here
    $filename = pathinfo($filename, PATHINFO_FILENAME);

    //We should salt and make an url-friendly version of//the filename
    //(In ideal application, you should check the filename//to be unique)
    $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();

    //We upload the image first to the upload folder, thenget make a thumbnail from the uploaded image

    $destinationPath =public_path(). '/upload/' .Input::get('folder');
    $upload = $image->move($destinationPath,$fullname);

    
    
    //Our model that we've created is named Photo, thislibrary has an alias named Image, don't mix them two!
    //These parameters are related to the image processingclass that we've included, not really related toLaravel
    

    
    //If the file is now uploaded, we show an error messageto the user, else we add a new column to the databaseand show the success message
    if($upload) {

      //image is now uploaded, we first need to add columnto the database
      $insert_id = \DB::table('photos')->insertGetId(
        array(
          'title' => Input::get('title'),
          'image' => $fullname
        )
      );

      //Now we redirect to the image's permalink
      return Redirect::to(\URL::to('snatch/'.$insert_id))->with('success','Your image is uploaded successfully!');
    } else {
      //image cannot be uploaded
      return Redirect::to('/images')->withInput()->with('error','Sorry, the image could not be uploaded, please try again later');
    // }
  }
}

public function getSnatch($id) {
  //Let's try to find the image from database first
  $image = App\images\Photo::find($id);
  //If found, we load the view and pass the image info asparameter, else we redirect to main page with errormessage
  if($image) {
    return View::make('tpl.permalink')->with('image',$image);
  } else {
    return Redirect::to('/')->with('error','Image not found');
  }
}

public function getAll(){

  //Let's first take all images with a pagination feature
  $all_images = \DB::table('photos')->orderBy('id','desc')->paginate(6);

  //Then let's load the view with found data and pass thevariable to the view
  return \View::make('tpl.all_images')->with('images',$all_images);
}

public function getDelete($id) {
  //Let's first find the image
  $image = Photo::find($id);

  //If there's an image, we will continue to the deletingprocess
  if($image) {
  	File::delete(Config::get('image.upload_folder').'/'.$image->image);
	File::delete(Config::get('image.thumb_folder').'/'.$image->image);
	//Now let's delete the value from database $image->delete(); 
	//Let's return to the main page with a success message 
	return Redirect::to('/')->with('success','Image deleted successfully'); } else { //Image not found, so we will redirect to the indexpage with an error message flash data.
	 	return Redirect::to('/')->with('error','No image with given ID found'); } }
    //First, let's delete the images from FTP
}