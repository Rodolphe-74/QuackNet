# Projet QuackNet

## Lancement du projet QuackNet

### Récupération du projet sur GitHub

Ouvrir le terminal de son IDE préféré : 
```
git clone https://github.com/Rodolphe-74/QuackNet.git
```

### Démarrage du serveur Symfony
```
symfony server:start
```

### Faire un lien avec la BDD SQLite
On change dans le .env :
```bash
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

Et on crée notre base de donnée dans Doctrine :
```bash
php bin/console doctrine:database:create
```

## Commandes utiles en Symfony

Pour créer une entité :
```
bin/console make:entity
```
Pour créer un controlleur :
```
bin/console make:controller
```
Pour mettre à jour la base de données :
```
bin/console Doctrine:schema:update -f
```

