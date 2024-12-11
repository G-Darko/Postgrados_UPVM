
const tab = (index) =>{
    let tabs = document.querySelectorAll('.tab');
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }
    tabs[index].style.display = "block";

    let btns = document.querySelectorAll('.tabs .btns button');
    for (let i = 0; i < btns.length; i++) {
        btns[i].classList.remove('active');
    }
    btns[index].classList.add('active');
}

tab(0);

const urlReq = 'ADMIN/api/investigador/';
const get_data = (id, niv) => {
    let fd = new FormData();
    fd.append('id', id);
    let request = new XMLHttpRequest();
    request.open('POST', `${urlReq}get_data.php`, true);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = JSON.parse(request.responseText);
            //console.log(request);
            document.getElementById('img').src = "ADMIN/" + response.img;
            document.getElementById('info').innerHTML = `
                <h2>${response.name} (${niv})</h2>
                <div class="dataP">
                    <h3>Licenciatura</h3> 
                    <div class="bd">${response.lic}</div>
                </div>
                <div class="dataP">
                    <h3>Correo</h3> 
                    <div class="bd">${response.co}</div>
                </div>
                <div class="dataP">
                    <h3>Maestria</h3> 
                    <div class="bd">${response.mae}</div>
                </div>
                <div class="dataP">
                    <h3>Doctorado</h3> 
                    <div class="bd">${response.doc}</div>
                </div>
                <div class="dataP">
                    <h3>Semblanza</h3> 
                    <div class="bd">${response.sam}</div>
                </div>
                `;
            modal('mView', true);
        }
    }
    request.send(fd);
}