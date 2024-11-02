<?php 

function sanitize_input($input): string {
    $output = trim($input);
    $output = stripslashes($output);
    $output = htmlspecialchars($output);
    return $output;
}

function validate_Repeat_Password($p, $repeatP) : bool{
  return $repeatP === $p;
}


?>