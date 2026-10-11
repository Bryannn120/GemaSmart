$files = Get-ChildItem -Path 'c:\sibibit\app', 'c:\sibibit\database', 'c:\sibibit\resources\views', 'c:\sibibit\routes' -Recurse -File -Include *.php,*.tsx,*.blade.php
foreach ($file in $files) {
    $text = Get-Content $file.FullName -Raw
    $orig = $text
    $text = $text -creplace 'PetaniController', 'KeluargaPenerimaController'
    $text = $text -creplace 'Petani', 'KeluargaPenerima'
    $text = $text -creplace 'petanis', 'keluarga_penerimas'
    $text = $text -creplace 'petani_id', 'keluarga_penerima_id'
    $text = $text -creplace 'petani', 'keluarga_penerima'
    if ($text -ne $orig) {
        [System.IO.File]::WriteAllText($file.FullName, $text, (New-Object System.Text.UTF8Encoding($false)))
    }
}
