<?php

namespace App\Helpers;

use App\Models\Reactions as ModelsReactions;
use zFramework\Core\Facades\Auth;

class Reactions
{
    public static function isReacted($target, $type)
    {
        if (!Auth::check()) return false;
        return isset((new ModelsReactions)->select('id')->where('user_id', Auth::id())->where('target', $target)->where('type', $type)->first()['id']) ? true : false;
    }

    public static function total($target)
    {
        $list = [];
        foreach ((new ModelsReactions)->select('COUNT(id) as count, type')->where('target', $target)->groupBy(['type'])->get() as $react) @$list[$react['type']] += $react['count'];
        return $list;
    }
}
