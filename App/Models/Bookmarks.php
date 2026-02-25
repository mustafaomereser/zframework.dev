<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Bookmarks extends Model
{
    public $table = "bookmarks";

    public function beginQuery() 
    {
        // return $this->where();
    }
}
