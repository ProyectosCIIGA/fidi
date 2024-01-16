import {search} from './export_search.js'; //instanciamos la clase 
const mysearchc=document.querySelector("#mysearch");
const ul_add_lipc=document.querySelector("#showlist");
const buttonRedirect=document.querySelector("#buttonRedirect");
//Paso de parametros al constructor
const searchCuenta = new search(mysearchc,ul_add_lipc,buttonRedirect);
//Ejecucion de la funcion
searchCuenta.InputSearch();
