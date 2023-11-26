var angka;
function halaman(angka) {
    if (angka > 0) {
        window.location.href = 'page' + angka + '.html';
    }else{
        window.location.href = 'index.html';
    }
}

function alertpattern() {
    var inputpass = document.getElementById('password');
    if (!inputpass.checkValidity()) {
        inputpass.setCustomValidity('Pola input tidak sesuai. Masukkan minimal 8 karakter dengan 1 huruf kapital dan 1 angka!');
        inputpass.alert(inputpass.validationMessage);
        event.preventDefault();
    }
}