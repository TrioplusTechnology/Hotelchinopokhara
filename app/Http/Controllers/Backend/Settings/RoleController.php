<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Settings\RoleRequest;
use App\Services\Backend\Settings\ModuleService;
use App\Services\Backend\Settings\PermissionService;
use App\Services\Backend\Settings\RoleService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class RoleController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;
    /**
     * Role service
     */
    private $roleService;

    /**
     * Module Service
     */
    private $moduleService;

    /**
     * Permission service
     */
    private $permissionService;

    public function __construct(RoleService $roleService, ModuleService $moduleService, PermissionService $permissionService)
    {
        parent::__construct();

        $this->roleService = $roleService;
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
        self::$data['heading'] = __('messages.role');
        self::$data['subHeading'] = __('messages.list');
        self::$data['lists'] = $lists = $this->roleService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.setting.role.create');
        self::$data['deleteUrl']  = 'admin.setting.role.destroy';
        self::$data['editUrl']  = 'admin.setting.role.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.role');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.setting.role.list');
        self::$data['requestUrl'] = route('admin.setting.role.store');
        self::$data['requestMethod'] = 'POST';
        self::$data['modules'] = $this->moduleService->getAllModule();
        self::$data['permissions'] = $this->permissionService->getAll();

        return view("backend.settings.role.create", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->roleService->store($validated);
            return redirect()->route("admin.setting.role.list")->with('success', __('messages.success.save', ['RECORD' => 'Role']));
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
            self::$data['heading'] = __('messages.role');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['role'] = $role = $this->roleService->getRoleById($id);
            self::$data['requestUrl'] = route('admin.setting.role.update', ['id' => self::$data['role']->id]);
            self::$data['backUrl'] = route('admin.setting.role.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.settings.role.create", self::$data);
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
    public function update(RoleRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->roleService->update($validated, $id);

            return redirect()->route("admin.setting.role.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->roleService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Role']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Role']),
                'redirectUrl' => route("admin.setting.role.list")
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
