<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KomunitasModel extends Model
{
    protected $table = 'komunitas';
    protected $guarded = [];

    public function comments() : HasMany
    {
        return $this->hasMany(KomentarModel::class, 'komunitas_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'member_komunitas', 'komunitas_id', 'user_id');
    }
}
