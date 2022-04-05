<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Settings\PermissionRequest;
use App\Services\Backend\Settings\PermissionService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class PermissionController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Permission Service
     */
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();

        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.permission') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->permissionService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.setting.permission.create');
        self::$data['deleteUrl']  = 'admin.setting.permission.destroy';
        self::$data['editUrl']  = 'admin.setting.permission.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.permission');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.setting.permission.list');
        self::$data['requestUrl'] = route('admin.setting.permission.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.settings.permission.create", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->permissionService->store($validated);
            return redirect()->route("admin.setting.permission.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
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
            self::$data['permission'] = $this->permissionService->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.setting.permission.update', ['id' => self::$data['permission']->id]);
            self::$data['backUrl'] = route('admin.setting.permission.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.settings.permission.create", self::$data);
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
    public function update(PermissionRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->permissionService->update($validated, $id);

            return redirect()->route("admin.setting.permission.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->permissionService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.setting.permission.list")
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
