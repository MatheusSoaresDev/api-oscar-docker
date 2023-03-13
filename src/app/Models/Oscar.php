<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oscar extends Model
{
    use HasFactory, HasPrimaryKeyUuid;

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
        "awards"
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
}
