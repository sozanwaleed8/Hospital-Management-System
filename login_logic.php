<?php
session_start(); // بفتح السيشن عشان نخزن بيانات المستخدم بعد تسجيل الدخول
include "connection.php"; // بنربط الكود مع قاعدة البيانات

if($con->error == false) { // بفحص إذا الاتصال بقاعدة البيانات ناجح
    if(isset($_POST["login"])) { // بفحص إذا المستخدم ضغط زر تسجيل الدخول
        $email = $_POST["email"]; // بخزن الإيميل اللي أدخله المستخدم
        $password = $_POST["password"]; // بخزن الباسوورد اللي أدخله المستخدم

        if(empty($email) || empty($password)) { // بفحص إذا الإيميل أو الباسوورد فارغ
            header("Location: login.php"); // برجّع المستخدم لصفحة تسجيل الدخول
        } else {
            $sql = "SELECT * FROM actors WHERE email='$email'"; // استعلام عشان نجيب بيانات المستخدم اللي عنده نفس الإيميل
            $result = $con->query($sql); // بننفذ الاستعلام
        }

        if($result->num_rows > 0) { // إذا وجدنا بيانات للمستخدم
            $data = $result->fetch_assoc(); // بنجيب أول صف من البيانات
            if(password_verify($password, $data["password"])) { // بفحص إذا الباسوورد صحيح
                $_SESSION["authUser"] = $data; // بخزن بيانات المستخدم في السيشن
                header("Location: dashboardUi.php"); // بنوجه المستخدم للوحة التحكم
            } else {
                echo "Login Fail"; // رسالة فشل تسجيل الدخول (باسوورد غلط)
            }
        } else {
            echo "Login Fail"; // رسالة فشل تسجيل الدخول (الإيميل مش موجود)
        }
    }
}
?>

