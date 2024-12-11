const urlRe = 'reload/maestria.php';
const urlReq = 'api/maestria/';

const newI = () => {
    let fd = new FormData();
    fd.append('name', document.getElementById('n-name').value);
    fd.append('ob', document.getElementById('n-ob').firstChild.innerHTML);
    fd.append('pi', document.getElementById('n-pi').firstChild.innerHTML);
    fd.append('req', document.getElementById('n-req').firstChild.innerHTML);
    fd.append('pe', document.getElementById('n-pe').firstChild.innerHTML);
    fd.append('campo', document.getElementById('n-campo').firstChild.innerHTML);
    fd.append('compe', document.getElementById('n-compe').firstChild.innerHTML);
    fd.append('img', document.getElementById('n-img').files[0]);
    fd.append('tipo', document.getElementById('n-tipo').value);
    fd.append('div', document.getElementById('n-div').value);
    fd.append('op', document.getElementById('n-op').firstChild.innerHTML);
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
                        text: 'La maestria se agregó correctamente',
                        toast: true,
                        position: 'top',
                        timer: 2000,
                        timerProgressBar: true
                    });
                    //window.location.reload();
                })(
                    reload(urlRe),
                    modal('mNew', false),
                    btnQN = false,
                    btnQE = false
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
            document.getElementById('e-ob').firstChild.innerHTML = response.ob;
            document.getElementById('e-pi').firstChild.innerHTML = response.pi;
            document.getElementById('e-req').firstChild.innerHTML = response.req;
            document.getElementById('e-pe').firstChild.innerHTML = response.pe;
            document.getElementById('e-campo').firstChild.innerHTML = response.campo;
            document.getElementById('e-compe').firstChild.innerHTML = response.compe;
            document.getElementById('ce-img').src = response.img;
            document.getElementById('e-tipo').value = response.tipo;
            document.getElementById('e-div').value = response.div;
            document.getElementById('e-op').firstChild.innerHTML = response.op;
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
            fd.append('ob', document.getElementById('e-ob').firstChild.innerHTML);
            fd.append('pi', document.getElementById('e-pi').firstChild.innerHTML);
            fd.append('req', document.getElementById('e-req').firstChild.innerHTML);
            fd.append('pe', document.getElementById('e-pe').firstChild.innerHTML);
            fd.append('campo', document.getElementById('e-campo').firstChild.innerHTML);
            fd.append('compe', document.getElementById('e-compe').firstChild.innerHTML);
            fd.append('img', document.getElementById('e-img').files[0]);
            fd.append('tipo', document.getElementById('e-tipo').value);
            fd.append('div', document.getElementById('e-div').value);
            fd.append('op', document.getElementById('e-op').firstChild.innerHTML);
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
                            modal('mEdit', false),
                            btnQN = false,
                            btnQE = false
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
                                text: 'La maestria se ha eliminado',
                                toast: true,
                                position: 'top',
                                timer: 2000,
                                timerProgressBar: true
                            });
                            //window.location.reload();
                        })(
                            reload(urlRe),
                            btnQN = false,
                            btnQE = false
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

// Funciones para crear los quills al tocar los botones de editar y agregar, evitando que se creen mas con las variables btn

let btnQN = false;
let btnQE = false;
const quillsN = () => {
    if (!btnQN) {
        const modal = document.querySelectorAll('#mNew .quill');
        modal.forEach(a => {
            id = a.getAttribute('id');
            nQuill(id)
        });
        // nQuill('n-ob');
        // nQuill('n-pi');
        // nQuill('n-req');
        btnQN = true;
    }
}
const quillsE = () => {
    if (!btnQE) {
        // nQuill('editor');
        const modal = document.querySelectorAll('#mEdit .quill');
        modal.forEach(a => {
            id = a.getAttribute('id');
            nQuill(id)
        });
        btnQE = true;
    }
}