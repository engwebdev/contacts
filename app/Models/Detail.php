<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'details';

    protected $fillable = [
        'id',
        'contact_id',
        'type_id',
        'type_title',
        'detail_value',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function contacts(): BelongsTo
    {
        return $this->belongsTo(related: Contact::class,
            foreignKey: 'contact_id',
            ownerKey: 'id');
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(related: Type::class);
    }

}
