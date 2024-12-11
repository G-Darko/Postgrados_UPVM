const urlRe = 'reload/admin.php';
const urlReq = 'api/admin/';

const newI = () => {
    let fd = new FormData();
    fd.append('usu', document.getElementById('n-usu').value);
    fd.append('co', document.getElementById('n-co').value);
    fd.append('pass', document.getElementById('n-pass').value);
    fd.append('cpass', document.getElementById('n-cpass').value);
    fd.append('rol', document.getElementById('n-rol').value);
    let request = new XMLHttpRequest();
    request.open('POST', `${urlReq}new.php`, true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            // console.log(response);
            if (response.state) {
                (async () => {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Agregado',
                        text: 'El usuario se agregó correctamente',
                        toast: true,
                        position: 'top',
                        timer: 2000,
                        timerProgressBar: true
                    });
                    //window.location.reload();
                })(
                    reload(urlRe),
                    modal('mNew', false)
                );
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: (response.detail)
                });
            }
        }
    }
    request.send(fd);
}

const edit = (id) => {
    let fd = new FormData();
    fd.append('id', id);
    let request = new XMLHttpRequest();
    request.open('POST', `${urlReq}get_data.php`, true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            //console.log(request);
            document.getElementById("id").value = id;
            document.getElementById('e-usu').value = response.usu;
            document.getElementById('e-co').value = response.co;
            document.getElementById('e-rol').value = response.rol;
            modal('mEdit', true);
        }
    }
    request.send(fd);
}

const update = () => {
    Swal.fire({
        title: 'Confirmar',
        text: "Se van a actualizar los datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let fd = new FormData();
            fd.append('id', document.getElementById('id').value);
            fd.append('usu', document.getElementById('e-usu').value);
            fd.append('co', document.getElementById('e-co').value);
            fd.append('pass', document.getElementById('e-pass').value);
            fd.append('cpass', document.getElementById('e-cpass').value);
            fd.append('rol', document.getElementById('e-rol').value);
            let request = new XMLHttpRequest();
            request.open('POST', `${urlReq}update.php`, true);
            request.onload = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let response = JSON.parse(request.responseText);
                    if (response.state) {
                        (async () => {
                            await Swal.fire({
                                icon: 'success',
                                title: 'Actualizo',
                                text: 'Lo datos se actualizaron correctamente',
                                toast: true,
                                position: 'top',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            //window.location.reload();
                        })(
                            reload(urlRe),
                            modal('mEdit', false)
                        );
                    } else {
                        //alert(response.detail);
                        //Swal.fire(response.detail);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: (response.detail)
                        });
                    }
                }
            }
            request.send(fd);
        }
    })
}
const changeP = () => {
    Swal.fire({
        title: 'Confirmar',
        text: "Se va a cambiar la contraseña",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let fd = new FormData();
            fd.append('id', document.getElementById('id').value);
            fd.append('pact', document.getElementById('e-pact').value);
            fd.append('pass', document.getElementById('e-pass').value);
            fd.append('cpass', document.getElementById('e-cpass').value);
            let request = new XMLHttpRequest();
            request.open('POST', `${urlReq}changeP.php`, true);
            request.onload = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let response = JSON.parse(request.responseText);
                    if (response.state) {
                        (async () => {
                            await Swal.fire({
                                icon: 'success',
                                title: 'Actualizo',
                                text: 'Lo datos se actualizaron correctamente',
                                toast: true,
                                position: 'top',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            //window.location.reload();
                        })(
                            document.getElementById('e-pact').value = '',
                            document.getElementById('e-pass').value = '',
                            document.getElementById('e-cpass').value = '',
                            modal('mPass', false)
                        );
                    } else {
                        //alert(response.detail);
                        //Swal.fire(response.detail);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: (response.detail)
                        });
                    }
                }
            }
            request.send(fd);
        }
    })
}

const deleteI = (id) => {
    Swal.fire({
        title: '¿Seguro de eliminar?',
        text: "Esto no se podra revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let fd = new FormData();
            fd.append('id', id);
            let request = new XMLHttpRequest();
            request.open('POST', `${urlReq}delete.php`, true);
            request.onload = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let response = JSON.parse(request.responseText);
                    //console.log(request);
                    if (response.state) {
                        (async () => {
                            await Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El usuario se ha eliminado',
                                toast: true,
                                position: 'top',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            //window.location.reload();
                        })(
                            reload(urlRe)
                        );
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: (response.detail)
                        });
                    }
                }
            }
            request.send(fd);
        }
    })
}

// Manda a llamar la tabla y muestra un loader en lo que cargan todos los elementos (funciona con jquery)
window.onload = () => {
    reload(urlRe);
    $('.loader').fadeOut();

}

const btnPass = (s, p, bx) => {
    sp = document.getElementById(s);
    pass = document.getElementById(p);
    bxIcon = document.getElementById(bx);
    if (pass.type === 'password') {
        pass.type = 'text';
        bxIcon.removeAttribute('name');
        bxIcon.setAttribute('name', 'low-vision');
        sp.title = 'Ocultar Contraseña';
    } else {
        pass.type = 'password';
        bxIcon.removeAttribute('name');
        bxIcon.setAttribute('name', 'show-alt');
        sp.title = 'Mostrar Contraseña';
    }
}