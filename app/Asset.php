<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model {

    protected $fillable = [
        'name',
        'content',
    ];

    public function bucket()
    {
        return $this->belongsTo('App\Bucket');
    }

}
