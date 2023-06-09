$url = "https://github.com/JustArthur/ConnectEvents.git"
$outputPath = "C:\wamp64\www\ConnectEvents"

git clone $url $outputPath

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

if ($successCount -eq $excludedFiles.Count) {
    Write-Host "Telechargement reussi." -ForegroundColor Green
    Write-Host " "
    Write-Host "Merci d'avoir telecharge ConnectEvent !" -ForegroundColor Blue
    
} else {
    Write-Host "Certains fichiers n'ont pas pu etre telecharger. Telecharger sous forme de fichier .zip depuis mon github." -ForegroundColor Red
}
