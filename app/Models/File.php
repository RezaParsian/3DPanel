<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rp76\LaravelPack\Traits\PipeAble;

/**
 * @method static where(...$args)
 * @method static create(mixed $validated)
 */
class File extends Model
{
    use HasFactory, PipeAble;

    const
        PROJECT_ID = 'project_id',
        TITLE = 'title',
        PATH = 'path',
        DATA = 'data';

    protected $fillable = [
        self::PROJECT_ID,
        self::TITLE,
        self::PATH,
        self::DATA,
    ];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
