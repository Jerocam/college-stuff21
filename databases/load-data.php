<?php

    require_once('dbconfig.php');

    $conn = dbConnect();

    $limit = 8;

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

        $output.="<div class='row row-cols-1 row-cols-md-4 g-3'>";

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
        $load_image = $row['prod_image'];

        $output.= '
                <div class="col">
                        <div class="card h-100 bg-dark shadow">
                            <img src="databases/upload/'.$load_image.'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-white">'.$load_prodname.'</h5>
                                <p class="card-text text-white">'.$load_desc.'</p>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ID'.$load_id.'" >More info</button>
                                <div class="modal fade" id="ID'.$load_id.'" tabindex="-1" aria-labelledby="'.$load_id.'ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content bg-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="'.$load_id.'ModalLabel">Production Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <img src="databases/upload/'.$load_image.'" class="img-fluid shadow rounded" alt="img">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <h6>Contact Info</h6>
                                                        <p><i class="material-icons">account_box</i> '.$load_fname.' '.$load_lname.'</p>
                                                        <p><i class="material-icons">email</i> '.$load_email.'</p>
                                                        <p><i class="material-icons">call</i> '.$load_phone.'</p>
                                                        <hr>
                                                        <h6>Product Info</h6>
                                                        <p><i class="material-icons">production_quantity_limits</i> '.$load_prodname.'</p>
                                                        <p><i class="material-icons">monetization_on</i> '.$load_price.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Added - '.$row["red_date"].'</small>
                            </div>
                        </div>
                </div>
            ';
        }
        $output.="</div>";
    

    $sql_page = "SELECT * FROM products";
    $records = mysqli_query($conn, $sql_page);
    $total_records = mysqli_num_rows($records);
    $total_pages = ceil($total_records/$limit);

    $output.="<nav class='pt-4' aria-label='Page navigation'>";

    $output.="<ul class='pagination pagStyle justify-content-center'>";
    
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