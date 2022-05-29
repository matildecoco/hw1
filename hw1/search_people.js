function onText(text){
    if(onText.value === 1){
        tastoSegui.value = "Ora segui l'utente";
    }
    else{
        tastoSegui.value = "Gia' segui l'utente";
    }
}




function onJSON(json)
{
    const boxUtenti = document.querySelector("#boxUtenti");
    boxUtenti.innerHTML = '';
    for(utente of json)
    {
        const boxUtente = document.createElement("div")
        boxUtente.classList.add("boxUtente");
        const nomeUtente = document.createElement("div");
        nomeUtente.classList.add("NomeUtente");
        nomeUtente.textContent = utente.nomeUtente;
        const immagine = document.createElement("img");
        immagine.classList.add("immagine");
        immagine.src = utente.immagine;
        const buttonBox = document.createElement("div");
        buttonBox.classList.add("buttonBox");
        const buttonFollow = document.createElement("input");
        buttonFollow.setAttribute("type", "submit");
        buttonFollow.setAttribute("value", "Segui");
        buttonFollow.setAttribute("name", nomeUtente.textContent);
        const testoSegui = document.createElement("span");
        testoSegui.classList.add("testoSegui");
        buttonBox.appendChild(buttonFollow);
        boxUtente.appendChild(immagine);
        boxUtente.appendChild(nomeUtente);
        boxUtente.appendChild(buttonBox);
        boxUtenti.appendChild(boxUtente);
        buttonFollow.addEventListener('click', seguiUtente);
    }
}

function onResponse(response){
    return response.json();
}

function onResponseSegui(response) {
    return response.text();
}


function cercaUtente(event){
    event.preventDefault();
    const form_cerca = {method: 'post', body: new FormData(formCerca)};    //Creo un oggetto che contiente il form cerca
    fetch(event.currentTarget.action, form_cerca).then(onResponse).then(onJSON); //Faccio una fetch dove richiamo do_search_people, senza cambiare pagina, gli passo direttamente il form data! Lui risponderà ecc.
   
}


function seguiUtente(event){
    event.preventDefault();
    tastoSegui = event.currentTarget;
    fetch("http://localhost/hw1/follower.php?seguito=" + tastoSegui.name).then(onResponseSegui).then(onText);
}

var tastoSegui;
const formCerca = document.querySelector('#ricercaUtente');
formCerca.addEventListener('submit', cercaUtente);
fetch("http://localhost/hw1/search_people_def.php").then(onResponse).then(onJSON)
