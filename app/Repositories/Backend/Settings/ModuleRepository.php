<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Module;
use Exception;

class ModuleRepository
{
    /**
     * @var Module
     */
    protected $module;

    /**
     * Constructor
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    public function store($data)
    {
        return $this->module->create($data);
    }

    public function getAllMOdule()
    {
        return $this->module->all();
    }

    public function getModuleById($id)
    {
        return $this->module->find($id);
    }

    public function update($data, $id)
    {
        return $this->module->where(['id' => $id])->update($data);
    }

    public function destroy($id)
    {
        $module = $this->getModuleById($id);

        if (!$module) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'Module']), 404);
        };

        $result =  $module->delete();

        return $result;
    }
}
