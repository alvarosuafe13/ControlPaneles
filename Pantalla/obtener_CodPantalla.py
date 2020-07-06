#!/usr/bin/env Python
#Este script se lanza cada vez que se inicie una Raspberry y se encarga de guardar en el servidor externo los datos del equipo para el evento actual
#Habra un directorio(/home/pi/Monitor) en cada Rasberry con un archivo json que contiene la informacion para cada evento
import json
import sys


#Lee el json con los datos del evento y los retorna
def obtener_info_equipo():
    try:
        with open('/home/pi/Pantalla/evento.json', 'r') as f:
            info = json.load(f)

        print("localhost/ControlPaneles/Central/Raspberries/"+info['CodPantalla']+".php")
        #return ("localhost/Central/Raspberries/"+info['CodPantalla']+".php")

    except IOError:
        print("No se ha podido abrir el archivo")
        sys.exit()





if __name__ == "__main__":
        obtener_info_equipo()



