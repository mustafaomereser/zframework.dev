<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Posts extends Model
{
    public $table = "posts";

    public function author(array $data)
    {
        return $this->hasOne(User::class, $data['user_id'], 'id');
    }
}
