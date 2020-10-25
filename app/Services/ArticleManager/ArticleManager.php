<?php
/**
 * @file
 * Article Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\ArticleManager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Repositories\Article\ArticleInterface;
use Carbon\Carbon;

class ArticleManager implements ArticleManagementInterface {

    /**
	* Article
	*
	* @var App\Repositories\Article\ArticleInterface;
	*
	*/
    protected $Article;

    /**
    * Carbon instance
    *
    * @var Carbon\Carbon
    *
    */
    protected $Carbon;

    /**
    * responseType
    *
    * @var String
    *
    */
    protected $responseType;

	public function __construct(
        ArticleInterface $Article,
        Carbon $Carbon
    )
	{
        $this->Article = $Article;
        $this->Carbon = $Carbon;
        $this->responseType = 'articles';
    }

    public function getTableRowsWithPagination($request, $pager = true, $returnJson = true)
    {
        $rows = [];
        $limit = $offset = $count = $page = $totalPages = 0;
        $filter = $sortColumn = $sortOrder = '';

        if(!empty($request['filter']))
        {
            $filter = $request['filter'];
        }

        if(!empty($request['sort']) && $request['sort'][0] == '-')
        {
            $sortColumn = substr($request['sort'], 1);
            $sortOrder = 'desc';
        }
        else if(!empty($request['sort']))
        {
            $sortColumn = $request['sort'];
            $sortOrder = 'asc';
        }
        else
        {
            $sortColumn = 'id';
            $sortOrder = 'asc';
        }

        if($pager)
        {
            $count = $this->Article->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->Article->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($article) use (&$rows)
        {
            $id = strval($article->id);
            unset($article->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attribute' => $article
            ]);
        });

        $nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;
        $prevPage = ($page > 1) ? $page - 1 : 1;

        return response()->json([
            'meta' => [
                'page' => $page,
                'totalPages' => $totalPages,
                'records' => $count,
            ],
            'data' => $rows,
            'links' => [
                "self" =>  url("/articles?page[number]=$page&page[size]=$limit"),
                "first" => url("/articles?page[number]=1&page[size]=$limit"),
                "prev" => url("/articles?page[number]=$prevPage&page[size]=$limit"),
                "next" => url("/articles?page[number]=$$nextPage&page[size]=$limit"),
                "last" => url("/articles?page[number]=$totalPages&page[size]=$limit")
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function getArticle($article)
    {
        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => strval($article->id),
                'attribute' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $article = $this->article->create($request->all());

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => strval($article->id),
                'attribute' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $article)
    {
        $article = $this->Article->update($request->all(), $article);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => strval($article->id),
                'attribute' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($request)
    {
        $this->Article->delete($request);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'success' => __('base.delete'),
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }
}
