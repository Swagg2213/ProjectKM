<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
protected $fillable = [
        'id',
        'title',
        'kategori',
        'image',
        'link',
        'date',
        'startTime',
        'endTime',
        'lokasi',
        'detail',
        ];
    
        protected $table= 'events';
        protected $guarded =['id'];

}
