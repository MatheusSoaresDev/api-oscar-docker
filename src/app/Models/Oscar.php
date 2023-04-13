<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oscar extends Model
{
    use HasPrimaryKeyUuid;

    protected $table = "oscar";
    protected $fillable = [
        "id",
        "edition",
        "local",
        "date",
        "city",
        "year",
    ];
    protected $visible = [
        "id",
        "edition",
        "local",
        "date",
        "city",
        "hosts",
        "curiosities",
        "awardArtists",
        "awardMovies"
    ];
    public $timestamps = true;
    protected $keyType = 'string';

    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }

    public function curiosities(): HasMany
    {
        return $this->hasMany(Curiosity::class);
    }

    public function awardArtistsRelation(): BelongsToMany
    {
        return $this->belongsToMany(AwardArtist::class, 'oscar_award_artist', 'oscar_id', 'awardartist_id')->withTimestamps();
    }

    public function awardMoviesRelation(): BelongsToMany
    {
        return $this->belongsToMany(AwardMovie::class, 'oscar_award_movie', 'oscar_id', 'awardmovie_id')->withTimestamps();
    }

    public function awardArtists(): HasMany
    {
        return $this->hasMany(OscarAwardArtist::class);
    }

    public function awardMovies(): HasMany
    {
        return $this->hasMany(OscarAwardMovie::class);
    }
}
