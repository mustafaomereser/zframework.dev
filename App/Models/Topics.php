<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Topics extends Model
{
    public $table = "topics";

    public function category(array $data)
    {
        return $this->hasOne(Categories::class, $data['category'], 'slug');
    }

    public function posts(array $data)
    {
        return $this->findRelation(Posts::class, "topic-" . $data['id'], 'target');
    }

    public function views(array $data)
    {
        return $this->findRelation(Posts::class, "topic-" . $data['id'], 'target');
    }

    public function author(array $data)
    {
        return $this->hasOne(User::class, $data['author'], 'id');
    }
}
