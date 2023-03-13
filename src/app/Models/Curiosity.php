<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curiosity extends Model
{
    use HasFactory, HasPrimaryKeyUuid;

    protected $table = "curiosity";
    protected $fillable = [
        "id",
        "content",
    ];
    protected $visible = [
        "content",
    ];
    public $timestamps = true;
    protected $keyType = 'string';

    public function oscar(): BelongsTo
    {
        return $this->belongsTo(Oscar::class);
    }
}
