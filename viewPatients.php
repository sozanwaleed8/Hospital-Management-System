<?php 
session_start(); // بفتح السيشن عشان نقدر نستخدم بيانات المستخدم اللي سجل دخول
include "connection.php"; // بربط الكود مع قاعدة البيانات
$type = $_SESSION["authUser"]["type"]; // بنجيب نوع المستخدم من السيشن
$actor_id = $_SESSION["authUser"]["id"]; // بنجيب رقم المستخدم من السيشن

if ($type === "doctor") { // إذا المستخدم دكتور
    $doctorQuery = "SELECT id FROM doctors WHERE actor_id = $actor_id"; // استعلام يجيب رقم الدكتور
    $doctorResult = $con->query($doctorQuery); // بننفذ الاستعلام

    if ($doctorResult && $doctorResult->num_rows > 0) { // إذا وجدنا الدكتور
        $doctorRow = $doctorResult->fetch_assoc();
        $doctor_id = $doctorRow["id"]; // بنخزن رقم الدكتور

        // استعلام يجيب المرضى اللي الدكتور مسؤول عنهم مع أسماء الأدوية الموصوفة لكل مريض
        $sql = "SELECT p.*, 
                        GROUP_CONCAT(d.name SEPARATOR ', ') AS assigned_drugs
                FROM patients p
                INNER JOIN patientdoctor pd ON p.id = pd.patient_id
                LEFT JOIN patientdrug pdg ON p.id = pdg.patient_id
                LEFT JOIN drugs d ON pdg.drug_id = d.id
                WHERE pd.doctor_id = ?
                GROUP BY p.id";
        $stmt = $con->prepare($sql); // بنجهز الاستعلام
        $stmt->bind_param("i", $doctor_id); // بنربط رقم الدكتور
        $stmt->execute(); // بننفذ الاستعلام
        $result = $stmt->get_result(); // بنجيب النتيجة
    } else { 
        die("Doctor ID not found."); // إذا ما لقينا الدكتور بنوقف
    }
} elseif ($type === "patient") { // إذا المستخدم مريض
    // استعلام يجيب بيانات المريض مع الأدوية الموصوفة
    $sql = "SELECT p.*, 
                    GROUP_CONCAT(d.name SEPARATOR ', ') AS assigned_drugs
            FROM patients p
            LEFT JOIN patientdrug pdg ON p.id = pdg.patient_id
            LEFT JOIN drugs d ON pdg.drug_id = d.id
            WHERE p.actor_id = ?
            GROUP BY p.id";
    $stmt = $con->prepare($sql); // بنجهز الاستعلام
    $stmt->bind_param("i", $actor_id); // بنربط رقم المريض
    $stmt->execute(); // بننفذ الاستعلام
    $result = $stmt->get_result(); // بنجيب النتيجة
} else { 
    die("Unauthorized access."); // إذا المستخدم مش دكتور ولا مريض بنوقف
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/vie.webp');
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            height: 100vh;
            color: #fff;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 1500px;
        }
        .table {
            border-collapse: collapse;
        }
        thead {
            background-color: rgb(127, 141, 155);
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background-color: rgb(94, 176, 227);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(20, 134, 210);
        }
        .btn-danger:hover {
            background-color:rgb(54, 5, 3);
        }
        .custom-heading {
            color: rgb(130, 150, 173);
            font-weight: bold;
        }
        .btn-info{
                background-color:rgb(127, 141, 155);
                color: white; 
                margin-left: 1285px; 


            } .btn-info:hover {
            background-color:rgba(206, 195, 195, 0.45);
        }
    </style>
</head>
<body>
    <div class="container mt-5 p-4">
        <h1 class="text-center custom-heading mb-4">Patients List</h1>
        <table class="table table-bordered table-hover table-striped text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Problem</th>
                    <th>Entrance Date</th>
                    <th>Phone Number</th>
                    <th>Assigned Drug Name</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
            <?php
if ($result->num_rows > 0) { // إذا وجدنا بيانات مرضى
    while ($row = $result->fetch_assoc()) { ?> <!-- بنمر على كل مريض -->
        <tr>
            <td><?php echo $row["name"]; ?></td> <!-- اسم المريض -->
            <td><?php echo $row["email"]; ?></td> <!-- إيميل المريض -->
            <td><?php echo $row["password"]; ?></td> <!-- كلمة مرور المريض -->
            <td><?php echo $row["age"]; ?></td> <!-- عمر المريض -->
            <td><?php echo $row["gender"]; ?></td> <!-- جنس المريض -->
            <td><?php echo $row["problem"]; ?></td> <!-- المشكلة الصحية -->
            <td><?php echo $row["entranceDate"]; ?></td> <!-- تاريخ دخول المستشفى -->
            <td><?php echo $row["phone_number"]; ?></td> <!-- رقم الهاتف -->
            <td>
                <?php echo $row["assigned_drugs"] ? $row["assigned_drugs"] : "No drugs assigned"; ?> <!-- الأدوية الموصوفة -->
            </td>
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <?php if ($type == "doctor") { ?> <!-- إذا المستخدم دكتور -->
                        <a href="updatePatient.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary btn-sm">Update</a> <!-- زر تعديل -->
                        <a href="deletePatient.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm">Delete</a> <!-- زر حذف -->
                    <?php } elseif ($type == "patient" && $_SESSION["authUser"]["id"] == $row["actor_id"]) { ?> <!-- إذا المستخدم مريض ويعدل بياناته -->
                        <a href="updatePatient.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary btn-sm">Update</a> <!-- زر تعديل -->
                    <?php } ?>
                </div>
            </td>
        </tr>
    <?php }
} else { // إذا ما وجدنا بيانات مرضى
    echo "<tr><td colspan='10' class='text-center text-danger'>No patients found.</td></tr>"; // رسالة إذا ما فيه مرضى
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
