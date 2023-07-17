<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'text',
        'likes',
        'deslikes',
        'edited',
    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
