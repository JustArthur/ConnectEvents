$url = "https://github.com/JustArthur/ConnectEvents.git"
$outputPath = "C:\wamp64\www\ConnectEvents"

git clone $url $outputPath

$excludedFiles = @(
    "screenshot/",
    "configuration-messagerie.md",
    "DataBase_ConnectEvents.sql",
    "install.ps1",
    "install.sh",
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
    Write-Host -Object "Telechargement reussi." -ForegroundColor Green
    Write-Host -Object " "
    Write-Host -Object "Merci d'avoir telecharge ConnectEvent !" -ForegroundColor Blue
    
} else {
    Write-Host -Object "Certains fichiers n'ont pas pu etre telecharger. Telecharger sous forme de fichier .zip depuis le github." -ForegroundColor Red
}
