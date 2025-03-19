<?php

namespace Src\Shared\Infrastructure\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NotSoftDeleteScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
         $builder->whereNull('deleted_at');
    }
}
