<?php

// SDK API Whatsapp MMHospedagem
// Desenvolvimento MMHospedagem
// Exemplo de URL: https://www.seudominio.com.br/suapasta/api.php?tipo_mensagem=texto&numero=556284879620&mensagem=Sua Mensagem

require_once(dirname(__FILE__) . "/App/mmhospedagem.php");
include_once(dirname(__FILE__) . "/config.php");

use MMHospedagem\SDK\App\Api\Whatsapp;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Não altere nada a partir daqui caso não entenda!
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$MMHospedagem_Classes = (new Whatsapp(
    $config["url"],
    $config["id_sessao"],
    $config["licenca"],
    $config["simular_presenca"]
));

if(($_GET["tipo_mensagem"] == "texto")) {

    $numero = $_GET["numero"];
    $texto = $_GET["mensagem"];

    $MMHospedagem_Classes->send_texto($numero,$texto);

}