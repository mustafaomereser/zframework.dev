<?php

namespace App\Requests\Topic;

use App\Models\Categories;
use zFramework\Core\Abstracts\Request;

#[\AllowDynamicProperties]
class StoreRequest extends Request
{

    public function __construct()
    {
        $this->authorize      = true;
        $this->htmlencode     = true;
        $this->attributeNames = [];
    }

    public function columns(): array
    {
        return [
            'title'    => ['required'],
            'category' => ['required', 'exists:' . Categories::class . ';key:slug'],
            'tags'     => ['nullable']
        ];
    }
}
