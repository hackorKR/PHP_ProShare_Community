<?php
session_start();
//db 파일 쓰는게 안됨 무슨 문제인지 모르겠음
$conn = mysqli_connect("localhost", "root", "Worth@5191", "ProShare");
//mysqli_select_db($conn, "Ex_board");

$username = $_POST['username'];
$password = $_POST['password'];

if($username == null || $password ==null){
    echo "<script>
    alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');
    history.back();</script>";
}

if($username != null){
    $user_check_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $check_result = mysqli_query($conn, $user_check_query);
    $check_user = mysqli_fetch_assoc($check_result);

    if($check_user == null){
        echo "<script>
        alert('아이디 혹은 비밀번호가 틀렸습니다.');
        history.back();</script>";
    }
    if($check_user != null){
        $password_hash = $check_user['password'];
        if(password_verify($password, $password_hash)){
            session_start();
            $_SESSION['username'] = $username;
            echo "<script>
            alert('로그인 성공!');
            location.href='../index.php';</script>";
        } else {
            echo "<script>
            alert('아이디 또는 비밀번호가 틀렸습니다.');
            history.back();</script>";
        }
    }
}





// if(!isset($_POST['login_user'])){
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password_1 = $_POST['password_1'];
//     $password_2 = $_POST['password_2'];
//     $count = 0;
//     // $password = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
//     // $password = password_hash($_POST['password_2'], PASSWORD_DEFAULT);

//     if(empty($username)) {};
//     if(empty($email)) {};
//     if(empty($password_1)) {};
//     if($password_1 != $password_2) { 
//         echo "<script>
//         alert('비밀번호가 일치하지 않습니다.');
//         history.back();</script>";
//         $count++;
//     };

//     //데이터베이스를 체크해서 같은 유저네임 혹은/그리고 이메일을 가진 사람 체크 
//     $user_check_query = "SELECT * FROM user WHERE username = $username OR email = $email LIMIT 1";
//     $check_result = mysqli_query($conn, $user_check_query);
//     $check_user = mysqli_fetch_assoc($check_result);

//     if($check_user != null) {
//         if($check_user['username'] === $username){
//             echo "<script>
//             alert('이미 같은 아이디가 존재합니다.');
//             history.back();</script>";
//             $count++;
//         }
//         if($check_user['email'] === $email){
//             echo "<script>
//             alert('이미 사용된 이메일입니다.');
//             history.back();</script>";
//             $count++;
//         }
//     }
//     if($count == 0){
//         $password = password_hash($password_1, PASSWORD_DEFAULT);
//         $query = "INSERT INTO user (username, email, password) VALUES ('".$username."','".$email."','".$password."')";
//         $result = mysqli_query($conn, $query);
//         if($result === true){
//             echo mysqli_error($conn);
//             echo "<script>
//             alert('회원가입이 완료되었습니다.');
//             location.href='../index.php';</script>";
//         }
//     }
// }
?>