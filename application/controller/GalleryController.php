<?php
class GalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->View->render('gallery/index');
    }
}