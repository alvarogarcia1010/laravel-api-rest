<?php
/**
 * @file
 * Confirmation Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\ConfirmationManager;

use App\Repositories\Confirmation\ConfirmationInterface;
use Carbon\Carbon;

class ConfirmationManager implements ConfirmationManagementInterface {

    /**
	* Confirmation
	*
	* @var App\Repositories\Confirmation\ConfirmationInterface;
	*
	*/
    protected $Confirmation;

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
        ConfirmationInterface $Confirmation,
        Carbon $Carbon
    )
	{
        $this->Confirmation = $Confirmation;
        $this->Carbon = $Carbon;
        $this->responseType = 'confirmations';
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
            $count = $this->Confirmation->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->Confirmation->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($confirmation) use (&$rows)
        {
            $confirmation->birth_date_with_format = !empty($confirmation->birth_date)? $this->Carbon->createFromFormat('Y-m-d', $confirmation->birth_date, config('app.timezone'))->format('d/m/Y') : null;
            $confirmation->date_with_format = !empty($confirmation->date)? $this->Carbon->createFromFormat('Y-m-d', $confirmation->date, config('app.timezone'))->format('d/m/Y') : null;
            $id = strval($confirmation->id);
            unset($confirmation->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $confirmation
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

    public function getConfirmation($id)
    {
        $confirmation = $this->Confirmation->byId($id);

        if(empty($confirmation))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.confirmationNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $id = strval($confirmation->id);
        unset($confirmation->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $confirmation
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $confirmation = $this->Confirmation->create($request->all());
        $id = strval($confirmation->id);
        unset($confirmation->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $confirmation
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $id)
    {
        $confirmation = $this->Confirmation->byId($id);

        if(empty($confirmation))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.confirmationNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Confirmation->update($request->all(), $confirmation);
        $confirmation = $this->Confirmation->byId($id);
        unset($confirmation->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attributes' => $confirmation
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($id)
    {
        $confirmation = $this->Confirmation->byId($id);

        if(empty($confirmation))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.confirmationNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->Confirmation->delete($id);

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
