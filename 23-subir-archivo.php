<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Archivo</title>
    <style>
        
        #container{
            width: 80%;
            margin: 0px auto;
            display: block;
            font-family: helvetica;
            padding-top: 60px;
        }
    
    </style>
</head>
<body>


<div id="container">
    
 <h1>Subir Archivo</h1>
 <?php  if ($_SERVER['REQUEST_METHOD']=='POST') {  // $_SERVER('REQUEST_METHOS']=='POST')
    // solo archivos jpge
/*     foreach ($_FILES['fichero_usuario'] as $key => $valor){
        echo "<p>$key = $valor</p>";
    }
    $_FILES['fichero_usuario']['name']; */
    if ( $_FILES['fichero_usuario']['type'] == 'application/vnd.oasis.opendocument.text' OR $_FILES['fichero_usuario']['type'] == 'application/pdf'  OR  $_FILES['fichero_usuario']['type'] == 'application/msword'     ){
    
            


            $dir_subida = $_SERVER['DOCUMENT_ROOT'] . '/01-formularios/upload/';

            $partes = explode('.',$_FILES['fichero_usuario']['name']);
            echo count($partes);
            echo $partes[count($partes)-1];
            print_r ($partes);
            $nuevonombre = $partes[0] . '_' . time() . '.'
. $partes[1];
            $nuevonombre = '';
            for ($i=0;$i<count($partes)-1;$i++){
                $nuevonombre .= $partes[$i];
               // $nuevonombre = $nuevonombre . $partes[$i];
            }
            $nuevonombre .= '.' . $partes[count($partes)-1];
            echo "<p> $nuevonombre </p>";
            $nuevonombre = strtolower(str_replace(' ','_',$nuevonombre));
            //$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);



            $fichero_subido = $dir_subida . $nuevonombre;
            

            
            echo '<pre>';
            if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
                echo "El fichero es válido y se subió con éxito.\n";
            } else {
                echo "¡Posible ataque de subida de ficheros!\n";
            }
            
            echo 'Más información de depuración:';
            print_r($_FILES);
            echo '<hr>';
            echo '<p> Tipo : ' . $_FILES['fichero_usuario']['type'] . '</p>';
            
            print "</pre>";
    } else {
            echo '<p> Tipo incorrecto '. $_FILES['fichero_usuario']['type'] . ' </p>';
    }


  } else { ?>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="100000"> -->
        <b>Enviar un nuevo archivo: </b>
        <br>
        <input name="fichero_usuario" type="file">
        <br>
        <input type="submit" value="Enviar">
    </form>
<?php } ?>
   


</div>

</body>
</html>