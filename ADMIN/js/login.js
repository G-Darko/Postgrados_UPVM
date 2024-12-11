const log = document.getElementById('log');
const sp = document.getElementById('sp');

const user = document.getElementById('user');
const pass = document.getElementById('pass');
const bxIcon = document.getElementById('bxIcon');

sp.onclick = function () {
    if (pass.type === 'password') {
        pass.type = 'text';
        bxIcon.removeAttribute('name');
        bxIcon.setAttribute('name', 'low-vision');
        this.title = 'Ocultar Contraseña';
    } else {
        pass.type = 'password';
        bxIcon.removeAttribute('name');
        bxIcon.setAttribute('name', 'show-alt');
        this.title = 'Mostrar Contraseña';
    }
}

log.onclick = () => {
    let fd = new FormData();
    fd.append('user', document.getElementById('user').value);
    fd.append('pass', document.getElementById('pass').value);
    let request = new XMLHttpRequest();
    request.open('POST', 'api/sesion.php', true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            // console.log(request);
            if (response.state) {
                window.location.href = "dashboard.php"
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Hubo un error',
                    text: (response.detail)
                });
            }
        }
    }
    request.send(fd);
}

user.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        pass.focus();
    }
});
pass.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        log.click();
    }
});