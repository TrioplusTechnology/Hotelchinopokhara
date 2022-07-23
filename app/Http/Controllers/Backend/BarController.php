<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\BarRequest;
use App\Services\Backend\BarService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class BarController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $barService;

    public function __construct(BarService $barService)
    {
        parent::__construct();

        $this->barService = $barService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.bars');
        self::$data['moduleName'] = "bar";
        self::$data['subHeading'] = __('messages.list');
        self::$data['lists'] =  $lists = $this->barService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.bar.create');
        self::$data['deleteUrl']  = 'admin.bar.destroy';
        self::$data['editUrl']  = 'admin.bar.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.bars');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.bar.list');
        self::$data['requestUrl'] = route('admin.bar.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.bar.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarRequest $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->barService->store($validated);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'bar']),
                'data' => $result
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
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
            self::$data['bar'] = $this->barService->getById($id);
            self::$data['heading'] = __('messages.bars');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.bar.update', ['id' => self::$data['bar']->id]);
            self::$data['backUrl'] = route('admin.bar.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.bar.form", self::$data);
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
    public function update(BarRequest $request, $id)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->barService->update($validated, $id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'bar']),
                'data' => $result
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
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
            $this->barService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.bar.list")
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFile(Request $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $this->barService->storeFile($request);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'Images'])
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function getBarImages($id)
    {
        try {
            if (!request()->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $result = $this->barService->getBarImages($id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.get', ['RECORD' => 'Images']),
                'data' => $result
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function deleteImage(Request $request, $id)
    {
        try {
            if (!request()->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $result = $this->barService->deleteImage($request, $id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.get', ['RECORD' => 'Images']),
                'data' => $result
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
