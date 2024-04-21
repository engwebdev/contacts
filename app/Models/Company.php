<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'id',
        'title',
        'description',
        'address',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(related: Contact::class);
    }

    public function notes(): MorphToMany
    {
        return $this->morphToMany(related: Note::class, name: 'notetable');
    }
}
