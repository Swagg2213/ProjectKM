<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EventReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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
        'status'
    ];
    
    protected $table= 'events';
    protected $guarded =['id'];
    protected $casts = [
        'date' => 'datetime',
    ];

        public function getDynamicStatusAttribute()
        {
                if ($this->status === 'pending') {
                        return 'Pending';
                }

                if ($this->status === 'rejected') {
                        return 'Rejected';
                }

                if ($this->status === 'approved') {
                        $start = $this->date->copy()->setTimeFromTimeString($this->startTime);
                        $end = $this->date->copy()->setTimeFromTimeString($this->endTime);
                        $now = Carbon::now();

                        if ($now->lt($start)) {
                        return 'Approved';
                        } elseif ($now->between($start, $end, true)) {
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

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id');
    }

    public function getIsFavoritedAttribute()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        $now = Carbon::now();

        return $query->where(function ($dateQuery) use ($now) {
            $dateQuery->where('date', '>', $now->toDateString())

                ->orWhere(function ($timeQuery) use ($now) {
                    $timeQuery->where('date', $now->toDateString())
                              ->where('startTime', '>', $now->toTimeString());
                });
        });
    }
}