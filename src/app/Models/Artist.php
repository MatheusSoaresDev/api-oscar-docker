<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Model;

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
}
