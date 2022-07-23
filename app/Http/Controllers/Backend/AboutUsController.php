<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\AboutUsRequest;
use App\Services\Backend\AboutUsService;
use App\Traits\CommonTrait;
use Exception;

class AboutUsController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        parent::__construct();

        $this->aboutUsService = $aboutUsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.about_us');
        self::$data['subHeading'] = __('messages.list');
        self::$data['moduleName'] = "about-us";
        self::$data['lists'] =  $lists = $this->aboutUsService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.about_us.create');
        self::$data['deleteUrl']  = 'admin.about_us.destroy';
        self::$data['editUrl']  = 'admin.about_us.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.about_us');
        self::$data['subHeading'] = __('messages.create');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.about_us.list');
        self::$data['requestUrl'] = route('admin.about_us.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.about_us.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutUsRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->aboutUsService->store($validated, $request);
            return redirect()->route("admin.about_us.list")->with('success', __('messages.success.save', ['RECORD' => 'Module']));
        } catch (Exception $e) {
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
            self::$data['aboutUs'] = $this->aboutUsService->getById($id);
            self::$data['heading'] = __('messages.about_us');
            self::$data['subHeading'] = __('messages.edit');
            self::$data['requestUrl'] = route('admin.about_us.update', ['id' => self::$data['aboutUs']->id]);
            self::$data['backUrl'] = route('admin.about_us.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.about_us.form", self::$data);
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
    public function update(AboutUsRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $this->aboutUsService->update($validated, $request, $id);

            return redirect()->route("admin.about_us.list")->with('success', __('messages.success.update', ['RECORD' => 'Module']));
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
            $this->aboutUsService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.about_us.list")
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
