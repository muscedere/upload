<?php

if(isset($_REQUEST['del'])) {
    $link = 'uploads/'.$_REQUEST['del'];
    if(unlink($link)) {
        echo 'fichier supprimé';
    }
}
