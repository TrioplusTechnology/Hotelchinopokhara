<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Backend\GalleryRequest;
use App\Services\Backend\GalleryService;
use App\Traits\CommonTrait;
use Exception;
use Illuminate\Http\Request;

class GalleryController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        parent::__construct();

        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.gallery') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->galleryService->getAll();
        self::$data['keys'] = $this->getKeysFromExtractedData($lists);
        self::$data['addUrl']  = route('admin.gallery.create');
        self::$data['deleteUrl']  = 'admin.gallery.destroy';
        self::$data['editUrl']  = 'admin.gallery.edit';

        return view("backend.common.list", self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['heading'] = __('messages.gallery');
        self::$data['btnName'] = __('messages.save');
        self::$data['backUrl'] = route('admin.gallery.list');
        self::$data['requestUrl'] = route('admin.gallery.store');
        self::$data['requestMethod'] = 'POST';
        return view("backend.gallery.form", self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->galleryService->store($validated);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'gallery']),
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
            self::$data['gallery'] = $this->galleryService->getById($id);
            self::$data['heading'] = __('messages.gallery');
            self::$data['requestUrl'] = route('admin.gallery.update', ['id' => self::$data['gallery']->id]);
            self::$data['backUrl'] = route('admin.gallery.list');
            self::$data['requestMethod'] = 'POST';
            self::$data['btnName'] = __('messages.update');

            return view("backend.gallery.form", self::$data);
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
    public function update(galleryRequest $request, $id)
    {
        try {
            if (!$request->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }
            $validated = $request->validated();
            $result = $this->galleryService->update($validated, $id);

            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.save', ['RECORD' => 'gallery']),
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
            $this->galleryService->destroy($id);
            session()->flash('success',  __('messages.success.delete', ['RECORD' => 'Module']));
            $response = [
                'status' => 'success',
                'code' => 200,
                'message' => __('messages.success.delete', ['RECORD' => 'Module']),
                'redirectUrl' => route("admin.gallery.list")
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

            $this->galleryService->storeFile($request);

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

    public function getGalleryImages($id)
    {
        try {
            if (!request()->ajax()) {
                throw new Exception(__('messages.error.direct_script_not_allowed'), 419);
            }

            $result = $this->galleryService->getgalleryImages($id);

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

            $result = $this->galleryService->deleteImage($request, $id);

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
