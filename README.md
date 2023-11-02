# Zadanie rekrutacyjne

**Cel:**
Stworzenie prostego systemu do zarządzania książkami w bibliotece.

## Specyfikacja:
1. **Aplikacja:**
    - Laravel 10.30, 
    - Vue 3.5, 
    - MySQL 8.2.0, 
    - PHP 8.2, 
    - Node 20.9.0, 
    - npm 10.1.0, 
    - Docker (docker-compose)
    - Bootstrap 5
2. **Opis:**
    - Logika backendowa znajduje się w formie modułów w folderze "Domains", frontend został zbudowany w formie SPA konsumując API Laravela.

## Instalacja:

Projekt można uruchomić w dowolnym środowisku LAMP (zgodnym z wersjami zawartymi w specyfikacji) kopiując dane z folderu src lub wykorzystując Dockera oraz docker-compose (https://docs.docker.com/compose/).

**Instalacja z wykorzystaniem docker-compose:**

1. **Konfiguracja zmiennych środowiskowych:** 
   - [ENV DOCKERA] Należy skopiować plik .env.exmaple z głównemgo folderu oraz zapisać go bez rozszerzenia jako .env
   - [ENV LARAVELA] Analogicznie należy skopiować .env.example z folderu src ustawiając przy tym zmienne środowiskowe.
2. **Budowa kontenerów i konfiguracja:**
   - Z poziomu głównego folderu projektu w którym znajduje się plik docker-compose należy uruchomić komendę ```docker-compose build --no-cache```
   - Następnie po zakończeniu pobierania i budowania obrazów należy uruchomić kontenery: ```docker-compose up -d web```
   - Instalujemy zależności composera: ```docker-compose run --rm composer install```
   - Uruchamiamy migracje: ```docker-compose run artisan migrate```
   - Uruchamiamy seedery: ```docker-compose run artisan db:seed```
   - Kolejnym krokiem jest instalacja modułów node: ```docker-compose run --rm npm install```
   - Następnie budujemy frontend: ```docker-compose run --rm npm build```
3. **Serwer web i mysql**
   - Aplikacja jest dostępna pod portem http://localhost:8001
   - MySQL jest dostępny poza kontenerem na porcie 3308
   - Konfigurację serwera można zmienić w pliku docker-compose.yml
4. **Wymagania systemowe**
   - Projekt został stworzony oraz był testowany na Linux Ubuntu 18.04.6 LTS, uruchamianie projektu na innym platformach może wymagać modyfikacji pliku docker-compose.