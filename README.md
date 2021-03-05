# description:

Ce projet répond à la demande suivante:

En paie, nous travaillons avec des périodes.
La période mensuelle est la plus courante, notamment parce qu'elle correspond au rythme d'édition des bulletins de paie.
Elle commence le premier jour du mois à minuit (inclus) et termine le premier jour du mois suivant à minuit (exclu).
D'autres périodes existent dans le métier de la paie, par exemple les périodes d'absence comme les congés.
Etant donné qu'un salarié a posé des congés;

j'ai besoin de la fonction sur la période mensuelle isInclusDansPeriode(Absence $absence): bool pour déterminer
si je dois prendre en compte cette période d’absence lors du calcul du bulletin correspondant à la période mensuelle en cours.

la fonction doit avoir des tests unitaires associés pour valider le fonctionnement attendu

# contenu:

En réponse à cette demande, j'ai créé une api en utilisant Symfony 5, le projet tourne sur un envirronement dockerisé.

    Endpoint:
        POST: http://localhost/api/absence/isInclusDansPeriode
        POST body:
                {
                    "beginDate": "yyyy-mm-dd",
                    "endDate": "yyyy-mm-dd"
                }

# install
    docker-compose up 

(docker et docker compose doivent être installés sur votre poste...)

# tests unitaires
se connecter au container php_base
    (via cli : docker exec -it php_base sh)

lancer:
    
    composer require --dev phpunit/phpunit ^9

vérifier:
    
    ./vendor/bin/phpunit --version

lancer les TU:
    
    ./vendor/bin/phpunit test/
