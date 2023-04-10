<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OscarAwardMovie extends Model
{
    use HasPrimaryKeyUuid;
    protected $fillable = [
        "id",
        "oscar_id",
        "awardmovie_id",
    ];
    protected $visible = [
        //"id",
        "award",
        "nomineeMovies"
    ];
    public $timestamps = true;
    protected $keyType = 'string';
    protected $table = 'oscar_award_movie';

    public function oscar():BelongsTo
    {
        return $this->belongsTo(Oscar::class);
    }

    public function awardMovie(): HasMany
    {
        return $this->hasMany(AwardMovie::class, 'id', 'awardmovie_id');
    }

    public function nomineeMoviesRelation(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'nominee_movie', 'oscarawardmovie_id', 'movie_id')->withTimestamps();
    }

    public function nomineeMovies(): HasMany
    {
        return $this->hasMany(NomineeMovie::class, 'oscarawardmovie_id', 'id');
    }

    /* Aliases */
    public function award(): HasMany
    {
        return $this->awardMovie();
    }
}
