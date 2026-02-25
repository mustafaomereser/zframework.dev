<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Models\Topics;
use App\Requests\Posts\SaveRequest;
use App\Requests\Topic\StoreRequest;
use zFramework\Core\Abstracts\Controller;
use zFramework\Core\Facades\Auth;
use zFramework\Core\Facades\Lang;
use zFramework\Core\Facades\Response;
use zFramework\Core\Facades\Str;
use zFramework\Core\Validator;

#[\AllowDynamicProperties]
class TopicsController extends Controller
{

    public function __construct()
    {
        $this->topics = new Topics;
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
        $topic = $this->topics->where('slug', $id)->firstOrFail();
        $posts = $topic['posts']()->paginate();

        $name = 'seens-topic-' . $topic['id'];

        // $seens = apcu_fetch($name, $success);
        // apcu_store($name, ($success ? $seens : 0) + 1);
        // $seens = apcu_fetch($name);
        $seens = 0;
        $author = $topic['author']();

        return view('app.pages.topic.show', compact('topic', 'posts', 'author', 'seens'));
    }

    /** Create page | GET: /create
     * @return mixed
     */
    public function create()
    {
        return view('app.modals.topic.create');
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
    public function store(StoreRequest $request)
    {
        $validate = $request->validated();
        $topic    = $this->topics->insert($validate + ['slug' => Str::slug($validate['title']), 'author' => Auth::id(), 'lang' => Lang::currentLocale()]);

        $_REQUEST = [
            'target'  => 'topic-' . $topic['id'],
            'content' => request('content')
        ];
        (new PostsController)->store(new SaveRequest);

        return Response::json(['status' => 1, 'topic' => $topic['slug']]);
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
