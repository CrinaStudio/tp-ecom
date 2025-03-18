<?php

namespace Src\Shared\Domain;

use PDO;

interface PdoConnection
{
    public function getPdo(): PDO;

}
