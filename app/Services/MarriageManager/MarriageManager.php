<?php
/**
 * @file
 * Marriage Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\MarriageManager;

use App\Repositories\Marriage\MarriageInterface;
use Carbon\Carbon;

class MarriageManager implements MarriageManagementInterface {

    /**
	* Marriage
	*
	* @var App\Repositories\Marriage\MarriageInterface;
	*
	*/
    protected $Marriage;

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
        MarriageInterface $Marriage,
        Carbon $Carbon
    )
	{
        $this->Marriage = $Marriage;
        $this->Carbon = $Carbon;
        $this->responseType = 'marriages';
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
            $count = $this->Marriage->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->Marriage->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($marriage) use (&$rows)
        {
            $marriage->date_with_format = !empty($marriage->date)? $this->Carbon->createFromFormat('Y-m-d', $marriage->date, config('app.timezone'))->format('d/m/Y') : null;
            $id = strval($marriage->id);
            unset($marriage->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $marriage
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

    public function getMarriage($id)
    {
        $marriage = $this->Marriage->byId($id);

        if(empty($marriage))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.marriageNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $id = strval($marriage->id);
        unset($marriage->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $marriage
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $marriage = $this->Marriage->create($request->all());
        $id = strval($marriage->id);
        unset($marriage->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $marriage
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $id)
    {
        $marriage = $this->Marriage->byId($id);

        if(empty($marriage))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.marriageNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Marriage->update($request->all(), $marriage);
        $marriage = $this->Marriage->byId($id);
        unset($marriage->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $marriage
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($id)
    {
        $marriage = $this->Marriage->byId($id);

        if(empty($marriage))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.marriageNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Marriage->delete($id);

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
