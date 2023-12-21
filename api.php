<?php

// SDK API Whatsapp MMHospedagem
// Desenvolvimento MMHospedagem
// Exemplo de URL: https://www.seudominio.com.br/suapasta/api.php?mensagem=texto&numero=556284879620&texto=Sua Mensagem

require_once(dirname(__FILE__) . "/App/mmhospedagem.php");
include_once(dirname(__FILE__) . "/config.php");

use MMHospedagem\SDK\App\Api\Whatsapp;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Não altere nada a partir daqui caso não entenda!
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$MMHospedagem_Classes = (new Whatsapp(
    $config["url"],
    $config["id_sessao"],
    $config["licenca"]
));

if(($_GET["mensagem"] == "texto")) {

    $numero = $_GET["numer"];
    $texto = $_GET["texto"];

    $send = $MMHospedagem_Classes->sendText($numero,$texto);

    echo "<pre>";
    print_r($send);
    echo "</pre>";

    exit();

}

echo "Tipo de mensagem não existe!";
