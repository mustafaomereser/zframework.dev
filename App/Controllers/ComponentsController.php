<?php

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\Topics;
use zFramework\Core\Abstracts\Controller;
use zFramework\Core\Facades\Lang;

#[\AllowDynamicProperties]
class ComponentsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function categories()
    {
        $items = (new Categories)->where('lang', Lang::currentLocale())->get();
        return view('app.components.categories', compact('items'));
    }

    public function topics()
    {
        $items = (new Topics)->where('lang', Lang::currentLocale());
        if (request('last')) $items->orderBy(['id' => 'DESC']);
        $items = $items->get();

        return view('app.components.topics', compact('items'));
    }
}
