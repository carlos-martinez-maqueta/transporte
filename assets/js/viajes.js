document.getElementById('origen').addEventListener('change', function() {
    var origenValue = this.value;
    var destinoSelect = document.getElementById('destino');
    var options = destinoSelect.getElementsByTagName('option');
    
    for (var i = 0; i < options.length; i++) {
        options[i].style.display = 'none';
    }

    if (origenValue.includes('ida')) {
        for (var i = 0; i < options.length; i++) {
            if (options[i].value.includes('vuelta')) {
                options[i].style.display = 'block';
            }
        }
    } else if (origenValue.includes('vuelta')) {
        for (var i = 0; i < options.length; i++) {
            if (options[i].value.includes('ida')) {
                options[i].style.display = 'block';
            }
        }
    }
});