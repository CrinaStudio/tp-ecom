<?php

namespace Src\Shared\Infrastructure\Models;

use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Src\Shared\Infrastructure\Scope\NotSoftDeleteScope;

#[ScopedBy([NotSoftDeleteScope::class])]
class BaseModel extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $guarded = [];

    protected $keyType = 'string';
}
