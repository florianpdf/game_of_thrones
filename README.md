GameOfThrones
=============

#### Pré-requis: 
composer ==> [Install Composer](https://getcomposer.org/doc/00-intro.md)

#### Initialisation du projet
1. **Avec ssh**: git clone git@github.com:florianpdf/game_of_thrones.git 
2. **Sans ssh**: git clone https://github.com/florianpdf/game_of_thrones.git
3. cd game_of_thrones
4. composer install
5. php bin/console doctrine:database:create
6. php bin/console doctrine:schema:update --force

A Symfony 3.2 project created on April 25, 2017, 11:36 am.
