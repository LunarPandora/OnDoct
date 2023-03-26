<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['email', 'password', 'status'];
    protected $hidden = ['password'];
    protected $guarded = ['id'];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
