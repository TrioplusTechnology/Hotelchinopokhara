<?php

namespace App\Http\Controllers\Backend\Room;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Room\RoomRequest;
use App\Services\Backend\Room\RoomFeatureService;
use App\Services\Backend\Room\RoomService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class RoomController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $roomService;

    private $roomFeatureService;

    public function __construct(RoomService $roomService, RoomFeatureService $roomFeatureService)
    {
        parent::__construct();

        $this->roomService = $roomService;
        $this->roomFeatureService = $roomFeatureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.room') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->roomService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.room.create');
        self::$data['deleteUrl']  = 'admin.room.destroy';
        self::$data['editUrl']  = 'admin.room.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.room');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.room.list');
        self::$data['requestUrl'] = route('admin.room.store');
        self::$data['requestMethod'] = 'POST';
        self::$data['features'] = $this->roomFeatureService->getAll();

        return view("backend.room.room_form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->roomService->store($validated);

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
            self::$data['room'] = $this->roomService->getById($id);
            self::$data['heading'] = __('messages.room');
            self::$data['requestUrl'] = route('admin.room.update', ['id' => self::$data['room']->id]);
            self::$data['backUrl'] = route('admin.room.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');
            self::$data['features'] = $this->roomFeatureService->getAll();

            return view("backend.room.room_form", self::$data);
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
    public function update(RoomRequest $request, $id)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->roomService->update($validated, $id);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->roomService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.room.list")
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

            $this->roomService->storeFile($request);

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

            $result = $this->roomService->getRoomImages($id);

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

            $result = $this->roomService->deleteImage($request, $id);

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
