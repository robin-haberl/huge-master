<?php
class GalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index() {
        $this->View->render('gallery/index', array(
            'createUserFolder' => GalleryModel::createFolder(Session::get('user_id')),
            'images' => GalleryModel::getAllImagesNames(),
        ));
    }

    public function upload(){
        GalleryModel::uploadImages();
        Redirect::to("gallery/index/");
    }

    public function getAllImages($image)
    {
        GalleryModel::getAllImages($image);

    }
}