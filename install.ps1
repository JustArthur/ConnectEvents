$url = "https://github.com/JustArthur/ConnectEvents.git"
$outputPath = "C:\wamp64\www\ConnectEvents"

# Effectuer le clone initial
git clone $url $outputPath

# Supprimer les fichiers et dossiers indésirables
$excludedFiles = @(
    "screenshot/",
    "configuration-messagerie.md",
    "DataBase_ConnectEvents.sql",
    "install.ps1",
    "LICENSE",
    "README.md"
)

$successCount = 0
foreach ($file in $excludedFiles) {
    $fullPath = Join-Path -Path $outputPath -ChildPath $file
    if ((Test-Path $fullPath) -or (Test-Path ($fullPath + ".*"))) {
        Remove-Item -Path $fullPath -Force -Recurse
        $successCount++
    }
}

if ($successCount -eq $excludedFiles.Count - 8) {
    Write-Host "Telechargement reussi." -ForegroundColor Green
    Write-Host " "
    Write-Host "Merci d'avoir telecharge ConnectEvent !" -ForegroundColor Blue
    
} else {
    Write-Host "Certains fichiers n'ont pas pu etre telecharger." -ForegroundColor Red
}
