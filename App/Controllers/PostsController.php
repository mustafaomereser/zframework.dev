<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Requests\Posts\SaveRequest;
use zFramework\Core\Abstracts\Controller;
use zFramework\Core\Facades\Auth;
use zFramework\Core\Facades\Response;

#[\AllowDynamicProperties]
class PostsController extends Controller
{

    public function __construct()
    {
        $this->posts = new Posts;
    }

    /** Index page | GET: /
     * @return mixed
     */
    public function index()
    {
        abort(404);
    }

    /** Show page | GET: /id
     * @param integer $id
     * @return mixed
     */
    public function show($id)
    {
        abort(404);
    }

    /** Create page | GET: /create
     * @return mixed
     */
    public function create()
    {
        abort(404);
    }

    /** Edit page | GET: /id/edit
     * @param integer $id
     * @return mixed
     */
    public function edit($id)
    {
        abort(404);
    }

    /** POST page | POST: /
     * @return mixed
     */
    public function store(SaveRequest $request)
    {
        $request = $request->validated();
        $this->posts->insert($request + ['user_id' => Auth::id()]);
        return Response::json(['status' => 1]);
    }

    /** Update page | PATCH/PUT: /id
     * @param integer $id
     * @return mixed
     */
    public function update($id)
    {
        abort(404);
    }

    /** Delete page | DELETE: /id
     * @param integer $id
     * @return mixed
     */
    public function delete($id)
    {
        abort(404);
    }
}
