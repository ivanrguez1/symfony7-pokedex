# Pokedex

## 1. Dependencias
```console
composer require --dev symfony/maker-bundle
composer require twig
composer require symfony/orm-pack
composer require symfony/form
```
> Añadir bootstrap al base.html.twig

## 2. Crear y borrar BBDD

```console
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
- drop -> Eliminas la bbdd
- create -> Creas la bbdd
- migrate -> Introduces tablas

## 3. Endpoints (direcciones)
- localhost:8000/categorias/insertar
- localhost:8000/categorias/insertar/Semilla
- localhost:8000/categorias/insertar-array
- localhost:8000/categorias/insertar/Tortuga
- localhost:8000/categorias/insertar/Cuchilla
- localhost:8000/pokemons/insertar/1/Bulbasaur/70/6.9/1
- localhost:8000/pokemons/insertar/2/Ivysaur/100/13.0/1
- localhost:8000/pokemons/insertar/7/Gallade/160/52.0/0
- localhost:8000/pokemons/verPokemons
- localhost:8000/pokemons/verPokemonsJSON
- localhost:8000/pokemons/verPokemonsJSON/0
- localhost:8000/pokemons/verPokemonsOrdenadosJSON/1
- localhost:8000/pokemons/actualizar/100/100/100
- localhost:8000/pokemons/actualizar/2/40/80
- localhost:8000/pokemons/eliminar/2
- localhost:8000/pokemons/formulario