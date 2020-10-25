<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserManager\UserManagementInterface;

class UserController extends Controller
{
    /**
	 * User Manager Service
	 *
	 * @var App\Services\UserManager\UserManagementInterface;
	 *
	 */
    protected $UserManagerService;

    public function __construct(
		UserManagementInterface $UserManagerService
	)
	{
		$this->UserManagerService = $UserManagerService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->UserManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->UserManagerService->getUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        return $this->UserManagerService->update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->UserManagerService->delete($request);
    }
}
