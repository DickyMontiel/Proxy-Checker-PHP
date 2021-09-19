<?php
    if($_POST['pag'] and $_POST['proxy'] and $_POST['tipo']){
        $pag = $_POST['pag'];
        $proxy = $_POST['proxy'];
        $tipo = $_POST['tipo'];
        $arrayProxy = explode(":", $proxy);

        if(strpos($pag, "netflix.com") and strpos($pag, "/login")){
            $ip = $arrayProxy[0];

            $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://api.ipstack.com/".$ip."?access_key=7d74beceeae0ba004b2e06d89a3af8d4");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $resultado = curl_exec($ch);

            $response = json_decode($resultado, true);
            
            $codigoPais = $response['country_code'];

            $pag = "https://netflix.com/".$codigoPais."/login";
        }

        $customHeader = array(
            "accept: */*",
            "connection: keep-alive",
            "accept-language: es-419,es;q=0.9",
            "user-agent: PostmanRuntime/7.26.8"
        );

        $ch =   curl_init();
                set_time_limit(0);
                //ini_set('max_execution_time', 300);
                curl_setopt($ch, CURLOPT_URL, $pag);
                curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL , 1);
                curl_setopt($ch, CURLOPT_PROXY, $arrayProxy[0]);
                curl_setopt($ch, CURLOPT_PROXYPORT, $arrayProxy[1]);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
                curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
                curl_setopt($ch, CURLOPT_PROXYHEADER, $customHeader);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                curl_setopt($ch, CURLOPT_USERAGENT, "PostmanRuntime/7.26.8");
                if($tipo == "1"){
                    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
                }else if($tipo == "2"){
                    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTPS);
                }else if($tipo == "3"){
                    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
                }else if($tipo == "4"){
                    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $resultado = curl_exec($ch);

        //echo $resultado;

        
        //strpos($resultado, "https://www.google.com/recaptcha/api2/"
        if(curl_errno($ch) or strpos($resultado, "Please Wait... | Cloudflare") or strpos($resultado, "Comprueba que no eres un bot para tener acceso a") or strpos($resultado, "<title>Attention Required! | Cloudflare</title>") or strpos($resultado, "Something went wrong") or strpos($resultado, "nginx") or strpos($resultado, "502 Bad Gateway") or strpos($resultado, "1005") or strpos($resultado, "Please complete the security check to access")){
            /*echo "<tr>";
                echo "<td><span style='color:red;'>".$proxy."</span></td>";
            echo "</tr>";*/
            if(strpos($resultado, "<title>Attention Required! | Cloudflare</title>") or strpos($resultado, "Please Wait... | Cloudflare") or strpos($resultado, "Comprueba que no eres un bot para tener acceso a")){
                echo $proxy." | Bad By Cloudfare \n";

                //echo $resultado;
            }else if(curl_errno($ch)){
                echo $proxy." | Cant connect to proxy \n";
            }else{
                echo $proxy." | Bad proxy \n";
            }

            
        }else{
            //echo $resultado;
            /*echo "<tr>";
            echo "<td><span style='color:green;'>".$proxy."</span></td>";
            echo "</tr>";*/
            
            echo $proxy." | Live by DickyM Checker\n";
            if($tipo == "1"){
                $fp =   fopen("http.txt", "a+");
                fwrite($fp, $proxy."|".date("d")."/".date("m")."\n");
                fclose($fp);
            }else if($tipo == "2"){
                $fp =   fopen("https.txt", "a+");
                fwrite($fp, $proxy."|".date("d")."/".date("m")."\n");
                fclose($fp);
            }else if($tipo == "3"){
                $fp =   fopen("socks4.txt", "a+");
                fwrite($fp, $proxy."|".date("d")."/".date("m")."\n");
                fclose($fp);
            }else if($tipo == "4"){
                $fp =   fopen("socks5.txt", "a+");
                fwrite($fp, $proxy."|".date("d")."/".date("m")."\n");
                fclose($fp);
            }
        }
        
        //echo $resultado;
        curl_close($ch);
    }
?>