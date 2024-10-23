<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'champions', 'voter_id'];

    protected $casts = [
        'champions' => 'array',
    ];

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }
}
