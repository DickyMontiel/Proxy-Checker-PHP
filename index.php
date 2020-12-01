<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Sriracha&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Checker Proxy: DickyM</title>
</head>
<body>
    <div class="center">
        <div class="formulario">
            <center><h1 onload="changeColor()" id="textChangeColor"><span class="underline">Checker Proxies</span> - <span class="underline">By DickyM</span></h1></center>
            <p>Web para Probar Proxy:</p>
            <center><input type="text" id="pag" value="" placeholder="https://example.com"></center>
            <p>Tipo de Proxy:</p>
            <center><select id="select" style="" placeholder="127.0.0.1:8080">
                <option value="1">HTTP</option>
                <option value="2">HTTPS</option>
                <option value="3">SOCKS4</option>
                <option value="4">SOCKS5</option>
            </select></center>
            <p>Combo Proxy:</p>
            <center><textarea id="accounts" style="height:200px;" placeholder="127.0.0.1:8080"></textarea></center>
            <center><button onclick="parse_accounts()">Check</button></center>
        </div>
    </div>
    <hr>
    <center>
        <h1 style="text-align: left; color: green;">Good</h1>
        <textarea id="resultado" style="height: 300px;"></textarea>
        <h1 style="text-align: left; color: red;">Bad</h1>
        <textarea id="bad" style="height: 300px;"></textarea>
    </center>
    <br><br><br><br><br><br>
    <script src="combo.js"></script>
</body>
</html>