<?php

namespace App\Models;

use App\Helpers\CommonHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'brand', 'image', 'price', 'details', 'category_id'];
    protected $table = 'products';

    protected $appends = ['image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected $upload_distination = '/uploads/images/products/';
    protected $getImageDest = 'app/public/uploads/images/products/';

    public function setImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['image'] = $value;
            return;
        }
        $image_name = CommonHelper::quickRandom();
        $image_name = $image_name . '.' . $value->getClientOriginalExtension();
        $value->move(public_path($this->upload_distination), $image_name);
        $this->attributes['image'] = $image_name;
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return strpos($this->image, 'http') !== false ? $this->image : asset($this->getImageDest . $this->image);
    }
}
