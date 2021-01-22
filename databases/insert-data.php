<?php
    include('dbconfig.php');

    $conn = dbConnect();

    $filename = $_FILES['prodImg']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["prodImg"]["name"]);

    $new_data = "INSERT INTO products (firstname, lastname, email, phone, prod_name, prod_price, prod_description, prod_category, prod_image) VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[phone]', '$_POST[prodName]', '$_POST[prodPrice]', '$_POST[prodDesc]', '$_POST[prodCateg]', '$filename')";
    
    mysqli_query($conn, $new_data);
    
    move_uploaded_file($_FILES['prodImg']['tmp_name'], $target_dir.$filename);
    
    dbClose($conn);
?>