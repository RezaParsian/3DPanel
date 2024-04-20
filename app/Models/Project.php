<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rp76\LaravelPack\Traits\PipeAble;

/**
 * @method static pipe(string[] $array)
 * @property int $id
 */
class Project extends Model
{
    use HasFactory,PipeAble;

    const
        USER_ID='user_id',
        DESCRIPTION='description',
        TITLE='title';

    protected $fillable=[
        self::USER_ID,
        self::TITLE,
        self::DESCRIPTION,
    ];
}
