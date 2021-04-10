# Wstęp
W prezentowanym projekcie zrealizowane zostały wszystkie trzy zadania. W dalszej części readme zostało opisane jak uruchomić lub przetestować każde z zadań. Zadania zostały zrealizowane w oparciu o PHP 7.4 i Symfony 3.4. Miłego przeglądania. 🙂

## Instalacja

Sklonowanie projektu

`git clone git@github.com:kx1000/ZadanieContelizer.git`

Instalacja zależności

`composer install`

## Uruchomienie testów

`./bin/phpunit`

# Zadania

## Zadanie 1
- Plik komendy: `src/Command/RandomizeTextFileCommand.php`
- Uruchomienie komendy: `php bin/console randomize:text-file`

- Plik `src/Command/txts/input.txt` zostanie skopiowany do pliku `src/Command/txts/output.txt` uwzględniając algorytm mieszający litery w wyrazach.

## Zadanie 2
- Algorytm: `https://obywatel.gov.pl/pl/dokumenty-i-dane-osobowe/czym-jest-numer-pesel`
- Validator: `src/Validator/PeselValidator.php`
- Test: `tests/Validator/PeselValidatorTest.php`

## Zadanie 3