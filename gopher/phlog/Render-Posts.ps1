foreach ($dir in Get-ChildItem -Directory .) {
    C:\php\php.exe .\post.php $dir | Out-File -Encoding utf8NoBOM "$dir\index.cnt.html"
}
