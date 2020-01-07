<?php

preg_match("/[^\w-,]/", $test); //charecter A-Z a-z 0-9 - ,

preg_match("/^[a-zA-Z ]*$/", $test) //charecter A-Z a-z

preg_match('/^[a-zA-Z0-9 _\-\.]+$/', $test) //charecter A-Z a-z 0-9 - ,  //you can add by \