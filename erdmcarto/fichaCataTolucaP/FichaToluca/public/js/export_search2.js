export class search {
    //Construtor donde se reciben los parametros de busqueda
    constructor(mysearchc, ul_add_lic,buttonRedirect) {
        this.mysearch = mysearchc;
        this.ul_add_li = ul_add_lic;
        this.button=buttonRedirect;
    }
    //Funcion de buscar en bae al input definido
    InputSearch() {
        //Escuchando el evento del input
        this.mysearch.addEventListener("input", (e) => {
            e.preventDefault();
            try {
                //Extraemos el token generado en el front
                let token = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");
                //Declaracion del minimo de letras
                let minino_letras = 0;
                //Extraccion del valor en el input
                let valor = this.mysearch.value;
                //Condicion a ejecutar si los valores son mayores a 0 ejecutar
                if (valor.length > minino_letras) {
                    let datasearch = new FormData();
                    //Conversion del valor para enviar
                    datasearch.append("valor", valor);
                    //Envio por fetch a la ruta mediante el puglin ziggy laravel
                    fetch(route("search"), {
                        //Envio al header el token para la validacion que necesita laravel
                        headers: {
                            "X-CSRF-TOKEN": token,
                        },
                        method: "post",
                        //Envio del dato a buscar
                        body: datasearch,
                    })
                        //Recibimos el datoc como json
                        .then((data) => data.json())
                        //Mostramos en pantalla mediante la funcion showlist
                        .then((data) => {
                            this.Showlist(data, valor);
                        })
                        .catch(function (error) {
                            console.log("Error");
                        });
                }
                //si no que mande nada
                else {
                    this.ul_add_li.style.display = "";
                }
            } catch (error) {
                console.log("Error en:".error);
            }
        });
    }
    //Funcion showlist con parametro de la informacion para mostrarlo
    Showlist(data, valor) {
        //Monstramos en el apartado correspondiente y lo hacemos visible
        this.ul_add_li.style.display = "block";
        //Si el estado es igual a 1 que lo muestre (Proviene del controlador Componente)
        if (data.estado == 1) {
            //Si hay datos en la respuesta
            if (data.result != "") {
               
                //Muestre en pantalla el button
                this.button.style.visibility="inherit";
                //El mensaje de error se va a eliminar
                this.ul_add_li.style.display = "none";
            }
            //Si no que mande mensaje que no se encontro la cuenta
            else {
               
                //El boton siga invisble para el usuario
                this.button.style.visibility="hidden";
                //Se muestra un mensaje de no encontrado la cuenta
                this.ul_add_li.innerHTML = "";
                this.ul_add_li.innerHTML += `
                <div class="alert alert-danger mt-2 text-danger" role="alert">
                No se encontro la cuenta
                </div>`;
            }
        }
    }
}
