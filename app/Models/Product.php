<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Drink extends Model {

    use HasFactory, Notifiable;

    public $timestamps = false;

    public function package() {

        return $this->belongsTo( Package::class );
    }

    public function category() {

        return $this->belongsTo( Category::class );
    }
    
    public function brand() {

        return $this->belongsTo( Brand::class );
    }
}
