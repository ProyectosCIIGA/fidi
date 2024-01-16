const zona1 = document.getElementById("dz1");
                
const preview = document.querySelector('.preview');

zona1.addEventListener("change", updateImageDisplay, false);

function handleFiles1() {
    const span1 = document.getElementById("sp1");
    const fileList = this.files.length;
    let text = "Archivos seleccionados " + fileList;
    span1.textContent = text;
    span1.hidden = false;
}

function removeFileFromFileList(index) {
    const dt = new DataTransfer()
    const input = document.getElementById('dz1')
    const { files } = input
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (index != i)
            dt.items.add(file) // here you exclude the file. thus removing it.
    }
    
    input.files = dt.files // Assign the updates list
    updateImageDisplay();
}

const fileTypes = [
  "image/png"
];

function validFileType(file) {
  return fileTypes.includes(file.type);
}

function updateImageDisplay() {
  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  const input = document.getElementById('dz1')
  const curFiles = input.files;
  if (curFiles.length === 0) {
    const para = document.createElement('p');

    para.textContent = 'Sin archivos seleccionados';
    preview.appendChild(para);
  } else {
  let indexImg = 0;
    for (const file of curFiles) {
      const divImg = document.createElement('div');
      const divBoton = document.createElement('div');
      divImg.className = "listaImg";
      divBoton.className = "zoneBoton";
      
      const para = document.createElement('p');

      const deleteBtn = document.createElement('label');
      deleteBtn.addEventListener("click", function(){
        removeFileFromFileList(this.id);
      } );

      deleteBtn.className = "btn btn-danger";
      deleteBtn.textContent = "Borrar";

      if (validFileType(file)) {
        para.textContent = `${file.name}`;
        const image = document.createElement('img');
        image.className = "imgSubir";
        image.height = "70";
        image.width = "70";
        image.title = "Click para ver imagen";
        image.src = URL.createObjectURL(file);

        image.addEventListener("click", function(){
            verFoto(this.src);
        } );
        //deleteBtn.id = 'imgD' + indexImg;
        deleteBtn.id = indexImg;

        divImg.appendChild(image);
        divImg.appendChild(para);

        divBoton.appendChild(deleteBtn)
        divImg.appendChild(divBoton);
        

      } else {
        let noValido = document.createElement('span');
        
        noValido.textContent = `Archivo con nombre ${file.name}: no es un tipo de archivo valido.`;
        noValido.className = "text-danger text-sm sc";
          
        deleteBtn.id = indexImg;
        
        divImg.appendChild(noValido);
        divImg.appendChild(deleteBtn);
      }
      preview.appendChild(divImg);
      indexImg++;

    }

  }
}
function verFoto(srcF){
    let modalFoto = document.getElementById('imgVisorFull');
    modalFoto.src = srcF;
    
    $("#visorFoto").modal('show');
}