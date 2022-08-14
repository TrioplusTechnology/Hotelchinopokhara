<?php

namespace App\Http\Controllers\Backend\Room;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\Room\RoomFeatureRequest;
use App\Services\Backend\Room\RoomFeatureService;
use App\Traits\CommonTrait;
use Exception;

class RoomFeatureController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $roomFeatureService;

    public function __construct(RoomFeatureService $roomFeatureService)
    {
        parent::__construct();

        $this->roomFeatureService = $roomFeatureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.room_feature');
        self::$data['subHeading'] = __('messages.list');
        self::$data['moduleName'] = "room-feature";
        self::$data['lists'] =  $lists = $this->roomFeatureService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.roomtype.feature.create');
        self::$data['deleteUrl']  = 'admin.roomtype.feature.destroy';
        self::$data['editUrl']  = 'admin.roomtype.feature.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.room_feature');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.roomtype.feature.list');
        self::$data['requestUrl'] = route('admin.roomtype.feature.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.room.room_feature_form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomFeatureRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->roomFeatureService->store($validated, $request);
            return redirect()->route("admin.roomtype.feature.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
        } catch (Exception $e) {
            dd($e);
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
    public function edit($id)
    {
        try {
            self::$data['room'] = $this->roomFeatureService->getById($id);
            self::$data['heading'] = __('messages.room');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.roomtype.feature.update', ['id' => self::$data['room']->id]);
            self::$data['backUrl'] = route('admin.roomtype.feature.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.room.room_feature_form", self::$data);
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
    public function update(RoomFeatureRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->roomFeatureService->update($validated, $id);

            return redirect()->route("admin.roomtype.feature.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->roomFeatureService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.roomtype.feature.list")
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
