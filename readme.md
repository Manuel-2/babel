# Babel
Proyecto desarrollado por Manuel Eduardo Peñaloza López para la materia de programación web.
![enter image description here](https://media.discordapp.net/attachments/803879082797826048/1447524975740190851/image.png?ex=6937f02f&is=69369eaf&hm=e021e98da524dc08473c7cdbd5a5dd61eff3ef7d920ca323ce78ef017c70c80d&=&format=webp&quality=lossless&width=1689&height=874)

## Setup
### Software requerido:

 - [x] apache2
 - [x] mysql
 - [ ] msmtp
 - [x] ngrok
 - [ ] php-mysql (modulo de php)
 - [x] ollama qwen2.5

No voy a hablar de como instalar apache2, mysql o ngrok dado que son ampliamente utilizados.
Para configurar ollama revisar el repo del profe: https://github.com/jzunigauabcs/ollama-test

Instalar:
> sudo apt install msmtp php-mysql

### Configuración previa

#### Coneccion a la base de datos
Solo copia el archivo config.example.json a config.json(este esta ignorado por git)
>cp config.example.json config.json

Y coloca dentro tu usuario y contraseña, además del nombre de la base de datos, el backend leerá este archivo para establecer la conexiono con la base de datos
Usa un visualizador de base de datos o desde la terminal crea una nueva base de datos:
>mysql -u usuario -p
>(ingresas tu contra)

> create database babel;

y listo colocas babel en la configuración o el nombre que le pusiste


#### Correos electrónicos
Crear un archivo de configuración global para msmtp en /etc llamado .msmtp
> sudo touch /etc/.msmtp

Luego  copia los contenidos del archivo msmtp.example que se encuentra en la raíz del repo y configura tu correo y contraseña de tu sevidor smtp (yo estoy usando los servidores de gmail de google)

Es importe configurar los permisos de este archivo dado que tiene credenciales de autenticación
.rw-------  232 root msmtprc


#### Configuración de Apache
 Mueve o copia la el archivo de configuración php.ini de la raiz del proyecto a la carpeta de php de apache
(recomendable primero hacer un bk del anterior archivo)
> sudo cp /etc/php/version/php.ini /etc/php/version/php.ini.bk

> cp php.ini /etc/php/version/php.ini

Luego vamos a configurar un host virtual para servir el front y el backend, lo mismo de lo anterior colocar los archivos de configuracion en el lugar correcto
> sudo cp babel.com.conf /etc/apache2/sites-available

Agrega el nuevo host virtual a apache con los comandos:
> a2ensite /etc/apache2/sites-available

(tecnicamente esto no es de apache pero nos sirve para tener el "dominio")
Edita el archivo /etc/hosts y agrega la entrada en la primera linea:
> 127.0.0.1	babel.com

Reinicia apache para que tome efecto

>sudo systemctl restart apache2

### Despliegue local
Despues de reiniciar apache puedes ir a babel.com y ver el sitio


### Como desplegar (en linea)
> ngrok http 80 --host-header="babel.com"


