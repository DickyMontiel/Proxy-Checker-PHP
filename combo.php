<?php
    if($_POST['pag'] and $_POST['proxy'] and $_POST['tipo']){
        $pag = $_POST['pag'];
        $proxy = $_POST['proxy'];
        $tipo = $_POST['tipo'];

        $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, $pag);
                curl_setopt($ch, CURLOPT_PROXY, $proxy);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
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

        $resultado =    curl_exec($ch);

        

        if(curl_error($ch) or strpos($resultado, "Something went wrong") or strpos($resultado, "nginx") or strpos($resultado, "502 Bad Gateway") or strpos($resultado, "1005") or strpos($resultado, "Please complete the security check to access") or strpos($resultado, "https://www.google.com/recaptcha/api2/")){
            /*echo "<tr>";
                echo "<td><span style='color:red;'>".$proxy."</span></td>";
            echo "</tr>";*/
            echo $proxy." | Bad \n";
        }else{
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

        curl_close($ch);
    }
?>