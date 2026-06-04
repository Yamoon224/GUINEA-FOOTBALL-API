# Guinea Football Club API

API REST Laravel pour la gestion d'un club de football guineen: clubs, equipes, joueurs, matchs, classement, actualites et boutique.

## Description

Guinea Football Club API est un backend Laravel concu pour centraliser les donnees d'un club de football et exposer des endpoints API pour les applications web/mobile.

Fonctionnalites principales:

- Gestion des clubs et des equipes.
- Gestion des joueurs et des medias.
- Gestion des fixtures, resultats et classements.
- Gestion des actualites du club et des produits boutique.
- Authentification via Laravel Sanctum.

## Website

- API locale: http://localhost/guinea-football-club-api-laravel/public
- API production (propose): https://api.guineafootballclub.com
- Documentation API (propose): https://api.guineafootballclub.com/docs

Si vous avez deja un domaine de production, remplacez les URLs ci-dessus.

## Metadata GitHub (pret a coller)

- Description courte: API REST Laravel pour gerer clubs, equipes, joueurs, matchs, classements, actualites et boutique d'un club de football guineen.
- Website: https://api.guineafootballclub.com

## Topics

Ajoutez ces topics dans les parametres GitHub du repository:

- laravel
- php
- rest-api
- football
- sports
- sanctum
- mysql
- backend

## Stack technique

- PHP / Laravel
- Eloquent ORM
- MySQL
- Vite
- PHPUnit

## Installation rapide

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Tests

```bash
php artisan test
```

## Licence

Projet sous licence MIT (a ajuster selon votre besoin).
