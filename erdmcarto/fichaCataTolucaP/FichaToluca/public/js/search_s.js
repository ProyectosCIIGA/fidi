import {search} from './export_search2.js'; //instanciamos la clase 
const mysearchc=document.querySelector("#mysearch2");
const ul_add_lipc=document.querySelector("#showlist2");
const buttonRedirect=document.querySelector("#buttonRedirect2");
//Paso de parametros al constructor
const searchCuenta = new search(mysearchc,ul_add_lipc,buttonRedirect);
//Ejecucion de la funcion
searchCuenta.InputSearch();
