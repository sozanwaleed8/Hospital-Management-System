<?php
include "connection.php"; // الاتصال بقاعدة البيانات

// دالة لتنظيف البيانات المدخلة من المستخدم
function validateData($data) {
    $data = trim($data); // إزالة المسافات الإضافية
    $data = htmlspecialchars($data); // تحويل المدخلات لشكل آمن
    return $data;
}

if ($con->error == false) { // فحص إذا الاتصال بقاعدة البيانات ناجح
    if (isset($_POST["create_account"])) { // فحص إذا المستخدم ضغط زر "إنشاء الحساب"
        $name = validateData($_POST["name"]); // تنظيف الاسم
        $email = validateData($_POST["email"]); // تنظيف الإيميل
        $password = password_hash(validateData($_POST["password"]), PASSWORD_BCRYPT); // تنظيف وتشفيير الباسوورد
        $phonenumber = $_POST["phonenumber"]; // رقم الهاتف
        $type = $_POST["type"]; // نوع المستخدم

        // التحقق من وجود أي حقل فاضي
        if (empty($name) || empty($email) || empty($password) || empty($phonenumber) || empty($type)) {
            header("Location: register.php"); // إذا في حقل فاضي، برجع المستخدم لصفحة التسجيل
        } else {
            // استعلام لإضافة الحساب في جدول actors
            $sql = "INSERT INTO actors(name, email, password, phone_number, type) VALUES ('$name', '$email', '$password', '$phonenumber', '$type')";
            $result = $con->query($sql);
        }

        if ($result == true) { // إذا الإضافة نجحت
            $actor_id = $con->insert_id; // الحصول على ID المستخدم اللي أضيف

            // إضافة المستخدم حسب نوعه
            if ($type == "doctor") {
                $doctorSql = "INSERT INTO doctors (name, email, password, phone_number, actor_id) VALUES ('$name', '$email', '$password', '$phonenumber', '$actor_id')";
                $con->query($doctorSql);
            } else if ($type == "pharmacist") {
                $pharmacistSql = "INSERT INTO pharmacists (name, email, password, phone_number, actor_id) VALUES ('$name', '$email', '$password', '$phonenumber', '$actor_id')";
                $con->query($pharmacistSql);
            }

            // التوجيه لصفحة التسجيل مع رسالة نجاح
            header("Location: register.php?statusCode=201");
        } else {
            echo "fail"; // إذا فشلت الإضافة
        }
    }
}
?>
