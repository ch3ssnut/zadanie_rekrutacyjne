## Spis treści
* [Informacje ogólne](#informacje-ogólne)
* [Technologie](#technologie)
* [Setup](#setup)

## Informacje ogólne
Rozwiązane zadanie rekrutacyjne, do którego wykorzystano PHP z frameworkiem Symfony. Aplikacja służy do wyświetlania informacji zawartych w pliku JSON w formie tabeli, którą można sortować, oraz w której można wyszukiwać poszczególne zamówienia. Do wystylizowania frontendu zastosowano bootstrap. 

## Technologie
Przy projekcie korzystano z:
* PHP 
* Symfony 
* TWIG 
* HTML
* Bootstrap

## Setup
W celu uruchomienia aplikacji lokalnie, należy mieć zainstalowany git, composer oraz symfony cli. Następnie wykonać poniższe komendy konsoli: 
```
git clone https://github.com/ch3ssnut/zadanie_rekrutacyjne
cd zadanie_rekrutacyjne
```

Po przejściu do sclonowanego folderu:
```
$ composer install
$ symfony serve -d
```


Następnie wejść na adres:
```
https://localhost:8000/
```

