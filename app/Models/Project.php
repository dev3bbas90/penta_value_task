<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'account_id',
    ];
    /**
     * Get the job that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'project_id');
    }
}
