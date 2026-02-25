<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Reactions extends Model
{
    public $table = "reactions";

    public function beginQuery() 
    {
        // return $this->where();
    }
}
