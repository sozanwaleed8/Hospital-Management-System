<?php
//بنشغل الجلسة 
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//هان بنفحص اذا المصفوفة جيت فيها الاي دي
if (isset($_GET['id'])) {
    //بياخد قيمة الاي دي من المصفوفة جيت وبيخزنها في متغير
    $patient_id = $_GET['id'];
    // $patient_id استعلام بيجيب كل الأعمدة من جدول البيشنت للمريض اللي الاي دي  تبعه هو
    $sql = "SELECT * FROM patients WHERE id = ?";
    //هان بنجهز الاستعلام
    $stmt = $con->prepare($sql);
    // بيربط قيمة البيشنت اي دي .بالاستعلام
    $stmt->bind_param("i", $patient_id);
    //بيشغل الاستعلام على قاعدة البيانات.
    $stmt->execute();
    //بياخد نتيجة الاستعلام
    $result = $stmt->get_result();
    //يتأكد إذا النتيجة فيها صفوف (يعني المريض موجود).
    if ($result->num_rows > 0) {
        //Associative Array.لو فيه صفوف، بياخد أول صف وبيحوله لمصفوفة 
        $patient = $result->fetch_assoc();
    } else {
        //لو ما فيه صفوف (المريض مش موجود)، بيعرض رسالة 

        die("Patient not found.");
    }
} else {
    //لو ما فيه اي دي أصلاً، بيعرض رسالة 
    die("Invalid request.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/addP.webp'); 
            background-size: cover;
            background-position: top; 
            background-repeat: no-repeat; 
            height: 100vh; 
            display: flex;
            align-items: center; 
            justify-content: center; 
        }

        .container {
    max-width: 600px;
    background: rgba(255, 255, 255, 0.9);
    padding: 10px; 
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: -50px;

    transform: translateX(-500px);
}


        h1 {
            color: #1DA1F2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control, .btn {
            height: 45px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #1DA1F2;
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
        }

        .btn-primary:hover {
            background-color: #007ACC;
        }
        .mt-3 {
            background-color: #1DA1F2;
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center;
                color:rgb(255, 255, 255);

}.mt-3:hover {
    background-color: #007ACC;
    color:rgb(255, 255, 255);

}

    </style>
</head>
<body>
    <div class="container">
        <h1>Update Patient</h1>
        <form action="updatePatient_logic.php" method="POST" class="mt-4">
            <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
            <div class="mb-3">
                <label for="new_patient_name" class="form-label">Patient Name</label>
                <input type="text" name="new_patient_name" id="new_patient_name" placeholder="Enter Patient Name" value="<?php echo htmlspecialchars($patient['name']); ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="new_email" class="form-label">Patient Email</label>
                <input type="email" name="new_email" id="new_email" placeholder="Enter Patient Email" value="<?php echo htmlspecialchars($patient['email']); ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="new_age" class="form-label">Age</label>
                <input type="number" name="new_age" id="new_age" placeholder="Enter Age" value="<?php echo htmlspecialchars($patient['age']); ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
            <div style="display: flex; gap: 10px; align-items: center;">
            <div>
               <input type="radio" name="new_gender" id="gender_male" value="Male" 
                <?php echo ($patient['gender'] === 'Male') ? 'checked' : ''; ?>>
               <label for="gender_male">Male</label>
        </div>
        <div>
            <input type="radio" name="new_gender" id="gender_female" value="Female" 
                <?php echo ($patient['gender'] === 'Female') ? 'checked' : ''; ?>>
            <label for="gender_female">Female</label>
        </div>
    </div>
   </div>

            <div class="mb-3">
                <label for="new_problem" class="form-label">Problem</label>
                <input type="text" name="new_problem" id="new_problem" placeholder="Enter Problem" value="<?php echo htmlspecialchars($patient['problem']); ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="new_intranceDate" class="form-label">Entrance Date</label>
                <input type="date" name="new_intranceDate" id="new_intranceDate" value="<?php echo htmlspecialchars($patient['entranceDate']); ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="new_phonenumber" class="form-label">Phone Number</label>
                <input type="text" name="new_phonenumber" id="new_phonenumber" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($patient['phone_number']); ?>" class="form-control">
            </div>
            <button type="submit" name="update_patient" class="btn btn-primary w-100">Update Patient</button>
        </form>
        <a href="dashboardUi.php" class="btn btn-info mt-3">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>

    </div>
</body>
</html>
