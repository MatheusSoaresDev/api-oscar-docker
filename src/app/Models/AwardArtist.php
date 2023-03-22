<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardArtist extends Model
{
    use HasPrimaryKeyUuid, SoftDeletes;

    protected $table = "award_artist";
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
        return $this->belongsToMany(AwardArtist::class, 'oscar_award_artist', 'oscar_id', 'awardartist_id')->withTimestamps();
    }
}
