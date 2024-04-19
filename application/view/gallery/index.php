<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <form action="<?php echo Config::get('URL'); ?>gallery/upload" method="post" enctype="multipart/form-data" >
          <h3>Upload File</h3>
          <input type="file" name="file" id="file" required> <br>
          <button type="submit" name="submit">upload</button>
        </form>
        <h3>Gallerie</h3>
        <?php foreach($this->images as $image): ?>
          <img class="gallery-image" src="<?php echo Config::get('URL')?>gallery/getAllImages/<?php echo $image; ?>">
        <?php endforeach; ?>
      </div>
    </div>
  </body>
</html>
