<?php

namespace Src\Shared\Infrastructure\Lib;

use Illuminate\Support\Facades\DB;
use PDO;
use Src\Shared\Domain\PdoConnection;

class EloquentPdoConnection implements PdoConnection
{
    public function getPdo(): PDO
    {
        return DB::connection('mysql')->getPdo();
    }
}
