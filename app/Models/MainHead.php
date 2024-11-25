<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainHead extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['unique_id', 'name', 'email', 'password'];
    
    protected $table = 'main_heads';

      // Relationship with batches
      public function batches()
      {
          return $this->hasMany(Batch::class, 'created_by_main_head_id');
      }
  
      // Relationship with sub-batches
      public function subBatches()
      {
          return $this->hasMany(SubBatch::class, 'created_by_main_head_id');
      }
}
