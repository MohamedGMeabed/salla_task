<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasFactory;

    protected $fillable = ['id','sku','price','name','description','main_image','status','quantity'];


    public function setMainImageAttribute($image)
    {
        if($image && $this->main_image)
        {
            // @unlink(public_path($this->image));
        }
        if(is_object($image))
        {
            $this->attributes['main_image'] =  @$this->uploadImage($image,'uploads/images') ;
        }
        else
        {
            $this->attributes['main_image'] =  $image;
        }
    }

    public function uploadImage($image , $folder)
    {
        $image_name =  time() .'.'. $image->getClientOriginalExtension();
        $destination = $folder;
        $image->move(public_path($destination),$image_name);
        return  asset('uploads/images/'.$image_name) ;
    }

   
  
}