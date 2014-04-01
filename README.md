Smart Response
===============

## Requerimientos Previos
- Kannel 1.4.3 o posterior
- PHP 5.3.3 o posterior
- MySQL 5.0 o posterior
- Apache 2.0
- Hardware: Modem GPS
- Linux Kernel 2.6 o posterior

## Instalacion y uso
1. Conectar modem con soporte completo de comandos AT (en mi caso Huawei e303 en modo modem)
2. Verificar el archivo del dispositivo usado por el S.O. (generalmente /dev/ttyUSBX)
3. Descargar e instalar bundles de Symfony con comando: php composer.phar update
4. Ejecutar archivo de base de datos adjunta: _database.sql_
5. Configurar archivo _app/config/parameters.yml_ para conexion a BD
6. Reemplazar archivo _kannel.conf_ en lugar de arch. de conf. de Kannel
7. Ejecutar Kannel
8. Enviar el keyword DENUNCIA a linea del modem.
9. Contestar respuestas
10. Visualizarlas desde el home de la App Web