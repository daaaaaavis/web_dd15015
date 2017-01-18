<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

  //the variable that sets the table name
  protected $table = 'photos';

  //the variable that sets which columns can be edited
  protected $fillable = array('title','image');

  //The variable which enables or disables the Laravel's timestamps option. Default is true. We're leaving this hereanyways
  public $timestamps = true;

  public static $upload_rules = array(
  'title'=> 'required|min:3',
  'image'=> 'required|image'
	);

}