<?php print_r( $_POST['x']);
$json = (array) json_decode($_POST['x']);
    foreach($json as $value)  {
                unlink('./files/'.$value);
                echo "deleted files".$value;
                                    }
    ;?>