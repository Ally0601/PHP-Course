<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Task 1</title>
</head>
<body>
    <?php
        $n1Err = $n2Err = "";
        $n1 = $n2 = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET") 
        {
            if (empty($_GET["n1"])) 
            {
                $n1Err = "N1 is required";
            } 
            else 
            {
                $n1 = test_input($_GET["n1"]);
                if (!is_numeric($n1)) 
                    $n1Err = "Enter integer";
                else
                    $n1 = +$n1;
            }

            if (empty($_GET["n2"])) 
            {
                $n2Err = "N2 is required";
            } 
            else 
            {
                $n2 = test_input($_GET["n2"]);
                if (!is_numeric($n2))
                    $n2Err = "Enter integer";
                else
                    $n2 = +$n2;
            }
        }

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
    ?>

    <div class="container">
        <div class="form" id="id" >
            <h2>Task 1</h2>
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-control">
                    <label for="n1">N1</label>
                    <input type="text" id="n1" placeholder="Enter N1" name="n1" value="<?php echo $n1;?>">
                    <small><?php echo $n1Err;?></small>
                </div>
                <div class="form-control">
                    <label for="n2">N2</label>
                    <input type="text" id="n2" placeholder="Enter N2" name="n2" value="<?php echo $n2;?>">
                    <small><?php echo $n2Err;?></small>
                </div>
                <button type="submit" name="submit" value="Submit">Check</button>
            </form>
        </div>
        

        <?php
            function primeCheck($number)
            { 
                if ($number == 1) 
                    return 0; 
                for ($i = 2; $i <= sqrt($number); $i++)
                { 
                    if ($number % $i == 0) 
                        return 0; 
                }
                return 1; 
            }
            
            
            if(is_int($n1) and is_int($n2))
            {
                echo "Prime numbers:- ";
                for ($i=$n1; $i<=$n2;$i++)
                {
                    $flag = primeCheck($i);
                    if ($flag == 1) 
                        echo $i. ", "; 
                } 
            }
        ?> 

    </div>  
</body>
</html>