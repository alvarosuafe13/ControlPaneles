
import requests
import json

def obtener_codEvento():

    with open ('evento.txt', 'r') as f:
        evento = f.readline()

    evento = evento.rstrip('\n')
    return evento

def obtener_info_equipo():

    codEvento = obtener_codEvento()
    parametros = {'CodEvento':codEvento}
    pantallas = requests.get('http://jrodeiro.es/alvaroTFG/pruebas/recuperarpantallas.php', params=parametros)
    return pantallas

def guardar_json():
    aux = obtener_info_equipo()
    print(aux.text)
    json_data = json.loads(aux.text)
    print(json_data)
    with open ('pantallas.json', "w") as f:
        json.dump(json_data, f)

if __name__ == "__main__":
    guardar_json()
