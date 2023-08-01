<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, HasUuids;

    
    protected $fillable=[
        'travel_id',
        'name',
        'starting_date',
        'ending_date',
        'price',
        
    ];

      // Accessor for the 'price' attribute
      public function getPriceAttribute($value)
      {
          return $value / 100;
      }
  
      // Mutator for the 'price' attribute
      public function setPriceAttribute($value)
      {
          $this->attributes['price'] = $value * 100;
      }
   
    
}
