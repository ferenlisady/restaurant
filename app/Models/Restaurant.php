<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";

    protected $fillable = ['name', 'description', 'address', 'image'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}