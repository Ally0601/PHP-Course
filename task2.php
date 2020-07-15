<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Task 2</title>
</head>
<body>
    <?php
        $product_id = $product_name = $product_description = $product_price = "";
        $product_idErr = $product_nameErr = $product_descriptionErr = $product_priceErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (empty($_POST["product_id"]))
                $product_idErr = "Required";
            else
                $product_id = test_input($_POST["product_id"]);

            if (empty($_POST["product_name"]))
                $product_nameErr = "Required";
            else
                $product_name = test_input($_POST["product_name"]);

            if (empty($_POST["product_price"]))
                $product_priceErr = "Required";
            else
                $product_price = test_input($_POST["product_price"]);
         
            if (empty($_POST["product_description"])) 
                $product_descriptionErr = "Required";
            else
                $product_description = test_input($_POST["product_description"]);
        }

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        function addData($product_id, $product_name, $product_price, $product_description){
            $servername = "localhost";
            $username = "user";
            $dbname = "php_course";
            $conn = new mysqli($servername, $username, "", $dbname);
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
                echo "Connection error";
            }

            $sql = "UPDATE product_catalog SET product_name='$product_name' , product_price='$product_price' , product_description='$product_description'
                    WHERE product_id = '$product_id'";
            $query = mysqli_query($conn,$sql);

            if(!$query)
            {
                $sql = "INSERT INTO product_catalog (product_id, product_name, product_price, product_description)
                VALUES ('$product_id', '$product_name', '$product_price', '$product_description')";
                if ($conn->query($sql) === TRUE)
                    echo "New record created successfully";
                else 
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
            else
            {
                $sql = "UPDATE product_catalog SET product_name='$product_name' , product_price='$product_price' , product_description='$product_description'
                    WHERE product_id = '$product_id'";
                if ($conn->query($sql) === TRUE)
                    echo "Record updated successfully";
                else
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    ?>

    <div class="container">
        <div class="form" id="id" >
            <h2>Task 2</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-control">
                    <label for="product_id">Product Id</label>
                    <input type="text" id="product_id" placeholder="Enter Product Id" name="product_id" value="<?php echo $product_id;?>">
                    <small><?php echo $product_idErr;?></small>
                </div>
                <div class="form-control">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" placeholder="Enter Product Name" name="product_name" value="<?php echo $product_name;?>">
                    <small><?php echo $product_nameErr;?></small>
                </div>
                <div class="form-control">
                    <label for="product_price">Product Price</label>
                    <input type="text" id="product_price" placeholder="Enter Product Price" name="product_price" value="<?php echo $product_price;?>">
                    <small><?php echo $product_priceErr;?></small>
                </div>
                <div class="form-control">
                    <label for="product_description">Product Description</label>
                    <input type="text" id="product_description" placeholder="Enter Product Description" name="product_description" value="<?php echo $product_description;?>">
                    <small><?php echo $product_descriptionErr;?></small>
                </div>
                <button type="submit" name="submit" value="Submit">Add/Update</button>
                <?php addData($product_id, $product_name, $product_price, $product_description);?>
            </form>
        </div>
    </div>  
</body>
</html>