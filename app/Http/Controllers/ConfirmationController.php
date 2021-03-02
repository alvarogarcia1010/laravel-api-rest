<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmationRequest;
use Illuminate\Http\Request;
use App\Services\ConfirmationManager\ConfirmationManagementInterface;

class ConfirmationController extends Controller
{
    /**
	 * Confirmation Manager Service
	 *
	 * @var App\Services\ConfirmationManager\ConfirmationManagementInterface;
	 *
	 */
    protected $ConfirmationManagerService;

    public function __construct(
		ConfirmationManagementInterface $ConfirmationManagerService
	)
	{
		$this->ConfirmationManagerService = $ConfirmationManagerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->ConfirmationManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfirmationRequest $request)
    {
        return $this->ConfirmationManagerService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Confirmation  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ConfirmationManagerService->getConfirmation($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Confirmation  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ConfirmationRequest $request, $data)
    {
        return $this->ConfirmationManagerService->update($request, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Confirmation  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->ConfirmationManagerService->delete($request);
    }
}
