<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Host extends Model
{
    use HasFactory, HasPrimaryKeyUuid;

    protected $table = "host";
    protected $fillable = [
        "id",
        "name",
    ];
    protected $visible = [
        //"id",
        "name",
    ];
    public $timestamps = true;
    protected $keyType = 'string';

    public function oscar(): BelongsTo
    {
        return $this->belongsTo(Oscar::class);
    }
}
