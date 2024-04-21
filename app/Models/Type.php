<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'id',
        'title',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(related: Detail::class);
    }

}
