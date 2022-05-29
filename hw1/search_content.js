
function onTextShare(text){
  console.log(text);
}


function onResponseShare(response){
  return response.text();
}


function condividi(event){
    event.preventDefault();
    const inputInvio = event.currentTarget;
   //prendo il titolo del post
     const labelInvio = inputInvio.parentNode;
     const form = labelInvio.parentNode;
     const prendiTitolo = form.querySelector("input[name=titolo]");
     const titoloPost = encodeURIComponent(prendiTitolo.value);
     fetch("http://localhost/hw1/share_post.php?image=" + inputInvio.name + "&titolo=" + titoloPost).then(onResponseShare).then(onTextShare);
     
}




function onModalClick(event){
  const modalView = document.querySelector('#modalView');
  document.body.classList.remove('no-scroll');
  modalView.classList.add('hidden');
  modalView.innerHTML = '';

}


function modale(event){
  const buttonClick = event.currentTarget;
  const buttonBox = buttonClick.parentNode;
  const postBox = buttonBox.parentNode;
  const modalView = document.querySelector('#modalView');
  const immagine = document.createElement('img');
  const immagineClick = postBox.querySelector('.copertina');
  immagine.src = immagineClick.src;
  document.body.classList.add('no-scroll');
  modalView.style.top = window.pageYOffset + 'px';
  modalView.appendChild(immagine);
  const boxIcona = document.createElement('div');
  const chiudi = document.createElement('img');
  chiudi.src = "image/chiudi_icona.png";
  boxIcona.classList.add('boxIcona');
  chiudi.classList.add('chiudi');
  boxIcona.appendChild(chiudi);
  modalView.appendChild(boxIcona);
  chiudi.addEventListener('click', onModalClick); 
  //modalView.appendChild(titolo);
  const form = document.createElement('form');
  form.setAttribute('method', 'GET');
  const inputLabel = document.createElement('label');
  const invioLabel = document.createElement('label');
  const inputTesto = document.createElement('input');
  inputTesto.setAttribute('type', 'text');
  inputTesto.setAttribute('placeholder', 'Inserisci il testo');
  inputTesto.setAttribute('name', 'titolo');
  const inputInvio = document.createElement('input');
  inputInvio.setAttribute('type', 'submit');
  inputInvio.setAttribute('name', immagineClick.src);
  inputInvio.setAttribute('value', 'Condividi');
  inputLabel.appendChild(inputTesto);
  invioLabel.appendChild(inputInvio);
  form.appendChild(inputInvio);
  form.appendChild(inputTesto);
  modalView.appendChild(form);
  inputInvio.addEventListener('click', condividi);
  modalView.classList.remove('hidden');


}




function onJSON(json) {
    
    // Svuotiamo la libreria
    const library = document.querySelector('#boxPost');
    library.innerHTML = '';
    if(opzione === 'spotify') {
      console.log(json);
    // Leggi il numero di risultati
    const results = json.albums.items;
    let num_results = results.length;
    // Mostriamone al massimo 10
    if(num_results > 10) 
      num_results = 10;
    // Processa ciascun risultato
    for(let i=0; i<num_results; i++)
    {
      // Leggi il documento
      const album_data = results[i]
      // Leggiamo info
      const title = album_data.name; //nome album
      const selected_image = album_data.images[0].url; //immagine presa dall'album
      // Creiamo il div che conterrà immagine e didascalia
      const album = document.createElement('div');
      album.classList.add('album');
      // Creiamo l'immagine
      const img = document.createElement('img');
      img.src = selected_image;
      img.classList.add("copertina");
      // Creiamo la didascalia
      const caption = document.createElement('span');
      caption.classList.add("albumTitle");
      const buttonBox = document.createElement("div");
      buttonBox.classList.add("buttonBox");
      const buttonShare = document.createElement("input");
      buttonShare.setAttribute("type", "submit");
      buttonShare.setAttribute("value", "Condividi");
      buttonShare.setAttribute("name", selected_image);
      buttonShare.addEventListener('click', modale);
      caption.textContent = title;
      // Aggiungiamo immagine e didascalia al div
      album.appendChild(img);
      album.appendChild(caption);
      album.appendChild(buttonBox);
      buttonBox.appendChild(buttonShare);
      // Aggiungiamo il div alla libreria
      library.appendChild(album);
    }
  }

  else {
    console.log(json);
    // Leggi il numero di risultati
    const results = json.data;
    let num_results = json.pagination.total_count;
    // Mostriamone al massimo 10
    if(num_results > 10) 
      num_results = 10;
    // Processa ciascun risultato
    for(let i=0; i<num_results; i++)
    {
      // Leggi il documento
      const album_data = results[i];
      // Leggiamo info
      const title = album_data.title; //nome album
      const selected_image = album_data.images.downsized.url; //Mi da la gif inviabile
      // Creiamo il div che conterrà immagine e didascalia
      const album = document.createElement('div');
      album.classList.add('album');
      // Creiamo l'immagine
      const img = document.createElement('img');
      img.src = selected_image;
      img.classList.add('copertina');
      // Creiamo la didascalia
      const caption = document.createElement('span');
      caption.classList.add("albumTitle");
      const buttonBox = document.createElement("div");
      buttonBox.classList.add("buttonBox");
      const buttonShare = document.createElement("input");
      buttonShare.setAttribute("type", "submit");
      buttonShare.setAttribute("value", "Condividi");
      buttonShare.setAttribute("name", selected_image);
      buttonShare.addEventListener('click', modale);
      caption.textContent = title;
      // Aggiungiamo immagine e didascalia al div
      album.appendChild(img);
      album.appendChild(caption);
      album.appendChild(buttonBox);
      buttonBox.appendChild(buttonShare);
      // Aggiungiamo il div alla libreria
      library.appendChild(album);
    }
  }

}
 
function onResponse(response){
  return response.json();
}

function cercaContenuto(event){
    event.preventDefault();
    const form_cerca = {method: 'post', body: new FormData(formCerca)};
    opzione = formCerca.scelta.value;
    //console.log(opzione);
    fetch(event.currentTarget.action, form_cerca).then(onResponse).then(onJSON); 
}

var opzione;
const formCerca = document.querySelector('#ricercaPost');
formCerca.addEventListener('submit', cercaContenuto);