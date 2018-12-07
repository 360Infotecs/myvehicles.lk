<?php
 
$files = glob("/images/companyLogo/MVC18112464979.*");
 
 
 
 foreach ($files as $item) {
    echo $item."<br/>";
}

//echo join(', ', $array);

//array_walk($array, create_function('$a', 'echo $a;'));
?>