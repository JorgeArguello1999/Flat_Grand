# Flat Grand
Software diseñado para obtener la salida de la balanza.

> En el proyecto viene incluido drivers para la balanza: "Meter Toledo" modelo: IND 231/236

Este software utiliza `Python` como lenguaje de programación y como librerias principales `PySerial` y `PyAutoGUI`, en el proyecto se encuentran las dependencias.

## Instalación
Para la instalación debes tener `Python3.11` y Sistema Operativo Windows (Desde la versión 8.1 en adelante) o Linux (Actualizados los paquetes de Python y PIP).

1. Instalar las dependencias para Python3
```bash
pip3 install -r require.txt
```

2. Configurar la Aplicación
``` python
if __name__ == "__main__":
    puertos_disponibles = serial.tools.list_ports.comports()
    
    for port in puertos_disponibles:
        try:
            # name_file = Variable para guardar el archivo de LOG
            # save = Decide Si guardar o No el LOG
            main(port=port.device, name_file="temp", save=True)
        except Exception as e:
            print("No se ha encontrado el dispositivo, conectelo o llamé a servicio Técnico")
            print(f"{port.device} - {e}")
        
```

3. Ejecutar, una vez realizados estos pasos puede utilizar su software

## Personaliza tu software
Al precionarse el boton enviar de la balanza se escribe en pantalla (Utilizando PyAutoGUI y tambien realiza un TAB despues de escribir el peso)

Esto se puede personalizar en esta función llamada `interface`, donde usted puede colocar que tecla se preciona despues de obtenida la información

```python
# Usando PyAutoGUI
def interface(data):
    pyautogui.write(data)
    pyautogui.press("tab")
```

## Tener en cuenta 
- Verificar que el USB/Serial este bien conectado
- Tener los drivers instalados
- Ver que el USB serial se conecte y este funcionando de manera correcta

En caso de no funcionar, reporte al creador.

## Adelantos
- Una interfaz más amigable con el usuario
- Crear un ejecutable con todos los drivers necesarios