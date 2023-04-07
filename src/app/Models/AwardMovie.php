<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AwardMovie extends Model
{
    use HasPrimaryKeyUuid, SoftDeletes;

    protected $table = "award_movie";
    protected $fillable = [
        "id",
        "name",
    ];
    protected $visible = [
        "id",
        "name",
    ];
    public $timestamps = true;
    protected $keyType = 'string';

    public function oscar(): BelongsToMany
    {
        return $this->belongsToMany(AwardArtist::class, 'oscar_award_movie', 'oscar_id', 'awardmovie_id')->withTimestamps();
    }
}
