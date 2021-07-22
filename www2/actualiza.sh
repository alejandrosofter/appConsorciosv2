#!/bin/bash
echo ""
echo ""
echo "Hola vamos a actualizar el sistema de CONSORCIOS!"
echo ""
echo ""
echo ""
echo "Tengo para actulizar:"
echo "1.- Sistema CONSORCIOS UNIDADES"
echo "2.- Sistema CONSORCIOS VEKAR"
echo ""
echo "Que deseas actualizar? (Selecciona 1|2)"
read opcionActualizar
echo "seleccionste $opcionActualizar"
desde="/home/alejandro/docker/appConsorcios/www2/"
host="134.209.175.156"
usuario="alejandro"

case $opcionActualizar in  
    1 )  
        droplet="IBERO-PHP5.9 =====> cuenta de alejandronovillo1984@gmail.com"
        folderHasta="/var/www/unidades.yavu.com.ar/"
        hasta="$usuario@$host:$folderHasta"
        echo "Ok! vamos a actualizar el sistema CONSORCIOS UNIDADES"  
        echo "DESDE: $desde"
        echo "HASTA: $hasta"
        echo "EN DIGITAL OCEAN $droplet"
        rsync -av $desde $hasta --exclude="/protected/config/main.php" --exclude="/protected/runtime/" --exclude="/protected/config/" --exclude="/assets" --progress
        ;;  
    2 )  
        droplet="IBERO-PHP5.9 =====> cuenta de alejandronovillo1984@gmail.com"
        folderHasta="/var/www/vekar.yavu.com.ar/"
        hasta="$usuario@$host:$folderHasta"
        echo "Ok! vamos a actualizar el sistema CONSORCIOS VEKAR"  
        echo "DESDE: $desde"
        echo "HASTA: $hasta"
        echo "EN DIGITAL OCEAN $droplet"
        rsync -av $desde $hasta --exclude="/protected/config/main.php" --exclude="/protected/runtime/" --exclude="/protected/config/" --exclude="/assets" --progress
        ;;  
    
esac  

#rsync -av /home/alejandro/docker/appConsorcios/www2/ alejandro@66.97.37.151:/var/www/oftalmologia/app/ --exclude="/protected/config/main.php" --exclude="/protected/runtime/" --exclude="/protected/config/" --exclude="/assets" --progress