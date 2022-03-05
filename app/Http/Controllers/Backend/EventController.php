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
            if (!$request->isAjax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            if ($request->hasFile('file')) {
                $this->eventService->storeFile($request);
                $module = 'event image';
            } else {
                $validated = $request->validated();
                $this->eventService->store($validated);
                $module = 'event';
            }

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => $module])
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
            self::$data['events'] = $this->eventService->getById($id);
            self::$data['heading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.event.update', ['id' => self::$data['events']->id]);
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
            $validated = $request->validated();
            $this->eventService->update($validated, $request, $id);

            return redirect()->route("admin.event.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
}
