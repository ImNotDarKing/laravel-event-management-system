<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role'];
    protected $hidden   = ['password','remember_token'];

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
