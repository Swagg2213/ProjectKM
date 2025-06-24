<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
        protected $fillable = [
                'id',
                'user_id',
                'title',
                'kategori',
                'image',
                'link',
                'date',
                'startTime',
                'endTime',
                'lokasi',
                'detail',
                'isFavorite',
                'status'
        ];
        
        protected $table= 'events';
        protected $guarded =['id'];

        
        public function getDynamicStatusAttribute()
        {
        if ($this->status === 'pending') {
                return 'Pending';
        }

        if ($this->status === 'rejected') {
                return 'Rejected';
        }

        if ($this->status === 'approved') {
                $start = Carbon::parse($this->date . ' ' . $this->startTime);
                $end = Carbon::parse($this->date . ' ' . $this->endTime);
                $now = Carbon::now();

                if ($now->lt($start)) {
                return 'Approved';
                } elseif ($now->between($start, $end)) {
                return 'On going';
                } else {
                return 'Completed';
                }
        }

        return 'Unknown';
        }

        public function user()
        {
                return $this->belongsTo(User::class, 'user_id');
        }

        public function eventReviews()
        {
                return $this->hasMany(EventReview::class, 'event_id');
        }
}
