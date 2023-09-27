import serial
import json 
import pyautogui
import re 

# Hilo principal
def main(port:str, name_file:str, save=False):
    resultados = []
    # Configura el puerto serial
    ser = serial.Serial(port, 9600) 
    try:
        while True:
            # Lee datos del puerto serial
            data = ser.readline().decode('utf-8').strip()
            resultados.append(data)
            # Imprime los datos recibidos
            print(f'Datos recibidos: {data}')

            # Llamada a la intefaz gráfica PyAutoGUI
            if "Gross" in data:
                numeros = re.findall(r'\d+\.\d+', data)
                interface(', '.join(numeros))

    except KeyboardInterrupt:
        print("Deteniendo la monitorización del puerto serial.")

    finally:
        ser.close() 
        salida = clean(resultados)
        if save == True:
            # Pasamos a JSON y guardamos el registro
            save_register(salida, name_file) 

            print(f"Diccionario: {salida}")
            print(f"JSON Guardado con el nombre: {name_file}")
        
        return salida

# Usando PyAutoGUI
def interface(data):
    pyautogui.write(data)
    pyautogui.press("down")

# Limpiamos los datos
def clean(data:list):
    cleaned_data = [line.strip() for line in data if line.strip() != '']

    # Divide los datos en grupos de 5 líneas
    grouped_data = [cleaned_data[i:i + 5] for i in range(0, len(cleaned_data), 5)]

    # Convierte los grupos en diccionarios
    result = []
    for group in grouped_data:
        group_dict = {}
        for line in group:
            key, value = line.split(maxsplit=1)
            group_dict[key] = value.strip()
        result.append(group_dict)

    # Retorna el diccionario 
    return json.dumps(result, indent=4)

# Guardamos el JSON
def save_register(data:json, name:str):
    # Guardamos la información en un jsonfile
    with open(f"{name}.json", "w") as archivo:
        archivo.write(str(data))
    return True

if __name__ == "__main__":
    main(port="/dev/ttyUSB0", name_file="temp", save=True)