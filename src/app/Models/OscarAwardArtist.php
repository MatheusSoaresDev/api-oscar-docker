<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OscarAwardArtist extends Model
{
    use HasPrimaryKeyUuid;
    protected $fillable = [
        "id",
        "oscar_id",
        "awardartist_id",
    ];
    protected $visible = [
        "id",
        "award",
        "nomineeArtists"
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

    public function nomineeArtists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'nominee_artist', 'oscarawardartist_id', 'artist_id')->withTimestamps();
    }

    /* Aliases */
    public function award(): HasMany
    {
        return $this->awardArtist();
    }
}
