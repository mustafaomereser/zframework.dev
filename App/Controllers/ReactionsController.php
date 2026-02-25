<?php

namespace App\Controllers;

use App\Models\Reactions;
use App\Requests\Reactions\ToggleRequest;
use zFramework\Core\Abstracts\Controller;
use zFramework\Core\Facades\Auth;
use zFramework\Core\Facades\Response;

#[\AllowDynamicProperties]
class ReactionsController extends Controller
{
    public function __construct()
    {
        $this->reactions = new Reactions;
    }

    public function toggle(ToggleRequest $request)
    {
        $request = $request->validated();
        $exists  = $this->reactions->select('id')->where('target', $request['target'])->where('user_id', Auth::id())->where('type', $request['type'])->first();
        if (isset($exists['id'])) $exists['delete']();
        else $this->reactions->insert($request + ['user_id' => Auth::id()]);
        return Response::json(['status' => isset($exists['id']) ? 2 : 1]); // , 'count' => $this->reactions->where('target', $request['target'])->where('type', $request['type'])->count()
    }
}
