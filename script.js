var angka;
function halaman(angka) {
    if (angka > 0) {
        window.location.href = 'page' + angka + '.html';
    }else{
        window.location.href = 'index.php';
    }
}
