# ConnectEvents

ConnectEvents est une application web développée en PHP qui permet aux utilisateurs de gérer des événements et d'interagir avec d'autres utilisateurs. Il offre des fonctionnalités telles que la création d'événements, l'inscription à des événements, un système de blog et un gestionnaire de contacts.

## Fonctionnalités principales

- 🔖 Création, affichage et gestion d'événements : Les utilisateurs peuvent créer des événements, consulter les détails des événements existants et s'inscrire pour y participer.
- 📝 Blog intégré : Un système de blog simple permet aux utilisateurs de publier des articles, de les commenter et de les gérer.
- 📇 Gestionnaire de contacts : Les utilisateurs peuvent ajouter, afficher, modifier et supprimer des contacts dans leur carnet d'adresses.
- 🔒 Sécurité des données : Les mots de passe des utilisateurs sont stockés de manière sécurisée grâce à un hachage fort, assurant la confidentialité et l'intégrité des données.


## Configuration et installation

1. Télécharger les fichiers depuis votre ordinateur Linux, Mac ou Windows en éxécutant si dessous la commande approprié.

## Windows
⚠️ Les fichiers seront installés dans le répertoire par défault de WAMP qui est :
    
```C:\wamp64\www\```

Il ira ensuite créer un dossier ```ConnectEvents``` automatiquement dans votre répertoire ```www```.


```powershell
#Commande Windows à faire dans PowerShell
iwr -Uri "https://raw.githubusercontent.com/JustArthur/ConnectEvents/main/install.ps1" | iex
```

## Linux
(Le test d'installation sur Linux n'a pas encore été essayé, préférer le téléchargement manuel)

 ⚠️ Les fichiers seront installés dans le répertoire par défault de LAMP qui est :
    
```var/www/html```

Il ira ensuite créer un dossier ```ConnectEvents``` automatiquement dans votre répertoire ```html```.


```sh
#Commande Linux à faire dans le terminal
iwr -Uri "https://raw.githubusercontent.com/JustArthur/ConnectEvents/main/install.sh" | sh
```


2. Configurez la base de données en important le fichier de structure fourni.

<a href="https://github.com/JustArthur/ConnectEvents/blob/main/DataBase_ConnectEvents.sql" >Cliquez ici</a> pour télécharger le fichier ```DataBase_ConnectEvents.sql```

3. Modifiez le fichier de configuration pour y indiquer les paramètres de connexion à la base de données.
Le fichier se trouve dans le répertoire ```php/database/connexionBD.php```

```php
private $host    = 'localhost';     //nom de l'host  
private $name    = 'connectevent';  //nom de la base de donnée
private $user    = '';              //utilisateur (Permissions requises -> SELECT, INSERT, UPDATE, DELETE)
private $pass    = '';              //mot de passe de la BDD
```

4. - Version Apache utilisé : 2.4.54.2
   - Version PHP utilisé : 8.0.26
   - Version MySQL utilisé : 8.0.31

5. Profiter du site web en local via ce lien <a href="http://127.0.0.1/ConnectEvents">ConnectEvent</a>

## Captures d'écran
<img src="https://github.com/JustArthur/ConnectEvents/blob/main/screenshot/ConnectEvent_1.png?raw=true"/>
<img src="https://github.com/JustArthur/ConnectEvents/blob/main/screenshot/ConnectEvent_2.png?raw=true"/>
<img src="https://github.com/JustArthur/ConnectEvents/blob/main/screenshot/ConnectEvent_3.png?raw=true"/>


## Licence

Ce projet est sous licence [MIT](LICENSE). Vous pouvez utiliser, modifier et distribuer ce code conformément aux conditions de la licence.

N'hésitez pas à me contacter pour toute question ou suggestion. J'espére que vous apprécierez l'utilisation de ConnectEvents !
