<?php

namespace App\Requests\Reactions;

use zFramework\Core\Abstracts\Request;

#[\AllowDynamicProperties]
class ToggleRequest extends Request
{

    public function __construct()
    {
        $this->authorize      = true;
        $this->htmlencode     = false;
        $this->attributeNames = [];
    }

    public function columns(): array
    {
        return [
            'target' => ['required'],
            'type'   => ['required']
        ];
    }
}
