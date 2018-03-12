<?php

echo $pass = password_hash("admin", PASSWORD_DEFAULT);

if (password_verify("admin", $pass)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

 ?>
