<?php
/**
 * @file
 * Article Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\ArticleManager;

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
            $sortOrder = 'desc';
        }

        if($pager)
        {
            $count = $this->Article->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->Article->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($article) use (&$rows)
        {
            $article->price_label = '$ ' . number_format($article->price , 2, __('base.decimalSeparator'), __('base.thousandsSeparator'));
            $id = strval($article->id);
            unset($article->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $article
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
                "self" =>  url("/api/$this->responseType?page[number]=$page&page[size]=$limit"),
                "first" => url("/api/$this->responseType?page[number]=1&page[size]=$limit"),
                "prev" => url("/api/$this->responseType?page[number]=$prevPage&page[size]=$limit"),
                "next" => url("/api/$this->responseType?page[number]=$$nextPage&page[size]=$limit"),
                "last" => url("/api/$this->responseType?page[number]=$totalPages&page[size]=$limit")
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function getArticle($article)
    {
        $id = strval($article->id);
        unset($article->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $article = $this->Article->create($request->all());
        $id = strval($article->id);
        unset($article->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $id)
    {
        $article = $this->Article->byId($id);

        if(empty($article))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.articleNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Article->update($request->all(), $article);
        $article = $this->Article->byId($id);
        unset($article->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $article
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($id)
    {
        $article = $this->Article->byId($id);

        if(empty($article))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.articleNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Article->delete($id);

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
