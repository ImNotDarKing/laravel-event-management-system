<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id','title','short_description','description',
        'location','starts_at','paid','status','image'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isGoing(User $user): bool
    {
        return $this->attendances()
                    ->where('user_id', $user->id)
                    ->where('going', true)
                    ->exists();
    }

}