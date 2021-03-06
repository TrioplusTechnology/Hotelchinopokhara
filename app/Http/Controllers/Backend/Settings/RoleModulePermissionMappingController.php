<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Settings\RoleModulePermissionMappingRequest;
use App\Http\Requests\Backend\Settings\RoleRequest;
use App\Services\Backend\Settings\ModuleService;
use App\Services\Backend\Settings\PermissionService;
use App\Services\Backend\Settings\RoleModulePermissionMappingService;
use App\Services\Backend\Settings\RoleService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class RoleModulePermissionMappingController extends BackendController
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

    private $mappingService;

    public function __construct(RoleService $roleService, ModuleService $moduleService, PermissionService $permissionService, RoleModulePermissionMappingService $mappingService)
    {
        parent::__construct();

        $this->roleService = $roleService;
        $this->moduleService = $moduleService;
        $this->mappingService = $mappingService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.role_module_permission_mapping');
        self::$data['subHeading'] = __('messages.list');
        self::$data['addUrl']  = route('admin.setting.mapping.create');
        self::$data['mappingList'] = $this->roleService->getAllRoleModulePermissionData();

        return view("backend.settings.role_module_permission.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.role_module_permission_mapping');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.setting.mapping.list');
        self::$data['requestUrl'] = route('admin.setting.mapping.store');
        self::$data['requestMethod'] = 'POST';
        self::$data['roles'] = $this->roleService->getAll();
        self::$data['modules'] = $modules = $this->moduleService->getAllModule();

        return view("backend.settings.role_module_permission.create", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleModulePermissionMappingRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->mappingService->store($validated);
            return redirect()->route("admin.setting.mapping.list")->with('success', __('messages.success.save', ['RECORD' => 'Role']));
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
    public function edit($roleId, $moduleId)
    {
        try {
            self::$data['mappingData'] = $this->roleService->getRoleModulePermissionMappingByIds($roleId, $moduleId);
            self::$data['mappingData']->permissions = json_decode(self::$data['mappingData']->permissions);
            self::$data['roles'] = $this->roleService->getAll();
            self::$data['modules'] = $this->moduleService->getAllModule();
            self::$data['heading'] = __('messages.role_module_permission_mapping');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.setting.mapping.update', ['roleId' => $roleId, 'moduleId' => $moduleId]);
            self::$data['backUrl'] = route('admin.setting.mapping.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.settings.role_module_permission.create", self::$data);
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
    public function update(RoleModulePermissionMappingRequest $request, $roleId, $moduleId)
    {
        try {
            $validated = $request->validated();
            $this->mappingService->update($validated, $roleId, $moduleId);

            return redirect()->route("admin.setting.mapping.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
    public function destroy($roleId, $moduleId)
    {
        try {
            $this->mappingService->destroy($roleId, $moduleId);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Role']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Role']),
                'redirectUrl' => route("admin.setting.mapping.list")
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

    /**
     * Gets permission by module
     */
    public function getPermissionByModule(Request $request)
    {
        try {
            if (!$request->ajax())
                throw new Exception(__('messages.error.direct_script_not_allowed'), 400);

            if (empty($request->module) || !is_numeric($request->module))
                throw new Exception(__('messages.error.bad_request'), 400);

            $module = $this->moduleService->getModuleById($request->module);
            if (!$module)
                throw new Exception(__('messages.error.not_found', ['RECORD' => 'Module']), 404);

            $permissionHtml = "";

            // dd($this->roleService->getRoleModulePermissionMappingByIds($request->role_id, $request->module_id));

            $permissionArray = $request->isEdit ? $this->getPermissionInArray($request->role, $request->module) : [];

            foreach ($module->permissions as $key => $permission) {
                $checked = in_array($permission->id, $permissionArray) ? 'checked' : '';
                $permissionHtml .= '<div class="icheck-primary d-inline">
                    <input type="checkbox" id="permission' . $key . '" name="permission[]" value="' . $permission->id . '"  ' . $checked . '>
                    <label for="permission' . $key . '">
                        ' . $permission->name . '
                    </label>
                </div>';
            }

            if (empty($permissionHtml)) throw new Exception(__('messages.error.not_found', ['RECORD' => 'Permission']), 404);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.get', ['RECORD' => 'Permissions']),
                'data' => $permissionHtml
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

    public function getPermissionInArray($roleId, $moduleId)
    {
        $permissionData = $this->roleService->getRoleModulePermissionMappingByIds($roleId, $moduleId);

        $permissionArray = [];

        if ($permissionData) {

            foreach (json_decode($permissionData->permissions, TRUE) as $permission) {
                array_push($permissionArray, $permission['id']);
            }
        }


        return $permissionArray;
    }
}
