<?php

namespace App\Requests\Posts;

use zFramework\Core\Abstracts\Request;

#[\AllowDynamicProperties]
class SaveRequest extends Request
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
            'target'        => ['required'],
            'content'       => ['required']
        ];
    }
}
