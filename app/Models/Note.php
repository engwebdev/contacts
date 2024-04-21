<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'id',
        'note_title',
        'note_description',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function contacts(): MorphToMany
    {
        return $this->morphedByMany(related: Contact::class, name: 'notetable');
    }

    public function companies(): MorphToMany
    {
        return $this->morphedByMany(related: Company::class, name: 'notetable');
    }

}
