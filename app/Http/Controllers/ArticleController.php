<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Services\ArticleManager\ArticleManagementInterface;

class ArticleController extends Controller {

    /**
	 * Article Manager Service
	 *
	 * @var App\Services\ArticleManager\ArticleManagementInterface;
	 *
	 */
    protected $ArticleManagerService;

    public function __construct(
		ArticleManagementInterface $ArticleManagerService
	)
	{
		$this->ArticleManagerService = $ArticleManagerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->ArticleManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        return $this->ArticleManagerService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $this->ArticleManagerService->getArticle($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $data)
    {
        return $this->ArticleManagerService->update($request, $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->ArticleManagerService->delete($request);
    }
}
