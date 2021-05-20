<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //1 option: choose what you can change on mass assign
    //protected $fillable = ['title', 'excerpt', 'body'];

    //2 option: permission to change all except:
    protected $guarded = ['id'];

    //3 option: forbid mass assignment:
    //protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
