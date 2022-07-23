<?php

namespace App\Http\Controllers\Backend\Room;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Room\RoomTypeRequest;
use App\Services\Backend\Room\RoomFeatureService;
use App\Services\Backend\Room\RoomTypeService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class RoomTypeController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $roomTypeService;

    private $roomFeatureService;

    public function __construct(RoomTypeService $roomTypeService, RoomFeatureService $roomFeatureService)
    {
        parent::__construct();

        $this->roomTypeService = $roomTypeService;
        $this->roomFeatureService = $roomFeatureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.room') . ' ' . __('messages.type');
        self::$data['subHeading'] = __('messages.list');
        self::$data['moduleName'] = "room-type";
        self::$data['lists'] =  $lists = $this->roomTypeService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.roomtype.create');
        self::$data['deleteUrl']  = 'admin.roomtype.destroy';
        self::$data['editUrl']  = 'admin.roomtype.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.room') . ' ' . __('messages.type');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.roomtype.list');
        self::$data['requestUrl'] = route('admin.roomtype.store');
        self::$data['requestMethod'] = 'POST';
        self::$data['features'] = $this->roomFeatureService->getAll();

        return view("backend.room.roomtype_form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeRequest $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->roomTypeService->store($validated);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'Room']),
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
            self::$data['room'] = $this->roomTypeService->getById($id);
            self::$data['heading'] = __('messages.room') . ' ' . __('messages.type');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.roomtype.update', ['id' => self::$data['room']->id]);
            self::$data['backUrl'] = route('admin.roomtype.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');
            self::$data['features'] = $this->roomFeatureService->getAll();

            return view("backend.room.roomtype_form", self::$data);
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
    public function update(RoomTypeRequest $request, $id)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->roomTypeService->update($validated, $id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'Room Type']),
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
            $this->roomTypeService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.roomtype.list")
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

            $this->roomTypeService->storeFile($request);

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

    public function getRoomImages($id)
    {
        try {
            if (!request()->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $result = $this->roomTypeService->getRoomImages($id);

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

            $result = $this->roomTypeService->deleteImage($request, $id);

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
