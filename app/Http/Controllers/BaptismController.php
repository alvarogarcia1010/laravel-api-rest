<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaptismRequest;
use Illuminate\Http\Request;
use App\Services\BaptismManager\BaptismManagementInterface;

class BaptismController extends Controller
{
    /**
	 * Baptism Manager Service
	 *
	 * @var App\Services\BaptismManager\BaptismManagementInterface;
	 *
	 */
    protected $BaptismManagerService;

    public function __construct(
		BaptismManagementInterface $BaptismManagerService
	)
	{
		$this->BaptismManagerService = $BaptismManagerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->BaptismManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BaptismRequest $request)
    {
        return $this->BaptismManagerService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Baptism  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->BaptismManagerService->getBaptism($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Baptism  $article
     * @return \Illuminate\Http\Response
     */
    public function update(BaptismRequest $request, $data)
    {
        return $this->BaptismManagerService->update($request, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Baptism  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->BaptismManagerService->delete($request);
    }
}
