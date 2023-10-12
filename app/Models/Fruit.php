<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'parent_id', 'unique_id']; 

    public function children()
    {
        return $this->hasMany(Fruit::class, 'parent_id');
    }
}
