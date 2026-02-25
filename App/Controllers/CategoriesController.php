<?php

namespace App\Controllers;

use App\Models\Categories;
use zFramework\Core\Abstracts\Controller;

#[\AllowDynamicProperties]
class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->category = new Categories;
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
        $category = $this->category->where('slug', $id)->firstOrFail();
        $topics   = $category['topics']()->orderBy(['id' => 'DESC'])->paginate();
        return view('app.pages.category.show', compact('category', 'topics'));
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
    public function store()
    {
        abort(404);
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
