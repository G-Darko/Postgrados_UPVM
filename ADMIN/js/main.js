// Abre el sidebar
const showMenu = (toggleID, navbarID, bodyID) => {
    const toggle = document.getElementById(toggleID),
        navbar = document.getElementById(navbarID),
        body = document.getElementById(bodyID);

    if (toggle && navbar) {
        toggle.addEventListener('click', () => {
            navbar.classList.toggle('expand');

            body.classList.toggle('bodypd');
        });
    }
}

showMenu('toggle', 'side', 'body');

const link = document.querySelectorAll('.nav .link:not(.collapse):not(.no)');
const linkCollap = document.querySelectorAll('.collapse');
const sublink = document.querySelectorAll('.sublink');

// Funciones para que el sidebar recuerde que link esta activo 

link.forEach(a => {
    const name = a.querySelector('.name');
    let idA = (name.innerHTML).replaceAll(" ", "");
    idA = idA.replaceAll("\n", "");
    a.setAttribute('id', idA);
    a.onclick = () => {
        if ((localStorage.getItem('acCollap') != "") && (localStorage.getItem('isC') == 'true')) {
            let selectC = document.getElementById(localStorage.getItem('acCollap'));
            selectC.classList.remove("showCollap");
        }
        for (let i = 0; i < link.length; i++) {
            link[i].classList.remove('active');
        }
        for (let i = 0; i < linkCollap.length; i++) {
            linkCollap[i].classList.remove('active');
        }
        for (let i = 0; i < sublink.length; i++) {
            sublink[i].classList.remove('active');
        }
        a.classList.add('active');
        localStorage.setItem('active', a.getAttribute("id"));
        localStorage.setItem('isC', false);
    }
});

sublink.forEach(a => {
    const name = a.querySelector('.name');
    let idA = (name.innerHTML).replaceAll(" ", "");
    idA = idA.replaceAll("\n", "");
    a.setAttribute('id', idA);
    a.onclick = () => {
        for (let i = 0; i < sublink.length; i++) {
            sublink[i].classList.remove('active');
        }
        a.classList.add('active');
        localStorage.setItem('subactive', a.getAttribute("id"));
        localStorage.setItem('isC', true);
    }
});

linkCollap.forEach(a => {
    const name = a.querySelector('.name');
    let idA = (name.innerHTML).replaceAll(" ", "");
    idA = idA.replaceAll("\n", "") + 'coll';
    const collapMenu = a.nextElementSibling;
    collapMenu.setAttribute('id', idA);

    let idA2 = (name.innerHTML).replaceAll(" ", "");
    idA = idA2.replaceAll("\n", "");
    a.setAttribute('id', idA2);
});

for (let i = 0; i < linkCollap.length; i++) {

    linkCollap[i].isOpen = localStorage.getItem('isC');
    linkCollap[i].addEventListener('click', function () {
        const collapMenu = this.nextElementSibling;

        // Cerrar todos los demás menús
        for (let j = 0; j < linkCollap.length; j++) {
            if (j !== i && linkCollap[j].isOpen) {
                linkCollap[j].isOpen = false;
                linkCollap[j].nextElementSibling.classList.remove('showCollap');
                linkCollap[j].classList.remove('active');
            }
        }
        for (let i = 0; i < link.length; i++) {
            link[i].classList.remove('active');
        }

        // Abrir el menú actual
        this.isOpen = !this.isOpen;
        this.classList.toggle('active')
        collapMenu.classList.toggle('showCollap');
        localStorage.setItem('active', this.getAttribute("id"));
        localStorage.setItem('acCollap', collapMenu.getAttribute("id"));
        if (localStorage.getItem('isC') == 'true') {
            localStorage.setItem('isC', false);
        } else {
            localStorage.setItem('isC', true);
        }
    });
}

// Modal

const modal = (id, on) => {
    if (on) {
        document.getElementById(id).classList.add('onModal');
    } else {
        document.getElementById(id).classList.remove('onModal');
    }
}

// Recargar

let refresh = document.querySelector('#refresh');

const paginador = (p, url) => {
    let fd = new FormData();
    fd.append('page', p);
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.send(fd);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = request.responseText;
            //console.log(response);
            //console.log(refresh);
            document.getElementById('page').value = p;
            refresh.innerHTML = response;
        }
    }
}

const reload = (url) => {

    let fd = new FormData();
    fd.append('page', document.getElementById('page').value);
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.send(fd);
    request.onload = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = request.responseText;
            //console.log(response);
            //console.log(refresh);
            refresh.innerHTML = response;
        }
    }
}

// Funciones para quill

let quill;

let toolbarOptions = [
    //['blockquote', 'code-block'],
    //[{ 'header': 1 }, { 'header': 2 }],
    //[{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
    [{ 'font': [] }],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'align': [] }],
    ['link', 'image'],
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],
    //[{ 'size': ['small', false, 'large', 'huge'] }], 
    [{ 'color': [] }, { 'background': [] }],
    ['clean']
];

const nQuill = (id) => {
    let quill = new Quill(`#${id}`, {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    const botones = document.querySelectorAll(".ql-toolbar button");

    botones.forEach((boton) => {
        let clase = boton.classList[0].replace("ql-", "");
        let pLetra = clase.charAt(0).toUpperCase();
        boton.title = pLetra + clase.slice(1);
    });

    const pick = document.querySelectorAll(".ql-picker");

    pick.forEach((boton) => {
        let clase = boton.classList[0].replace("ql-", "");
        let pLetra = clase.charAt(0).toUpperCase();
        boton.title = pLetra + clase.slice(1);
    });
    return quill;
}

const subir = (inFile) => {
    let file = document.getElementById(inFile);
    file.click();
}

const imagenChange = (files, imgs, ruta) => {
    const file = document.querySelector("#" + files),
        img = document.querySelector("#" + imgs);

    const archivos = file.files;

    if (!archivos || !archivos.length) {
        img.src = ruta;
        return;
    }

    const primerArchivo = archivos[0];
    const objectURL = URL.createObjectURL(primerArchivo);
    img.src = objectURL;
}

// Llamar variables del LocalStorage 

if (localStorage.getItem('active') != "") {
    let select = document.getElementById(localStorage.getItem('active'));
    select.classList.add("active");
}
if ((localStorage.getItem('acCollap') != "") && (localStorage.getItem('isC') == 'true')) {
    let selectC = document.getElementById(localStorage.getItem('acCollap'));
    selectC.classList.add("showCollap");
}
if ((localStorage.getItem('subactive') != "") && (localStorage.getItem('isC') == 'true')) {
    let selectSub = document.getElementById(localStorage.getItem('subactive'));
    selectSub.classList.add("active");
}