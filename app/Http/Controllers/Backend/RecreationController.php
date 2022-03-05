<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\RecreationRequest;
use App\Services\Backend\RecreationService;
use App\Traits\CommonTrait;
use Exception;

class RecreationController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $recreationService;

    public function __construct(RecreationService $recreationService)
    {
        parent::__construct();

        $this->recreationService = $recreationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.recreation') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->recreationService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.recreation.create');
        self::$data['deleteUrl']  = 'admin.recreation.destroy';
        self::$data['editUrl']  = 'admin.recreation.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.recreation');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.recreation.list');
        self::$data['requestUrl'] = route('admin.recreation.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.recreation.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecreationRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->recreationService->store($validated, $request);
            return redirect()->route("admin.recreation.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            self::$data['recreations'] = $this->recreationService->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.recreation.update', ['id' => self::$data['recreations']->id]);
            self::$data['backUrl'] = route('admin.recreation.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.recreation.form", self::$data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecreationRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->recreationService->update($validated, $request, $id);

            return redirect()->route("admin.recreation.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->recreationService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.recreation.list")
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['code']);
    }
}
