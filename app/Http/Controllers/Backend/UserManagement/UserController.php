<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\UserManagement\UserRequest;
use App\Http\Requests\Backend\UserManagement\UserUpdateRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Backend\Settings\RoleService;
use App\Services\Backend\UserManagement\UserService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.user') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->userService->getAllUsers();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.user-management.user.register');
        self::$data['deleteUrl']  = 'admin.user-management.user.delete';
        self::$data['editUrl']  = 'admin.user-management.user.edit';

        return view("backend.auth.user_list", self::$data);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        self::$data['heading'] = __("messages.user");
        self::$data['requestMethod'] = "POST";
        self::$data['requestUrl'] =  route('admin.user-management.user.register');
        self::$data['btnName'] =  "Create";
        self::$data['roles'] = $this->userService->getAllRoles();

        return view('backend.auth.register', self::$data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $user = $this->userService->store($request);

        // event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
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
            self::$data['user'] = $user = $this->userService->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.user-management.user.update', ['id' => self::$data['user']->id]);
            self::$data['backUrl'] = route('admin.user-management.user.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');
            self::$data['roles'] = $this->userService->getAllRoles();
            self::$data['userRolesInArray'] = $this->userService->getUserRoleInArray($user);

            return view("backend.auth.register", self::$data);
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
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $this->userService->update($data, $id);

            return redirect()->route("admin.user-management.user.list")->with('success', __('messages.success.update', ['RECORD' => 'User']));
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
    public function delete($id)
    {
        try {
            $this->userService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'User']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'User']),
                'redirectUrl' => route("admin.user-management.user.list")
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
