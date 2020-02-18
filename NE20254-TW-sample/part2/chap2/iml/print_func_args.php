<?php
// if include this in the function,
// function argument(s) is/are printed out.
$numargs = func_num_args();
echo "Args: $numargs<br>\n";
$arg_list = func_get_args();
for ( $i = 0; $i < $numargs; $i++ ) {
  echo "  [$i]=" . $arg_list[$i] . "<br>\n";
}
?>
