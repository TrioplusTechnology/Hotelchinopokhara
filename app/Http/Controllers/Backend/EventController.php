<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\EventRequest;
use App\Services\Backend\EventService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class EventController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $eventService;

    public function __construct(EventService $eventService)
    {
        parent::__construct();

        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.events') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->eventService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.event.create');
        self::$data['deleteUrl']  = 'admin.event.destroy';
        self::$data['editUrl']  = 'admin.event.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.events');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.event.list');
        self::$data['requestUrl'] = route('admin.event.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.event.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->eventService->store($validated);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'Event']),
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
            self::$data['event'] = $this->eventService->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.event.update', ['id' => self::$data['event']->id]);
            self::$data['backUrl'] = route('admin.event.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.event.form", self::$data);
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
    public function update(EventRequest $request, $id)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->eventService->update($validated, $id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'Event']),
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
            $this->eventService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.event.list")
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

            $this->eventService->storeFile($request);

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

    public function getEventImages($id)
    {
        try {
            if (!request()->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $result = $this->eventService->getEventImages($id);

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

            $result = $this->eventService->deleteImage($request, $id);

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
