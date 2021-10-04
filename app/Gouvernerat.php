<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Gouvernerat extends Model
{
    protected $fillable = ['nomGouvernerat'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
