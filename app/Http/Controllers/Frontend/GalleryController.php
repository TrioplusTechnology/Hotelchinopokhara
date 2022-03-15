<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\GalleryService;

class GalleryController extends FrontendController
{
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
        self::$data['results'] = $this->galleryService->getAll();

        return view("frontend.gallery", self::$data);
    }

    /**
     * Gets gallery images
     */
    public function getAlbums($id)
    {
        self::$data['results'] = $images = $this->galleryService->getGalleryImages($id);

        return view("frontend.album", self::$data);
    }
}
