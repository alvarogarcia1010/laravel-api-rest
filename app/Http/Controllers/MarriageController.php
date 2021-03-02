<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarriageRequest;
use Illuminate\Http\Request;
use App\Services\MarriageManager\MarriageManagementInterface;

class MarriageController extends Controller
{
    /**
	 * Marriage Manager Service
	 *
	 * @var App\Services\MarriageManager\MarriageManagementInterface;
	 *
	 */
    protected $MarriageManagerService;

    public function __construct(
		MarriageManagementInterface $MarriageManagerService
	)
	{
		$this->MarriageManagerService = $MarriageManagerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->MarriageManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarriageRequest $request)
    {
        return $this->MarriageManagerService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marriage  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->MarriageManagerService->getMarriage($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marriage  $article
     * @return \Illuminate\Http\Response
     */
    public function update(MarriageRequest $request, $data)
    {
        return $this->MarriageManagerService->update($request, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marriage  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->MarriageManagerService->delete($request);
    }
}
