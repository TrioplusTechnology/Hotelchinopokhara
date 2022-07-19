<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Settings\ModuleRequest;
use App\Services\Backend\Settings\ModuleService;
use App\Services\Backend\Settings\PermissionService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class ModuleController extends BackendController
{

    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $moduleService;

    /**
     * Permission service
     */
    private $permissionService;

    /**
     * Constructor
     */
    public function __construct(ModuleService $moduleService, PermissionService $permissionService)
    {
        parent::__construct();

        $this->moduleService = $moduleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.module');
        self::$data['subHeading'] = __('messages.list');
        self::$data['addUrl']  = route('admin.setting.module.create');
        self::$data['modules'] = $this->moduleService->getAllModule();

        return view("backend.settings.module.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.module');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.setting.module.list');
        self::$data['requestUrl'] = route('admin.setting.module.store');
        self::$data['requestMethod'] = 'POST';
        self::$data['permissions'] = $this->permissionService->getAll();

        return view("backend.settings.module.create", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->moduleService->store($validated);
            return redirect()->route("admin.setting.module.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
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
            self::$data['heading'] = __('messages.module');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['module'] = $modules = $this->moduleService->getModuleById($id);
            self::$data['permissionArray'] = $this->getAllPermissionInArray($modules);
            self::$data['permissions'] = $this->permissionService->getAll();
            self::$data['requestUrl'] = route('admin.setting.module.update', ['id' => self::$data['module']->id]);
            self::$data['backUrl'] = route('admin.setting.module.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.settings.module.create", self::$data);
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
    public function update(ModuleRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->moduleService->update($validated, $id);

            return redirect()->route("admin.setting.module.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->moduleService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.setting.module.list")
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

    public function getAllPermissionInArray($modules)
    {
        $permissionStack = [];
        if ($modules->permissions->isEmpty()) {
            return $permissionStack;
        }

        foreach ($modules->permissions as $permission) {
            array_push($permissionStack, $permission->id);
        }

        return $permissionStack;
    }
}
