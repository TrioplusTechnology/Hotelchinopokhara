<?php

namespace App\Repositories\Backend\UserManagement;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
  /**
   * @var model
   */
  protected $model;

  /**
   * Constructor
   */
  public function __construct(User $model)
  {
    parent::__construct($model);
  }
}
