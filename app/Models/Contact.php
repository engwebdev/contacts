<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(related: Company::class);
    }

    public function notes(): MorphToMany
    {
        return $this->morphToMany(related: Note::class, name: 'notetable');
    }

    public function details(): HasMany
    {
        return $this->hasMany(related: Detail::class,
            foreignKey: 'contact_id',
            localKey: 'id');
    }
}
