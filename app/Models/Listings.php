<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filters){
        //If this is not false, proceed.
        if($filters['tag'] ?? false){
            //this will only return rows whose tag column/cell matches the  value in request('tag');
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if($filters['search'] ?? false){
            //this will only return rows whose title column/cell matches the  value in request('search');
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }

    //relationship to user
    //this means that a listing/listing model belongs to a user
    public function user(){
        return $this->belongsTo(User::class, 'user_id'); //specify model class and the primary key used.
    }
}
