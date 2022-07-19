<?php

namespace App\Services\Backend\UserManagement;

use App\Models\User;
use App\Repositories\Backend\UserManagement\UserRepository;
use App\Services\Backend\Settings\RoleService;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{

  /**
   * @var $registrationRepository
   */
  protected $userRepository;
  protected $roleService;

  /**
   * Constructor
   */
  public function __construct(UserRepository $userRepository, RoleService $roleService)
  {
    $this->userRepository = $userRepository;
    $this->roleService = $roleService;
  }

  /**
   * Stores users
   */
  public function store($request)
  {

    $dataToInsert = [
      'email' => $request->email,
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'phone' => $request->phone,
      "status" => $request->status,
      'password' => Hash::make($request->password),
    ];

    $user = $this->userRepository->store($dataToInsert);
    $user->roles()->sync($request->role);

    if (!$user) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

    return $user;
  }

  public function getAllRoles()
  {
    return $this->roleService->getAll();
  }

  /**
   * Gets all module list
   */
  public function getAllUsers()
  {
    return $this->userRepository->getAll();
  }

  /**
   * Get data by id.
   */
  public function getById($id)
  {
    $result = $this->userRepository->getById($id);

    if (empty($result)) {
      throw new Exception(__('messages.error.not_found', ['RECORD' => 'user']), 404);
    }

    return $result;
  }

  /**
   * Updates about us
   */
  public function update($request, $id)
  {
    $role = $request['role'];
    unset($request['role']);

    $user = $this->userRepository->update($request, $id);
    $user->roles()->sync($role);

    if (!$user) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

    return $user;
  }

  /**
   * Deletes data
   */
  public function destroy($id)
  {
    $result = $this->userRepository->destroy($id);

    if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'user']), 422);
    return $result;
  }

  public function getUserRoleInArray(User $user)
  {
    $roles = $user->roles;

    $roleInArray = [];
    foreach ($roles as $role) {
      array_push($roleInArray, $role->id);
    }

    return $roleInArray;
  }
}
