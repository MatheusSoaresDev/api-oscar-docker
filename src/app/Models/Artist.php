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

    const NOMINEE_WINNER_MESSAGE = [
        "winner" => "This artist is already winner in this award.",
        "noWinner" => "This artist is not winner in this award."
    ];

    public function nomineeArtistsRelation(): BelongsToMany
    {
        return $this->belongsToMany(AwardArtist::class, 'oscar_award_artist', 'oscarawardartist_id', 'artist_id')->withTimestamps();
    }
}
