<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NomineeArtist extends Model
{
    use HasPrimaryKeyUuid;
    protected $fillable = [
        "id",
        "oscarawardartist_id",
        "winner",
    ];
    protected $visible = [
        "id",
        "artist",
        "movie",
        "winner"
    ];
    protected $casts = [
        'winner' => 'boolean',
    ];
    public $timestamps = true;
    protected $keyType = 'string';
    protected $table = 'nominee_artist';

    public function artist(): HasOne
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }
}
