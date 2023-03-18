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
        "award"
    ];
    public $timestamps = true;
    protected $keyType = 'string';
    protected $table = 'oscar_award_artist';

    public function oscar():BelongsTo
    {
        return $this->belongsTo(Oscar::class);
    }

    public function awardArtist(): HasMany
    {
        return $this->hasMany(AwardArtist::class, 'id', 'awardartist_id');
    }

    /* Aliases */
    public function award(): HasMany
    {
        return $this->awardArtist();
    }
}
