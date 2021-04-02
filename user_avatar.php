<?php
include_once "session.php";

include_once "database.php";


$id = $_SESSION['user_id'];

$target_dir = "avatars/";

$random = $id.'-'.date('YmdHisu'); //202102231701222635654

$target_file = $target_dir . $random . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri aki datoteka ima dejansko velikost
$check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }

  //check file size max 5 MB
  if ($_FILES["avatar"]["size"] > 5000000) {
    $uploadOk = 0;
  }

  
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}


//preverim, ali so podatki polni in ustrezni
if($uploadOk == 1) {

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        //zapiše se vse v bazo
        $query = "UPDATE users SET avatar=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$target_file,$id]);

        header("Location: profile.php?id=$id");
        die();
    
      } else {
        header("Location: profile.php?id=$id");
        die();
      }
    
}
else {
    header("Location: profile.php?id=$id");
    die();
}

?>