<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasPrimaryKeyUuid;

    protected $fillable = [
        "name",
        "runtime",
        "release",
        "language",
        "country",
        "company",
        "wikipedia"
    ];
    protected $visible = [
        "id",
        "name",
        "runtime",
        "release",
        "language",
        "country",
        "company",
        "wikipedia"
    ];
    protected $table = "movie";
    public $timestamps = true;
    protected $keyType = 'string';
}
