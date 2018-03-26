<?php

namespace Partymeister\Core\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Core\Models\Visitor;
use Partymeister\Core\Http\Requests\Backend\VisitorRequest;
use Partymeister\Core\Services\VisitorService;
use Partymeister\Core\Transformers\VisitorTransformer;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = VisitorService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, VisitorTransformer::class);

        return $this->respondWithJson('Visitor collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorRequest $request)
    {
        $result = VisitorService::create($request)->getResult();
        $resource = $this->transformItem($result, VisitorTransformer::class);

        return $this->respondWithJson('Visitor created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $record)
    {
        $result = VisitorService::show($record)->getResult();
        $resource = $this->transformItem($result, VisitorTransformer::class);

        return $this->respondWithJson('Visitor read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorRequest $request, Visitor $record)
    {
        $result = VisitorService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, VisitorTransformer::class);

        return $this->respondWithJson('Visitor updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $record)
    {
        $result = VisitorService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Visitor deleted', ['success' => true]);
        }
        return $this->respondWithJson('Visitor NOT deleted', ['success' => false]);
    }
}