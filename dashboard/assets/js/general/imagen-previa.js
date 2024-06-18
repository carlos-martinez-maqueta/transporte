document.getElementById('imagen').addEventListener('change', function() {
    var imagenPrevia = document.getElementById('imagenPrevia');
    var sinImagen = document.getElementById('sinImagen');
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            imagenPrevia.src = e.target.result;
            imagenPrevia.style.display = 'block';
            sinImagen.style.display = 'none';
        }
        reader.readAsDataURL(file);
    } else {
        imagenPrevia.style.display = 'none';
        sinImagen.style.display = 'block';
    }
});