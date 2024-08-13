<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'visited_at'];

    // Specify the date attributes to be treated as Carbon instances
    protected $dates = ['visited_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
