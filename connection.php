<?php
$con=mysqli_connect("localhost","root","","hospital");
/*
//هنا لو ما نجح الاتصال على الداتا بيز 
if(!$con){
//حنعمل داي للكونكشين
    die("error connection ".mysqli_connect_error());
}
    //اذا نجح الاتصال بطبع انه تم الانشاء بنجاح
echo "created successfully";
//هنا بنقوم بانشاء داتا بيز اسمها هوسبيتال
$sql="create database Hospital";
//اذا تمت عملية الانشاء للداتا بيز حيطبع انها انشات 
if(mysqli_query($con,$sql)){
    echo "database created";
}else
//غير ذلك لو ما انتشات حيطبع انه ما انشات
    echo "database not created";
//بنعمل كلوز للكونكشين
mysqli_close($con);
*/
/*if(!$con){
    die("error connection ".mysqli_connect_error());
}
    //اذا نجح الاتصال على الداتا بيز حيطبع انه انشا بنجاح
echo "created successfully";
//حنعمل انشاء لجدول الاكتورز
$sql="create table actors (
//الاي دي نوعه انتجر برايمري كي اوتو انكرمت يعني بزيد لحاله
 id INT unsigned AUTO_INCREMENT PRIMARY KEY,
 //هان النيم بيكون نص اقصى حد لطوله255 ومش فاضية قيمته
 name VARCHAR(255) NOT NULL,
 //هنا الايميل بيكون نص ايضا الحد الاقصى لطوله  255 ومش فاضية قيمته
 email VARCHAR(255) UNIQUE NOT NULL,
 //وهان الباسوورد بيكون نص ايضا واقصى حد لطوله 255 ومش فاضية قيمته
 password VARCHAR(255) NOT NULL,
 //وهنا الفورن نمبر برضو بيكون ك نص واقصى حد لقيمته 255 ومش فاضية قيمته
 phone_number VARCHAR(255) NOT NULL,
 //التايب بتكون قيمته دكتور او بيشنت او فارمسي وقيمته مش فاضية
 type ENUM('doctor', 'patient', 'pharmacist') NOT NULL
)";
//اذا الجدول انشا حيطبع انه تم الانشاء بنجاح
if(mysqli_query($con,$sql)){
    echo "table created";
}else
//غير ذلك انه فشل انشاء التيبل 
    echo "table not created";
    //هان بنعمل كلوز للكونكشين
    mysqli_close($con);
*/
/*if(!$con){
    die("error connection ".mysqli_connect_error());
}
echo "created successfully";
//هنا ببنشا جدول الدكاترة
$sql="create table doctors (
//الاي دي بتكون قيمته مش سالبة وبتكون مش فاضية وبيكون انتجر ومفتاح اساسي في الجدول
 id INT unsigned AUTO_INCREMENT PRIMARY KEY,
 //هنا النيم بيكون نص واقصى طول اله 255 وقيمته مش فاضية
 name VARCHAR(255) NOT NULL,
 //هنا الايميل بيكون نص واقصى حد اله 255 وقيمته مش فاضية وبتكون قيمته وحيدة
 email VARCHAR(255) UNIQUE NOT NULL,
 //وهان باسوورد بيكون نص اقصى حد لطوله 255 وقيمته مش فاضية
 password VARCHAR(255) NOT NULL,
 //وهان الفون نمبر بيكون نص واقصى حد لطوله 15 وقيمته ليست فارغه
 phone_number VARCHAR(15) NOT NULL,
 //وهان بنحط مفتاح اجنبي من جدول الاكتور تمام بيكون انتجر ومش سالب 
 actor_id INT unsigned
)";
//لو الجدول انشا حيطبع انه الجدول نجح انشاؤه
if(mysqli_query($con,$sql)){
    echo "table created";
}else
//غير هيك ما انشا 
    echo "table not created";
    mysqli_close($con);
    */
    /*if(!$con){
        die("error connection ".mysqli_connect_error());
    }
    echo "created successfully";
    //هان بننشا جدول المريض
    $sql="create table patients(
    //الاي دي انتجر غير سالب وبزيد بالترتيب ومفتاح اساسي 
     id INT unsigned AUTO_INCREMENT PRIMARY KEY,
     //النيم بيكون نص اقصى طول 255 وقيمته ليست فارغه 
     name VARCHAR(255) NOT NULL,
     //الايميل بيكون نص اقصى طول الو 255 وبتكون قيمته وحيدة ومش فاضية 
     email VARCHAR(255) UNIQUE NOT NULL,
     //الباسوورد قيمته نصية اقصى طول الو 255 وقيمته مش فاضية
     password VARCHAR(255) NOT NULL,
     //العمر بيكون انتجر وقيمته ليست فارغة 
     age INT NOT NULL,
     //الجندر نص اقصى طول 10 ومش فاضية قيمتو
     gender VARCHAR(10) NOT NULL,
     //المشكلة بتكون ك تكست
     problem TEXT ,
     //الانترنس ديت بيكون نوعه تاريخ
     entranceDate DATE,
     //رقم الجوال نص اقصى طول الو 15 ومش فاضية قيمتو
     phone_number VARCHAR(15) NOT NULL
     //والاكتور اي دي هاده مفتاح اجنبي من جدول الاكتورز 
       actor_id INT unsigned

    )";
    if(mysqli_query($con,$sql)){
        echo "table created";
    }else
        echo "table not created";
        mysqli_close($con);
*/
/*if(!$con){
    die("error connection ".mysqli_connect_error());
}
echo "created successfully";
//هنا بننشا جدول الصيدلي
$sql="create table pharmacists(
الاي دي انتجر مش سالب ومفتاح اساسي
 id INT unsigned AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255) NOT NULL,
 email VARCHAR(255) UNIQUE NOT NULL,
 password VARCHAR(255) NOT NULL,
 phone_number VARCHAR(15) NOT NULL,
 //الاكتور اي دي مفتاح اجنبي 
  actor_id INT unsigned

)";
if(mysqli_query($con,$sql)){
    echo "table created";
}else
    echo "table not created";
    mysqli_close($con);
    */
    /*if(!$con){
        die("error connection ".mysqli_connect_error());
    }
    echo "created successfully";
    //بننشا جدول الادوية 
    $sql="create table drugs(
    الاي دي مفتاح اساسي 
     id INT unsigned AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) NOT NULL,
     dosage DOUBLE NOT NULL,
     productionDate DATE NOT NULL,
     expiryDate DATE NOT NULL


    )";
    if(mysqli_query($con,$sql)){
        echo "table created";
    }else
        echo "table not created";
        mysqli_close($con);
        
     */   /*if(!$con){
            die("error connection ".mysqli_connect_error());
        }
        echo "created successfully";
        //بننشا الجدول الوسيط بين الادوية والمريض 
        $sql = "create table patientdrug (
        //بنحط فيه اي دي مفتاح اساسي 
            id INT unsigned AUTO_INCREMENT PRIMARY KEY ,
            //وبنحط فيه رقم البيشنت
    patient_id INT unsigned NOT NULL ,
    //رقم الدوا 
    drug_id INT unsigned NOT NULL ,
    //وهذا البيشنت اي دي بيكون مفتاح اجنبي في هذا الجدول واصله اساسي في جدول المرضى
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    //ايضا رقم الدوا بيكون اجنبي في هذا الجدول واساسي في جدول الادوية
    FOREIGN KEY (drug_id) REFERENCES drugs(id)
)";
 
         if(mysqli_query($con,$sql)){
        echo "table created";
    }else
        echo "table not created";
        mysqli_close($con);
        
    */
       /* if(!$con){
            die("error connection ".mysqli_connect_error());
        }
        echo "created successfully";
        //هنا بننشا الجدول الوسيط بين الدكتور والمرسض
        $sql = "create table patientdoctor (
        //الاي دي بيكون مفتاح اساسي 
               id INT unsigned AUTO_INCREMENT PRIMARY KEY ,
    patient_id INT unsigned NOT NULL ,
    doctor_id INT unsigned NOT NULL ,
    //البيشنت اي دي مفتاح اجنبي في هاده الجدول واساسي في جدول البيشنت
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    والدكتر اي دي اجنبي في هذا الجدول واساسي في جدول الاطباء 
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
)";
        
     if(mysqli_query($con,$sql)){
        echo "table created";
    }else
        echo "table not created";
        mysqli_close($con);
    */   
?>