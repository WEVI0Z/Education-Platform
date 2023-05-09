<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "document_id"
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function document() {
        return $this->belongsTo(Document::class);
    }
}
