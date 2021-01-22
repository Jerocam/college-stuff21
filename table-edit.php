<!DOCTYPE html>
<?php
    require_once 'databases/dbconfig.php';

    $conn = dbConnect();
    
    if(count($_POST)>0){
        $prod_id = $_POST['prod_id'];
        $edit_fname = $_POST['fname2'];
        $edit_lname = $_POST['lname2'];
        $edit_email = $_POST['email2'];
        $edit_phone = $_POST['phone2'];
        $edit_prodname = $_POST['prodName2'];
        $edit_price = $_POST['prodPrice2'];
        $edit_desc = $_POST['prodDesc2'];
        $edit_categ = $_POST['prodCateg2'];

        //update image file
        $filename = $_FILES['prodImg2']['name'];
        $target_dir = "databases/upload/";
        $target_file = $target_dir . basename($_FILES["prodImg2"]["name"]);
        
        //query update data mysql
        mysqli_query($conn, "UPDATE products SET firstname='$edit_fname', lastname='$edit_lname', email='$edit_email', phone='$edit_phone', prod_name='$edit_prodname', prod_price='$edit_price', prod_description='$edit_desc', prod_category='$edit_categ', prod_image='$filename' WHERE id='$prod_id'");

        move_uploaded_file($_FILES['prodImg2']['tmp_name'], $target_dir.$filename);
        
        $message = "<div class='alert alert-success text-center alert-dismissible fade show' role='alert'><strong>Data updated Successfully!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

    }
        $result = mysqli_query($conn,"SELECT * FROM products WHERE id='" . $_GET['prod_id'] . "'");
        $row= mysqli_fetch_array($result);

    dbClose($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CollegeStuff</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="icon" href="images/favicon.ico">
    <link href="style.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-3 mb-lg-2">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container p-5 tablespace">
        <h2 class="mb-4">Editing the data</h2>
        <form action="" method="POST" class="row g-3 bg-dark text-white rounded p-3" enctype="multipart/form-data" id="formProduct2"> 
            <div><?php if(isset($message)) { echo $message; } ?></div>
            <input type="text" name="prod_id" value="<?php echo $row['id']; ?>" hidden>
            <div class="col-md-4 colStyle">
                <label for="fname2" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname2" name="fname2" placeholder="Jeronimo" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" value="<?php echo $row['firstname']; ?>" required>
            </div>
            <div class="col-md-4 colStyle">
                <label for="lname2" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lname2" name="lname2" placeholder="Ocampos" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" value="<?php echo $row['lastname']; ?>" required>
            </div>
            <div class="col-md-4 colStyle">
                <label for="email2" class="form-label">Email</label>
                <input type="email" class="form-control" id="email2" name="email2" placeholder="name@example.com" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="col-md-4 colStyle">
                <label for="phone2" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone2" name="phone2" placeholder="(555)555-5555" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" value="<?php echo $row['phone']; ?>" required>
            </div>
            <div class="col-md-5 colStyle">
                <label for="prodName2" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="prodName2" name="prodName2" placeholder="Super Mario Bros" value="<?php echo $row['prod_name']; ?>" required>
            </div>
            <div class="col-md-3 colStyle">
                <label for="prodPrice2" class="form-label">Product Price</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">$</span>
                    <input type="text" class="form-control" id="prodPrice2" name="prodPrice2" aria-describedby="inputGroupPrepend" placeholder="99.99" pattern="^(?!0\.00)\d{1,9}(,\d{9})*(\.\d\d)?$" value="<?php echo $row['prod_price']; ?>" required>
                </div>
            </div>
            <div class="col-md-4 colStyle">
                <label for="prodCateg2" class="form-label">Choose a category</label>
                <?php
                    $selected = $row['prod_category'];
                    $options = array('Automotive', 'Books', 'Clothing', 'Electronic', 'Furniture', 'Others');
                    echo "<select class='form-select' id='prodCateg2' name='prodCateg2' required>";
                    foreach($options as $option){
                        if($selected == $option){
                            echo "<option selected='selected' value='$option'>$option</option>";
                        }
                        else{
                            echo "<option value='$option'>$option</option>";
                        }
                    }
                    echo "</select>";
                ?> 
            </div>
            <div class="col-md-5 colStyle">
                <label for="prodDesc2" class="form-label">Product Description</label>
                <textarea rows="1" class="form-control" id="prodDesc2" name="prodDesc2" aria-describedby="inputGroupPrepend" placeholder="Write a product detail" required><?php echo $row['prod_description']; ?></textarea>
            </div>
            <div class="col-md-3 colStyle">
                <label for="prodImg2" class="form-label">Upload a picture</label>
                <input class="form-control" type="file" id="prodImg2" name="prodImg2" accept="image/gif, image/jpeg, image/png" value="<?php echo $row['prod_image']; ?>" required>
            </div>
            <div class="col-md-12 mb-3 colStyle">
                <div class="text-center">
                    <button class="btn btn-success btn-lg" type="submit">Update</button>
                    <a href="table.html"><button class="btn btn-danger btn-lg" type="button">Cancel</button></a> 
                </div>
            </div>
        </form>
    </div>

    <footer class="text-white bg-dark p-3">
        <div class="container">
            <p class="text-center">CollegeStuff.com. All Rights Reserved &copy; 2021</p>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>