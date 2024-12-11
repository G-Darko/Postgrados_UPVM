const urlRe = 'reload/investigador.php';
const urlReq = 'api/investigador/';

const newI = () => {
    let fd = new FormData();
    fd.append('name', document.getElementById('n-name').value);
    fd.append('lic', document.getElementById('n-lic').value);
    fd.append('mae', document.getElementById('n-mae').value);
    fd.append('doc', document.getElementById('n-doc').value);
    fd.append('co', document.getElementById('n-co').value);
    fd.append('sam', document.getElementById('n-sam').firstChild.innerHTML);
    fd.append('img', document.getElementById('n-img').files[0]);
    fd.append('niv', document.getElementById('n-niv').value);
    fd.append('div', document.getElementById('n-div').value);
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
                        text: 'El investigador se agregó correctamente',
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
            document.getElementById('e-lic').value = response.lic;
            document.getElementById('e-mae').value = response.mae;
            document.getElementById('e-doc').value = response.doc;
            document.getElementById('e-co').value = response.co;
            document.getElementById('e-sam').firstChild.innerHTML = response.sam;
            document.getElementById('ce-img').src = response.img;
            document.getElementById('e-niv').value = response.niv;
            document.getElementById('e-div').value = response.div;
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
            fd.append('lic', document.getElementById('e-lic').value);
            fd.append('mae', document.getElementById('e-mae').value);
            fd.append('doc', document.getElementById('e-doc').value);
            fd.append('co', document.getElementById('e-co').value);
            fd.append('sam', document.getElementById('e-sam').firstChild.innerHTML);
            fd.append('img', document.getElementById('e-img').files[0]);
            fd.append('niv', document.getElementById('e-niv').value);
            fd.append('div', document.getElementById('e-div').value);
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
                                text: 'El investigador se ha eliminado',
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