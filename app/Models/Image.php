<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image as ImageLib;

class Image extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at'];

    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function generateImageNameFromPhoto($imageFile)
    {
        return $this->id.".".$imageFile->getClientOriginalExtension();
    }

    public function generateImageUrl($imageFile)
    {
        return "/storage/images/".$this->generateImageNameFromPhoto($imageFile);
    }

    public static function ImagePath($image_name=null)
    {
        if ($image_name==null) {
            return storage_path("app/public/images");
        } else {
            return storage_path("app/public/images").'/'.$image_name;
        }
    }

     public static function createX($imageFile, $size, $imageable_object = null)
     {
         if ($imageFile==null) {
             return false;
         }

         $createParams =  [
             'imageable_id'=>$imageable_object ==null ? null : $imageable_object->id,
             'imageable_type'=>$imageable_object ==null ? null : get_class($imageable_object)
            ];

         $image = Image::create($createParams);

         //save and resize image
         Image::resizeAndSavePhoto($image, $imageFile, $size);

         $image->url = $image->generateImageUrl($imageFile);
         $image->save();

         return $image;
     }


     public function updateX($imageFile, $size)
     {
         if ($imageFile==null) {
             return false;
         }

        //  $image_name = $this->generateImageNameFromPhoto($imageFile);

         //save and resize image
         Image::resizeAndSavePhoto($this, $imageFile, $size);

         $this->url = $this->generateImageUrl($imageFile);
         $this->save();

         return $this;
     }


     public static function resizeAndSavePhoto(Image $image, $imageFile, $size)
     {
         $image_name = $image->generateImageNameFromPhoto($imageFile);
         $img = ImageLib::make($imageFile->getRealPath());
         $img->resize(null, 1024, function ($constraint) {
             $constraint->aspectRatio();
         })->save(Image::ImagePath($image_name));
     }
}
