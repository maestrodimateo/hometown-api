# Application d'enregistrement des membres de la mairie

## Fonctionnalités
 1. Enregistrement d'un agent dans une mairie
 2. Afficher les mairies
 3. Afficher les agents d'une mairie
 4. Création d'une mairie
 5. Supprimer une mairie (avec ses membres)
 6. Modifier une mairie
 7. Création des comptes utilisateurs
 8. Génération de __qrcode__ pendant l'enregistrement
 9. Visualisation des informations de l'agent avec qrcode
10. Connexion/déconnexion
11. Paramétrer le __qrcode__ avec le bon lien
12. Supprimer un agent d'une mairie
13. Modifier un agent d'une mairie
14. Générer le __qrcode__ d'un agent
15. Générer le __qrcode__ de tous les agents
16. Rechercher tous les agents
17. Rechercher toutes les mairies

## Compréhension du projet

- L'application consiste à permettre à chaque agent de la mairie de s'enregistrer
    - Informations à recevoir
- Les différents rôles utilisateur
    - Simple user => (1, 2, 3, 4, 9, 10, 12, 13)
    - Designer => (2, 3, 9, 10)
    - Admin => (1 - 13)

## Technologies à utiliser

    - Lumen (API)
    - Template interface
    - Javascript
    - PostGresSQL

## La vision du projet

En réalité, ce projet est destiné à effectuer des enregistrements de plusieurs membres de différentes mairies.

## Etapes de réalisation du projet

1. Analyse structurelle (diagramme de classe)
2. Analyse Dynamique (diagramme d'activité, diagramme de cas d'utilisation)
3. Developpement des fonctionnalités principales

## Sprint 1 (une semaine)
    - Simple User
        1. Enregistrement d'un agent dans une mairie
            - Créer les migrations ✔
            - Créer les modèles ✔
            - Créer des seeds (hometown, status, user, rôle) ✔
            - Créer les tests
        2. Afficher les mairies ✔
        3. Afficher les agents d'une mairie ✔
        4. Création d'une mairie ✔
        9. Visualisation des informations de l'agent avec qrcode
        10. Connexion/déconnexion ✔
        12. Supprimer un agent d'une mairie ✔
        13. Modifier un agent d'une mairie ✔
        16. Rechercher tous les agents ✔
        17. Rechercher toutes les mairies ✔

## Sprint 2
    - Admin
        7. Création des comptes utilisateurs ✔
        10. Connexion/déconnexion ✔
    - Authorization management ✔

### Remarques

- Si la mairie n'a pas encore d'url de base, alors on enregistre l'agent sans qrcode;
- On peut générer ultérieurement le qrcode de tous les agents enregistrés