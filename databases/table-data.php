<?php

    require_once('dbconfig.php');

    $conn = dbConnect();

    $limit = 9;

    if(isset($_POST['page_number'])){
        $page = $_POST['page_number'];
    }
    else {
        $page = 1;
    }
    
    $ready_page = ($page-1) * $limit;

    $sql = "SELECT * FROM products LIMIT $ready_page, $limit";

    $result = mysqli_query($conn, $sql);

    $output = "";

    if(mysqli_num_rows($result)>0){

        $output.="<table class='table table-striped caption-top'><caption>List of products</caption>";

        $output.=" <thead>
        <tr>
            <th scope='col'>ID</th>
            <th scope='col'>First Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Email</th>
            <th scope='col'>Phone</th>
            <th scope='col'>Product Name</th>
            <th scope='col'>Price $</th>
            <th scope='col'>Description</th>
            <th scope='col'>Category</th>
            <th scope='col'>Date Added</th>
            <th scope='col'>Actions</th>
        </tr>
        </thead>
        <tbody>";

        while($row = mysqli_fetch_assoc($result)){

        $load_id = $row['id']; 
        $load_fname = $row['firstname'];
        $load_lname = $row['lastname'];
        $load_email = $row['email'];
        $load_phone = $row['phone'];
        $load_prodname = $row['prod_name'];
        $load_price = $row['prod_price'];
        $load_desc = $row['prod_description'];
        $load_categ = $row['prod_category'];
        $load_date = $row['red_date'];
        $load_image = $row['prod_image'];

        $output.= '
                    <tr>
                        <th scope="row">'.$load_id.'</th>
                        <td>'.$load_fname.'</td>
                        <td>'.$load_lname.'</td>
                        <td>'.$load_email.'</td>
                        <td>'.$load_phone.'</td>
                        <td>'.$load_prodname.'</td>
                        <td>'.$load_price.'</td>
                        <td>'.$load_desc.'</td>
                        <td>'.$load_categ.'</td>
                        <td>'.$load_date.'</td>
                        <td class="buttonData">
                            <button type="button" class="btn btn-danger" id="'.$load_id.'">Delete</button>
                            <a href="table-edit.php?prod_id='.$load_id.'"><button type="button" class="btn btn-primary">Edit</button></a> 
                        </td>
                    </tr>
                
            ';
        }

        $output.="</tbody></table>";
    
    $sql_page = "SELECT * FROM products";
    $records = mysqli_query($conn, $sql_page);
    $total_records = mysqli_num_rows($records);
    $total_pages = ceil($total_records/$limit);

    $output.="<nav class='pt-4' aria-label='Page navigation'>";

    $output.="<ul class='pagination justify-content-center'>";
    
    for ($i=1; $i<=$total_pages; $i++){
        if($i == $page){
            $active = "active";
        }
        else {
            $active = "";
        }

        $output.="<li class='page-item $active'><a class='page-link' href='' id='$i'>$i</a></li>";
    }

    $output.="</ul>";

    $output.="</nav>";

    echo $output;
    
    } 

    dbClose($conn);

?>