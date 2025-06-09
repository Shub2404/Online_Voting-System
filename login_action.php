<?php
session_start();
include "connection.php"; 

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, addslashes($_POST["username"]));
    $password = mysqli_real_escape_string($con, addslashes($_POST["password"]));
    $face_image_data = $_POST['face_image'] ?? '';

    $sql = mysqli_query($con, 'SELECT * FROM loginusers WHERE username="'.$username.'" AND password="'.md5($password).'" AND status="ACTIVE"');

    if (mysqli_num_rows($sql) > 0) {
        $member = mysqli_fetch_assoc($sql);

        // ===== Face++ Face Matching =====
        $registered_image = 'faces/' . $username . '.jpg';
        $temp_login_image = 'temp_login.jpg';

        if (!$face_image_data || !file_exists($registered_image)) {
            $error = "<center><h4><font color='red'>Missing face image or registration photo.</font></h4></center>";
            include "login.php";
            exit();
        }

        $face_image_data = str_replace('data:image/jpeg;base64,', '', $face_image_data);
        $face_image_data = str_replace(' ', '+', $face_image_data);
        file_put_contents($temp_login_image, base64_decode($face_image_data));

        $api_key = 'HOWRNQOV3GvvAQrj4TDzUXVQyUuJuFgx';
        $api_secret = 'rlwncNu3cjldIgDTAQRWaTYyXIev_-XF';

        $post_fields = [
            'api_key' => $api_key,
            'api_secret' => $api_secret,
            'image_file1' => new CURLFile($registered_image),
            'image_file2' => new CURLFile($temp_login_image)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-us.faceplusplus.com/facepp/v3/compare');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $response = curl_exec($ch);
        curl_close($ch);

        unlink($temp_login_image);

        $result = json_decode($response, true);

        if (isset($result['confidence']) && $result['confidence'] > 75) {
            // Face matched — login success
            $_SESSION['SESS_NAME'] = $member['username'];
            $_SESSION['SESS_RANK'] = $member['rank'];

            if ($member['rank'] == 'administrator') {
                header("location: admin.php");
            } else {
                header("location: voter.php");
            }
            exit();
        } else {
            $error = "<center><h4><font color='red'>Face does not match our records.</font></h4></center>";
            include "login.php";
            exit();
        }

    } else {
        $error = "<center><h4><font color='red'>Incorrect Username or Password</font></h4></center>";
        include "login.php";
    }

} else {
    $error = "<center><h4><font color='red'>Invalid Login Request</font></h4></center>";
    include "login.php";
}
?>
