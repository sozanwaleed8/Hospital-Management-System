<?php
session_start(); // بفتح السيشن عشان أقدر أستخدم بيانات المستخدم اللي سجل دخول
$id = $_SESSION["authUser"]["id"]; // بخزن رقم المستخدم الحالي من السيشن
include "connection.php"; // بربط الكود مع قاعدة البيانات
$sql = "SELECT * FROM drugs"; // استعلام SQL عشان يجيب كل الأدوية من جدول drugs
$result = $con->query($sql); // بننفذ الاستعلام وبنخزن النتيجة
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Drugs</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-image: url('images/wb.webp');
                background-size: cover;
                background-position: bottom;
                background-repeat: no-repeat;
                height: 100vh;
                color: #333;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                background: rgba(255, 255, 255, 0.95);
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                width: 100%;
                margin-top: -400px;

            }
            .table {
                text-align: center;
                margin-top: 20px;
            }
            thead {
                background-color: rgb(219, 115, 173); 
                color: white; 
            }
            .table th, .table td {
                vertical-align: middle;
            }
            .btn-primary {
                background-color: rgb(219, 115, 173); 
                border: none;
            }
            .btn-primary:hover {
                background-color: rgb(174, 36, 119);
            }
            .btn-danger {
                background-color: #E3342F;
            }
            .btn-danger:hover {
                background-color: #c82333;
            }
            .alert {
                margin-bottom: 20px;
                text-align: center;
                font-weight: bold;
            }
            h1 {
                text-align: center;
                color: rgb(219, 115, 173); 
                font-weight: bold;
                margin-bottom: 20px;
            }
            .btn-info{
                background-color:rgb(219, 115, 173); 
                color: white;
                margin-left: 1100px; 
 

            }
            .btn-info:hover {
            background-color:rgb(180, 39, 121);
            color: white; 

        }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Drugs List</h1>
            <?php
            // بفحص إذا تم حذف دواء بناءً على قيمة الـ GET
          if (isset($_GET["deleted"]) && $_GET["deleted"] == "true") { 
               echo "<div class='alert alert-success'>Drug deleted successfully.</div>"; // رسالة نجاح الحذف
                    }

                   // بفحص إذا تم إنشاء دواء بناءً على قيمة الـ GET
               if (isset($_GET["created"]) && $_GET["created"] == "true") { 
          echo "<div class='alert alert-success'>Drug created successfully.</div>"; // رسالة نجاح الإنشاء
}

             // بفحص إذا تم تعديل دواء بناءً على قيمة الـ GET
               if (isset($_GET["updated"]) && $_GET["updated"] == "true") { 
                echo "<div class='alert alert-success'>Drug updated successfully.</div>"; // رسالة نجاح التعديل
}
?>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Dosage</th>
                        <th>Production Date</th>
                        <th>Expiry Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                <?php
if ($result->num_rows != 0) { // بفحص إذا فيه بيانات (نتائج) بالاستعلام
    while ($row = $result->fetch_assoc()) { // حلقة تمر على كل صف من النتائج
        $id = $row['id']; // بخزن رقم الـ ID الخاص بالصف الحالي
?>
                            <tr>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["dosage"]; ?></td>
                                <td><?php echo $row["productionDate"]; ?></td>
                                <td><?php echo $row["expiryDate"]; ?></td>
                                <td>                               
                                        <a href="<?php echo 'updateDrug.php?id=' . $id; ?>" class="btn btn-primary btn-sm">Update</a>
                                    <a href="deleteDrug.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php
    } // نهاية حلقة الـ while
} else { // إذا ما فيه بيانات بالنتائج
    echo "<tr><td colspan='5' class='text-danger'>No drugs found.</td></tr>"; // عرض رسالة في حالة عدم وجود أدوية
}
?>

                </tbody>
            </table>
            <a href="dashboardUi.php" class="btn btn-info">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>

        </div>
    </body>
</html>
