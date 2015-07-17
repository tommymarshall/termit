<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model {

    protected $fillable = [
        'hash',
        'password',
    ];

    public function assets()
    {
        return $this->hasMany('App\Asset');
    }

    public function scopeGenerate()
    {
        return $this->create([
            'hash'     => str_random(6),
            'password' => str_random(6),
        ]);
    }

    public function getHashPathAttribute()
    {
        return url($this->attributes['hash']);
    }

    public function getAdminPathAttribute()
    {
        return url($this->attributes['hash'].'/'.$this->attributes['password']);
    }

}
