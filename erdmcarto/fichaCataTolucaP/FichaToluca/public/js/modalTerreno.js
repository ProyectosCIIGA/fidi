

//Escuchamos el evento desde el bton y mandamos los datos de la tabla al modal en el input indicado
$(document).on("click", "#btnmodal", function () {
  
    var supterreno = $(this).data("supterreno");
    var frente1 = $(this).data("frente1");
    var frente2 = $(this).data("frente2");
    var fondo1 = $(this).data("fondo1");
    var fondo2 = $(this).data("fondo2");
    var posicion1 = $(this).data("posicion1");
    var posicion2 = $(this).data("posicion2");
    var topografia = $(this).data("topografia");
    var irreg = $(this).data("irreg");
    var area = $(this).data("area");
    var supaprob = $(this).data("supaprob");
    var factor = $(this).data("factor");
    var bv = $(this).data("bv");
    var ah = $(this).data("ah");
    
   
    $("#supTerrenoM2").val(supterreno);
    $("#frente1M2").val(frente1);
    $("#frente2M2").val(frente2);
    $("#fondo1M2").val(fondo1);
    $("#fondo2M2").val(fondo2);
    $("#posicion1M2").val(posicion1);
    $("#posicion2M2").val(posicion2);
    $("#topografiaM2").val(topografia);
    $("#irregM2").val(irreg);
    $("#areaM2").val(area);
    $("#supaprobM2").val(supaprob);
    $("#factorM2").val(factor);
    $("#bvM2").val(bv);
    $("#ahM2").val(ah);
    
   
})