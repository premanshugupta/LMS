<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBatch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'flag','batch_id'];

    // Relationship with Batch
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    // Relationship with MainHead
    public function mainHead()
    {
        return $this->belongsTo(MainHead::class, 'created_by_main_head_id');
    }

        public function user()
    {
        return $this->belongsToMany(User::class, 'sub_batch_user', 'sub_batch_id', 'user_id');
    }
 
}
