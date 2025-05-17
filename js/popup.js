document.addEventListener("DOMContentLoaded", function () {
    if (typeof x !== 'undefined' && x === 1) {
        mostrarPopup("Operación realizada exitosamente", "tabcontac.php", "./media/check.png");
    }
});

function confirmarBorrado() {
    mostrarPopupConfirmacion(
        "¿Estás seguro de que deseas eliminar este contacto?",
        function () {
            document.forms['abcPH'].submit();
        },
        "./media/confirm.png"
    );
}

function mostrarPopup(mensaje, redireccion, imagenref) {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;

    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
    popup.style.maxWidth = '300px';

    const message = document.createElement('p');
    message.textContent = mensaje;

    const imagen = document.createElement('img');
    imagen.src = imagenref;
    imagen.style.width = "80px";
    imagen.style.marginBottom = "10px";

    const button = document.createElement('button');
    button.textContent = 'Aceptar';
    button.style.marginTop = '10px';
    button.style.padding = '10px 20px';
    button.style.cursor = 'pointer';

    button.addEventListener('click', function () {
        window.location.href = redireccion;
    });

    popup.appendChild(imagen);
    popup.appendChild(message);
    popup.appendChild(button);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}

function mostrarPopupConfirmacion(mensaje, callbackAceptar, imagenref = null) {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;

    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
    popup.style.maxWidth = '320px';

    if (imagenref) {
        const imagen = document.createElement('img');
        imagen.src = imagenref;
        imagen.style.width = "80px";
        imagen.style.marginBottom = "10px";
        popup.appendChild(imagen);
    }

    const message = document.createElement('p');
    message.textContent = mensaje;
    popup.appendChild(message);

    const botones = document.createElement('div');
    botones.style.display = 'flex';
    botones.style.justifyContent = 'space-around';
    botones.style.marginTop = '15px';

    const btnAceptar = document.createElement('button');
    btnAceptar.textContent = 'Aceptar';
    btnAceptar.style.padding = '8px 16px';
    btnAceptar.onclick = function () {
        document.body.removeChild(overlay);
        if (typeof callbackAceptar === 'function') callbackAceptar();
    };

    const btnCancelar = document.createElement('button');
    btnCancelar.textContent = 'Cancelar';
    btnCancelar.style.padding = '8px 16px';
    btnCancelar.onclick = function () {
        document.body.removeChild(overlay);
    };

    botones.appendChild(btnAceptar);
    botones.appendChild(btnCancelar);
    popup.appendChild(botones);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}