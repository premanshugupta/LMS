<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'assigned_batch_ids',
        'assigned_sub_batch_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'assigned_batch_ids' => 'array',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_user', 'user_id', 'batch_ids');
    }
    public function subBatches()
    {
        return $this->belongsToMany(SubBatch::class, 'batch_user', 'user_id', 'sub_batches_ids')
            ->withPivot('batch_ids')
            ->withTimestamps();
    }


    //       public function getAllBatches()
    // {
    //     return $this->belongsToMany(Batch::class, 'batch_user', 'user_id', 'batch_ids')
    //                 ->withPivot('role', 'batch_ids');
    // }

    // public function getAllSubBatches()
    // {
    //     return $this->belongsToMany(SubBatch::class, 'batch_user', 'user_id', 'sub_batches_ids')
    //                 ->withPivot('role', 'sub_batches_ids');
    // }

    //     public function getBatchIdsAttribute()
    // {
    //     return $this->pivot && isset($this->pivot->batch_ids) 
    //         ? json_decode($this->pivot->batch_ids, true) 
    //         : [];
    // }
    // public function getSubBatchIdsAttribute()
    // {
    //     return $this->pivot && isset($this->pivot->sub_batch_ids) 
    //     ? json_decode($this->pivot->sub_batch_ids, true) 
    //     : [];
    //     // return json_decode($this->pivot->sub_batch_ids, true) ?? [];
    // }
}
