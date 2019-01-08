<!--<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myvehicle.lk";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
  //  echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>--> 

<?php
/*###############Database Connection###################*/
/*$count = 0;
$currency = 'Rs '; //Currency Character or code
$shipping_cost      = 1.50; //shipping cost
$taxes              = array( //List your Taxes percent here.
                            'VAT' => 12, 
                            'Service Tax' => 5
                            );	*/

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "myvehicle.lk";
try
{
    $con = mysqli_connect($servername, $username, $password, $dbname);
    //echo "Connected successfully";
}
catch (Exception $e)
{
    $error = $e->getMessage();
    echo $error;
}

?>