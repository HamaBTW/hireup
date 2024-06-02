<?php

require_once __DIR__ . '/../../../Controller/user_con.php';
require_once __DIR__ . '/../../../Controller/faces_con.php';
require_once __DIR__ . '/../../../Model/faces.php';


if (session_status() == PHP_SESSION_NONE) {
  session_set_cookie_params(0, '/', '', true, true);
  session_start();
}

$userC = new userCon("user");
$faceC = new FaceController();

$face = null;

if(isset($_SESSION['user id'])) {

    $user_id = htmlspecialchars($_SESSION['user id']);

    $current_user = $userC->getUser($user_id);

    // Get the image data
    $imageData = file_get_contents($_FILES['face_image']['tmp_name']);

    $face = new Face(
        $faceC->generateFaceId(6),
        $user_id,
        $imageData,
        $current_user['user_name'],
    );
  
    $faceC->addFace($face);
}


?>