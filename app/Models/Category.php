<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'categories';

    public function events()
    {
        return $this->hasMany(Event::class, 'kategori', 'name');
    }
}
