<?php
/**
 * @file
 * User Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\UserManager;

use App\Repositories\User\UserInterface;
use Carbon\Carbon;

class UserManager implements UserManagementInterface {

    /**
	* User
	*
	* @var App\Repositories\User\UserInterface;
	*
	*/
    protected $User;

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
        UserInterface $User,
        Carbon $Carbon
    )
	{
        $this->User = $User;
        $this->Carbon = $Carbon;
        $this->responseType = 'users';
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
            $count = $this->User->searchTableRowsWithPagination(true, $limit, $offset, $filter, $sortColumn, $sortOrder);

            encode_requested_data($request, $count, $limit, $offset, $totalPages, $page);
        }

        $this->User->searchTableRowsWithPagination(false, $limit, $offset, $filter, $sortColumn, $sortOrder)->each(function ($user) use (&$rows)
        {
            $id = strval($user->id);
            unset($user->id);

            array_push($rows, [
                'type' => $this->responseType,
                'id' => $id,
                'attribute' => $user
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

    public function getUser($user)
    {
        $id = strval($user->id);
        unset($user->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attribute' => $user
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function create($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'birth_date' => !empty($request->birth_date)? $this->Carbon->createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null,
            'phone_number' => $request->phone_number
        ];

        $user = $this->User->create($data);
        $id = strval($user->id);
        unset($user->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attribute' => $user
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function update($request, $id)
    {
        $unchangeValues = $this->User->byId($id);

        if(empty($unchangeValues))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.userNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        if(!empty($request['password']))
        {
            $request['password'] = bcrypt($request['password']);
        }

        if(!empty($request['username']) && $request['username'] != $unchangeValues->username)
        {
            if(!$this->User->byUsername($request['username'])->isEmpty())
            {
                return response()->json([
                    'errors' => [
                        'status' => '401',
                        'title' => __('base.failure'),
                        'detail' => __('base.usernameAlreadyExist')
                    ],
                    'jsonapi' => [
                        'version' => "1.00"
                    ]
                ], 404);
            }
        }
        else
        {
            unset($request['username']);
        }

        if(!empty($request['email']) && $request['email'] != $unchangeValues->email)
        {
            if(!$this->User->byEmail($request['email'])->isEmpty())
            {
                return response()->json([
                    'errors' => [
                        'status' => '401',
                        'title' => __('base.failure'),
                        'detail' => __('base.emailAlreadyExist')
                    ],
                    'jsonapi' => [
                        'version' => "1.00"
                    ]
                ], 404);
            }
        }
        else {
            unset($request['email']);
        }


        $this->User->update($request->all(), $unchangeValues);
        $user = $this->User->byId($id);
        unset($user->id);

        return response()->json([
            'data' => [
                'type' => $this->responseType,
                'id' => $id,
                'attribute' => $user
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function delete($id)
    {
        $user = $this->User->byId($id);

        if(empty($user))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('base.failure'),
                    'detail' => __('base.userNotFound')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 404);
        }

        $this->User->delete($id);

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
