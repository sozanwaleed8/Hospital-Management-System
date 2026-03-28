<?php
//لبدء الجلسة واسترجاع بيانات المستخدم الحالي.
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//يتم الحصول على الاكتور اي دي للطبيب 
$actor_id = $_SESSION["authUser"]["id"];
//باستخدام الاكتور اي دي يتم جلب الدكتور اي دي  من جدول الدكتور
$doctor_id = $con->query("SELECT id FROM doctors WHERE actor_id = $actor_id")->fetch_assoc()['id'];
//يبحث عن المرضى الذين لديهم طبيب (في جدول البيشنت دكتور يعني الوسيط)ولديهم أدوية (في جدول البيشنت درج) ويعرض فقط المرضى المرتبطين بالطبيب يلي الو اي دي اسمه دكتور اي دي

$patientResult = $con->query("
    SELECT DISTINCT p.id, p.name 
    FROM patients p 
    INNER JOIN patientdoctor pd ON p.id = pd.patient_id 
    INNER JOIN patientdrug pdrug ON p.id = pdrug.patient_id
    WHERE pd.doctor_id = $doctor_id
");

$drugResult = null;
// عندما يحدد المستخدم مريضًا، يتم جلب قائمة الأدوية التي تم إسنادها لهذا المريض من جدول البيشنت درج
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];
    $drugResult = $con->query("
        SELECT d.id, d.name 
        FROM drugs d
        INNER JOIN patientdrug pd ON d.id = pd.drug_id
        WHERE pd.patient_id = $patient_id
    ");
}
//عند الضغط على زر ان ساين درج، يتم حذف السجل من جدول  باستخدام البيشنت دج باستخدام البيشنت اي دي والدرج اي دي ويتم عرض رسالة نجاح أو خطأ بناءً على نتيجة العملية.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_drug'])) {
    $patient_id = $_POST['patient_id'];
    $drug_id = $_POST['drug_id'];
    header("Location:viewPatients.php");

    $deleteResult = $con->prepare("
        DELETE FROM patientdrug 
        WHERE patient_id = ? AND drug_id = ?
    ");
    $deleteResult->bind_param("ii", $patient_id, $drug_id);
    $success_message = $deleteResult->execute() ? "Drug unassigned successfully." : "Error unassigning drug.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unassign Drug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/deleteA.webp');
            background-size: cover;
            background-position: bottom;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            margin-left: 1000px;
            margin-top: 250px;


        }
        h1 {
            color: #f05151;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label, .btn {
            font-weight: bold;
        }
        .btn-danger {
            background-color: #E3342F;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-info {
            margin-left: 350px; 
            background-color: #E3342F;
            color:rgb(255, 255, 255);
            margin-bottom: 20px; 
        }  .btn-info:hover {
            background-color:rgb(148, 13, 26);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Unassign Drug from Patient</h1>
        <a href="dashboardUi.php" class="btn btn-info mt-3">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>
        <?php 
        // عرض رسالة النجاح (إن وجدت)
        if (isset($success_message)): ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="patient_id" class="form-label">Select Patient</label>
                <select name="patient_id" id="patient_id" class="form-select" onchange="this.form.submit()" required>
                    <option value="">Select Patient</option>
                    <?php 
                    //يقوم بجلب كل صف (مريض) من نتيجة استعلام قاعدة البيانات كصفوف متكررة.
                    while ($row = $patientResult->fetch_assoc()): ?>
                        <option value="<?php 
                        //تعيين قيمة اي دي المريض لاستخدامها عند إرسال النموذج وعرض اسم المريض في القائمة.وهذا  يتحقق إذا كان المريض الحالي هو المريض المختار مسبقًا ويجعل الخيار "محددًا" 
                        echo $row['id']; ?>" <?php echo isset($patient_id) && $patient_id == $row['id'] ? 'selected' : ''; ?>>
                            <?php echo $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </form>

        <?php if ($drugResult): ?>
            <form method="POST">
                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                <div class="mb-3">
                    <label for="drug_id" class="form-label">Assigned Drugs</label>
                    <select name="drug_id" id="drug_id" class="form-select" required>
                        <option value="">Select Drug</option>
                        <?php 
                    // بيلف على كل دواء جابه من قاعدة البيانات ويجيب بيانات كل دواء اي دي واسم على شكل مصفوفة.
                        while ($row = $drugResult->fetch_assoc()): ?>
                            <option value="<?php
                            //القيمة اللي بتنرسل لما تختار الدواء عبارة عن اي دي الدواء.وكمان بيعرض اسم الدواء اللي بيظهر للمستخدم في القائمة.
                            echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" name="delete_drug" class="btn btn-danger w-100">Unassign Drug</button>
            </form>
          
        <?php endif; ?>
    </div>
</body>
</html>
