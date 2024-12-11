const responsive = () => {
    let nav = document.getElementById('nav');
    nav.classList.toggle('responsive');
}

let links = document.querySelectorAll('#nav a');

links.forEach(a => {
    let idA = (a.innerHTML).replaceAll(" ", "");
    idA = idA.replaceAll("\n", "");
    a.setAttribute('id', idA);
    //a.href = `#${idA}`;
    a.onclick = function () {

        for (let i = 0; i < links.length; i++) {
            links[i].className = "";
        }

        a.className = "selected";

        let nav = document.getElementById('nav');
        nav.className = "nav";

        localStorage.setItem('selected', a.getAttribute("id"));
    }
});

if (localStorage.getItem('selected') != "") {
    let select = document.getElementById(localStorage.getItem('selected'));
    select.className = "selected";
}

// Funcion para copiar el correo del footer

const copyButton = document.querySelector(".email");

copyButton.addEventListener("click", () => {
    const correo = "informes@upvm.edu.mx";

    const temp = document.createElement("input");
    temp.type = "text";
    temp.value = correo;
    document.body.appendChild(temp);
    temp.select();
    document.execCommand("copy");
    document.body.removeChild(temp);
    Swal.fire({
        icon: 'info',
        title: 'Correo copiado',
        toast: true,
        position: 'bottom-end',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    });
});

const modal = (id, on) => {
    if (on) {
        document.getElementById(id).classList.add('onModal');
    } else {
        document.getElementById(id).classList.remove('onModal');
    }
}