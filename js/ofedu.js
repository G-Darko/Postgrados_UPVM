const urlReq = 'ADMIN/api/maestria/';
const get_data = (id) => {
    let fd = new FormData();
    fd.append('id', id);
    let request = new XMLHttpRequest();
    request.open('POST', `${urlReq}get_data.php`, true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            //console.log(request);
            document.getElementById('mae').innerHTML = response.name;
            document.getElementById('img').src = "ADMIN/" + response.img;
            let op;
            if (response.op == ""){
                op = ""
            }else{
                op = `
                    <div class="data">
                            <h3 onclick="this.parentNode.classList.toggle('ondata')">
                                Opcion de Titulacion 
                                <span>+</span>
                            </h3>
                            <div class="bd">${response.op}</div>
                    </div>`;
            }
            document.getElementById('info').innerHTML = `
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Objetivo <span>+</span> </h3> 
                    <div class="bd">${response.ob}</div>
                </div>
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Perfil de Ingreso <span>+</span> </h3> 
                    <div class="bd">${response.pi}</div>
                </div>
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Requisitos de Ingreso <span>+</span> </h3> 
                    <div class="bd">${response.req}</div>
                </div>
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Perfil de Egreso <span>+</span> </h3> 
                    <div class="bd">${response.pe}</div>
                </div>
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Campo de Trabajo <span>+</span> </h3>
                    <div class="bd">${response.campo}</div>
                </div>
                <div class="data">
                    <h3 onclick="this.parentNode.classList.toggle('ondata')">Competencias <span>+</span> </h3>
                    <div class="bd">${response.compe}</div>
                </div>
                ${op}`;
            modal('mView', true);
        }
    }
    request.send(fd);
}