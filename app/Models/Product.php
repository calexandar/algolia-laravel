<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
}
