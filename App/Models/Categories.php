<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;

#[\AllowDynamicProperties]
class Categories extends Model
{
    public $table = "categories";

    public function topics(array $data)
    {
        return $this->findRelation(Topics::class, $data['slug'], 'category');
    }

    public function posts(array $data)
    {
        $topics = array_column($this->topics($data)->select('id')->get(), 'id');
        if (!count($topics)) return false;
        return (new Posts)->whereIn('target', array_map(fn($target) => "topic-$target", $topics));
    }
}
