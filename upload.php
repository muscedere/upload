<?php

if (!empty($_FILES['files']['name'][0]))
{
    $files = $_FILES['files'];
    $uploaded = array();
    $failed = array();
    $allowed = array('jpg', 'png', 'gif');

    foreach ($files['name'] as $position => $file_name)
    {
        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));


        if(in_array($file_ext, $allowed))
        {
            if ($file_error === 0)
            {
                if ($file_size <= 1000000)
                {
                    $new_file_name = 'image' . uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'uploads/' . $new_file_name;

                    if (move_uploaded_file($file_tmp, $file_destination))
                    {
                        $uploaded[$position] = $file_destination;
                    } else {
                        $failed[$position] = "{$file_name} echec du telechargement.";
                    }
                } else {
                    $failed[$position] = "{$file_name} est trop lourd.";
                }
            } else {
                $failed[$position] = "{$file_name} echec du telechargement.";
            }
        } else {
            $failed[$position] = "{$file_name} extension du fichier '{$file_ext}' n'est pas autoriser.";
        }
    }


    if (!empty($failed))
    {
        print_r($failed);
    }
}