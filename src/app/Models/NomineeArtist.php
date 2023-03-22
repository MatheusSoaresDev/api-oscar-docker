<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomineeArtist extends Model
{
    use HasPrimaryKeyUuid;
    protected $fillable = [
        "id",
        "oscarawardartist_id",
    ];
    protected $visible = [
        "id",
        "oscarawardartist_id",
    ];
    public $timestamps = true;
    protected $keyType = 'string';
    protected $table = 'nominee_artist';
}
