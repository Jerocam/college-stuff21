<?php
    
    require_once('dbconfig.php');

    $conn = dbConnect();

    if(isset($_POST['id'])){
        $del_data = $_POST['id'];
    }

    $sql = "DELETE FROM products WHERE id='$del_data'";

    mysqli_query($conn, $sql);

    $output = "
        <div id='delStyle'>
            <div class='alert alert-danger text-center' role='alert'><strong><i class='fas fa-minus-circle fa-2x'></i> Data deleted successfully!</strong> 
            </div>
            <div class='text-center'>
                <a class='btn btn-info btn-lg' href='table.html' role='button'>Return to table</a>
            </div>
        </div>
        ";

    echo $output; 

    dbClose($conn);

?>