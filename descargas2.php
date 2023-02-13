<?php 

$canciones = [
    // links here
];
 
foreach ($canciones as $key => $value) {        
    echo "Descargando $value ...\n";
    exec("youtube-dl.exe --no-post-overwrites --audio-quality 9 --audio-format mp3 -x  " . $value);
    echo "Descargado con exito!\n"; 
}

echo "\n
    *****************************************************************\n
    ******************Todo ha sido descargado con exito**************\n
    *****************************************************************\n";


echo "\n
*****************************************************************\n
**************************Cambiando nombres**********************\n
*****************************************************************\n";

$ficheros = scandir("./");
foreach ($canciones as $key => $value) {        
    $pos =  strpos($value, "=");
    $code_url = substr($value, $pos+1, -1);
    foreach ($ficheros as $key_fichero => $nombre_viejo) {
        $encontrado = strpos($nombre_viejo, $code_url);
        if($encontrado !== false){
            $nombre_nuevo = substr_replace($nombre_viejo, '',($encontrado-1), ($encontrado+strlen($code_url)));
            $extraer = array("_", "[", "]", "(",")", "official","official", "video", "audio");
            $nombre_nuevo = trim(ucwords(str_replace($extraer, '',strtolower($nombre_nuevo))));
            rename("./$nombre_viejo", "music/$nombre_nuevo.mp3");
            echo "Cambiando de: \n $nombre_viejo";
            echo "A: \n $nombre_nuevo ";
            echo "-----------------------------------\n";
        }
    }
}


echo "\n
************************************************************************\n
****************ARCHIVOS DESCARGADO Y NOMBRES CAMBIADOS ****************\n
************************************************************************\n";
