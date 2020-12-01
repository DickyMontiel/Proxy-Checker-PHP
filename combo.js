//Este Script lo hice hace meses, es facil de explicar
function parse_accounts(){
    //Guardamos el elemento accounts
    var accounts = document.getElementById("accounts").value;

    //Funcion para separar las lineas
    accounts = accounts.split("\n");
    //Hacer un ForEach mientas accounts tenga slots, el resultado se enviara a la funcion check
    //y el parametro que se envia es el valor del slot en el array 
    accounts.forEach(check);
}

function check(proxy){
    
    var proxys = document.getElementById("accounts");

    //Guardamos el elemento resultado
    var resultado = document.getElementById("resultado");
    var bad = document.getElementById("bad");
    var pag = document.getElementById("pag").value;
    var tipo = document.getElementById("select").value;

    var post = "proxy=" + proxy + "&tipo=" + tipo + "&pag=" + pag;

    //Creamos una variable de peticion
    var query;
    
    //Adaptamos AJAX en IE y  otros buscadores
    if(window.XMLHttpRequest){
        query = new XMLHttpRequest;
    }else{
        query = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //Usamos el metodo onready state para hacer una funcion si, y solo si se ha realizado la peticion al 100%
    query.onreadystatechange = function(){
        if(query.readyState == 4 && query.status == 200){
            //Le integramos mas datos a la salida...
            var respuesta = query.responseText;

            if(respuesta.indexOf(" | Live") != -1){
                resultado.innerHTML += respuesta;
            }else{
                bad.innerHTML += respuesta;
            }

            proxy = proxy + "\n";
            proxys.value = proxys.value.replace(proxy, "");

        }
    }

    //Usamos el metodo post para enviar hacia un archivo php "combo.php"
    query.open("POST", "combo.php", true);
    query.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    query.send(post);

}