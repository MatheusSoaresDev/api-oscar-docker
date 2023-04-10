<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NomineeMovie extends Model
{
    use HasPrimaryKeyUuid;

    protected $fillable = [
        "id",
        "oscarawardmovie_id",
        "winner",
    ];
    protected $visible = [
        //"id",
        "movie",
        "winner"
    ];
    protected $casts = [
        'winner' => 'boolean',
    ];
    public $timestamps = true;
    protected $keyType = 'string';
    protected $table = 'nominee_movie';

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }
}
