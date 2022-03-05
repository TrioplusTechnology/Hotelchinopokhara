<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\ServiceRequest;
use App\Services\Backend\Service;
use App\Traits\CommonTrait;
use Exception;

class ServiceController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $service;

    public function __construct(Service $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.services') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->service->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.service.create');
        self::$data['deleteUrl']  = 'admin.service.destroy';
        self::$data['editUrl']  = 'admin.service.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.services');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.service.list');
        self::$data['requestUrl'] = route('admin.service.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.service.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->service->store($validated, $request);
            return redirect()->route("admin.service.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
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
            self::$data['services'] = $this->service->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.service.update', ['id' => self::$data['services']->id]);
            self::$data['backUrl'] = route('admin.service.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.service.form", self::$data);
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
    public function update(ServiceRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->service->update($validated, $request, $id);

            return redirect()->route("admin.service.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->service->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.service.list")
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
