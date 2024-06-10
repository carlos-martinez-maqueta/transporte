$(document).ready(function(){
    $('#loginForm').on('submit', function(event){
        event.preventDefault(); // Evita que el formulario se envíe de la manera tradicional
        var username = $('#usernameInput').val();
        var password = $('#passwordInput').val();
        
        $.ajax({
            url: 'login-user.php',
            type: 'POST',
            data: {username: username, password: password},
            success: function(response){
                if (response.success) {
                    // Redirige o muestra un mensaje de éxito
                    window.location.href = 'index';
                } else {
                    alert('Usuario o contraseña incorrectos');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                alert('Hubo un error en el servidor. Por favor, intenta de nuevo.');
            }
        });
    });
});