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
    "mit_license.md",
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

if ($successCount -eq $excludedFiles.Count) {
    Write-Host "Telechargement reussi." -ForegroundColor Green
} else {
    Write-Host "Telechargement échoué." -ForegroundColor Red
}

Write-Host " "
Write-Host "Merci d'avoir téléchargé ConnectEvent !" -ForegroundColor Blue
Set-ConsoleColor -Reset
