<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OscarAwardArtist extends Model
{
    use HasFactory, HasPrimaryKeyUuid;
    protected $fillable = [
        "id",
        "oscar_id",
        "awardartist_id",
    ];
    protected $visible = [
        "id",
        //"oscar_id",
        //"awardartist_id",
        "awardArtist"
    ];
    public $timestamps = true;
    protected $keyType = 'string';

    public function oscar():BelongsTo
    {
        return $this->belongsTo(Oscar::class);
    }

    /* Voltar nessa parte de relacao n pra n */

    public function awardArtist(): HasMany
    {
        return $this->hasMany(AwardArtist::class, 'id', 'awardartist_id');
    }

    /* --------------------------- */
}
