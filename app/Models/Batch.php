<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'flag'];

   

    // Relationship with sub-batches
    public function subBatches()
    {
        return $this->hasMany(SubBatch::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'batch_user', 'batch_ids', 'user_id')->wherePivot('role');;
    }
}
