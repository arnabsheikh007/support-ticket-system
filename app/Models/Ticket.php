<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportEngineer()
    {
        return $this->belongsTo(User::class, 'support_engineer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
