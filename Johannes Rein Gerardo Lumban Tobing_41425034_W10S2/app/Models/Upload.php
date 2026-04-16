<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     * The atrributes that are mass assihnable
     * 
     * @var array<int, string>
     */
    protected $fillable = ['nama', 'gambar'];
}
