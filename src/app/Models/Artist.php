<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    use HasPrimaryKeyUuid;

    protected $table = "artist";
    protected $fillable = [
        "id",
        "name",
        "birth",
        "birthplace",
        "country",
        "wikipedia",
    ];
    public $timestamps = true;
    protected $visible = [
        "id",
        "name",
        "birth",
        "birthplace",
        "country",
        "wikipedia",
    ];

    public function nomineeArtistsRelation(): BelongsToMany
    {
        return $this->belongsToMany(AwardArtist::class, 'oscar_award_artist', 'oscarawardartist_id', 'artist_id')->withTimestamps();
    }
}
