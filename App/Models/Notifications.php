<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Notifications extends Model
{
    public $table = "notifications";

    public function beginQuery() 
    {
        // return $this->where();
    }
}
