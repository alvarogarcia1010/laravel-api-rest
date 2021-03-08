<?php
/**
 * @file
 * Baptism Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\BaptismManager;

use App\Repositories\Baptism\BaptismInterface;
use Carbon\Carbon;

class BaptismManager implements BaptismManagementInterface {

    /**
	* Baptism
	*
	* @var App\Repositories\Baptism\BaptismInterface;
	*
	*/
    protected $Baptism;

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
        BaptismInterface $Baptism,
        Carbon $Carbon
    )
	{
        $this->Baptism = $Baptism;
        $this->Carbon = $Carbon;
        $this->responseType = 'baptisms';
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
            $count = $this->Baptism->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->Baptism->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($baptism) use (&$rows)
        {
            $baptism->birth_date_with_format = !empty($baptism->birth_date)? $this->Carbon->createFromFormat('Y-m-d', $baptism->birth_date, config('app.timezone'))->format('d/m/Y') : null;
            $baptism->date_with_format = !empty($baptism->date)? $this->Carbon->createFromFormat('Y-m-d', $baptism->date, config('app.timezone'))->format('d/m/Y') : null;
            $id = strval($baptism->id);
            unset($baptism->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $baptism
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

    public function getBaptism($id)
    {
        $baptism = $this->Baptism->byId($id);

        if(empty($baptism))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.baptismNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $id = strval($baptism->id);
        unset($baptism->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $baptism
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $baptism = $this->Baptism->create($request->all());
        $id = strval($baptism->id);
        unset($baptism->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $baptism
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $id)
    {
        $baptism = $this->Baptism->byId($id);

        if(empty($baptism))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.baptismNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Baptism->update($request->all(), $baptism);
        $baptism = $this->Baptism->byId($id);
        unset($baptism->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $baptism
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($id)
    {
        $baptism = $this->Baptism->byId($id);

        if(empty($baptism))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.baptismNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Baptism->delete($id);

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
