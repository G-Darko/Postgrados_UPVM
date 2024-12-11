const urlRe = 'reload/tipo.php'; 
const urlReq = 'api/tipo/'; 

const newI = () => {
    let fd = new FormData();
    fd.append('name', document.getElementById('n-name').value);
    let request = new XMLHttpRequest();
    request.open('POST', `${urlReq}new.php`, true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            //console.log(request);
            if (response.state) {
                (async () => {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Agregado',
                        text: 'El tipo se agregó correctamente',
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
            document.getElementById('e-name').value = response.name;
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
            fd.append('name', document.getElementById('e-name').value);
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
                                text: 'El tipo se ha eliminado',
                                toast: true,
                                position: 'top',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            //window.location.reload();
                        })(reload(urlRe));
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