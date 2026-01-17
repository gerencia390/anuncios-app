# Software para Gestión de Anuncios - Supercasas SRL
## Instalación

Crear una base de datos y luego crear el esquema con el siguiente comando:
```
php artisan migrate
```

Para rellenar datos iniciales:

```
php artisan db:seed
```

Para ejecutar el sistema en local:

```
php artisan serve
```

Para ejecutar el sistema en red:
En host, colocar la IP de la computadora.
```
php artisan serve --host=0.0.0.0 --port=8000
```
