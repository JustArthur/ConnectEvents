#!/bin/bash

url="https://github.com/JustArthur/ConnectEvents.git"
outputPath="/var/www/html/ConnectEvents"

git clone "$url" "$outputPath"

excludedFiles=(
    "screenshot/"
    "configuration-messagerie.md"
    "DataBase_ConnectEvents.sql"
    "install.ps1"
    "LICENSE"
    "README.md"
)

successCount=0
for file in "${excludedFiles[@]}"
do
    fullPath="${outputPath}/${file}"
    if [ -e "$fullPath" ] || [ -e "${fullPath}.*" ]; then
        rm -rf "$fullPath"
        successCount=$((successCount+1))
    fi
done

if [ "$successCount" -eq "${#excludedFiles[@]}" ]; then
    echo "Téléchargement réussi."
    echo ""
    echo "Merci d'avoir téléchargé ConnectEvent !"
else
    echo "Certains fichiers n'ont pas pu être téléchargés. Veuillez télécharger sous forme de fichier .zip depuis mon GitHub."
fi