<?php
class GalleryModel {

    public static function createFolder($userId)
  {
      $galleryPath = Config::get('PATH_GALLERY_FOLDER');

      $userFolderPath = $galleryPath . DIRECTORY_SEPARATOR . $userId;
 
      // Wenn das Verzeichnis noch nicht existiert wird es erstellt.
      if (!file_exists($userFolderPath)) {
          mkdir($userFolderPath, 0777, true);
      }
  }

    public static function uploadImages(){
        $userId = Session::get('user_id');

        $galleryPath = Config::get('PATH_GALLERY_FOLDER');

        $galleryIdFolderPath = $galleryPath . DIRECTORY_SEPARATOR . $userId;

        $fileName = $_FILES['file']['name'];
 
        $filePath = $galleryIdFolderPath . DIRECTORY_SEPARATOR . $fileName;

        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
    }
    
    public static function getAllImages($file)
    {
        $userId = Session::get('user_id');
        $galleryPath = Config::get('PATH_GALLERY_FOLDER');

        $galleryFolder = $galleryPath . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . $file;

        $images = readfile($galleryFolder);

        return $images;
    }
    public static function getAllImagesNames(){
        $userId = Session::get('user_id');
        $basePath = Config::get('PATH_GALLERY_FOLDER');

        $galleryIdFolderPath = $basePath . DIRECTORY_SEPARATOR . $userId;

        $files = scandir($galleryIdFolderPath);

        unset($files[0]);
        unset($files[1]);

        return $files;
    }
}