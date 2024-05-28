# Pokedex

## 1. Crear y borrar BBDD

```console
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
- drop -> Eliminas la bbdd
- create -> Creas la bbdd
- migrate -> Introduces tablas

## Endpoints (direcciones)
- localhost:8000/categorias/insertar
- localhost:8000/categorias/insertar/semilla
- localhost:8000/categorias/insertar-array
