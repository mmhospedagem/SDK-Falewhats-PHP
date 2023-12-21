<?php

namespace MMHospedagem\SDK\App\Api;

class Whatsapp {

    private $url;
    private $licenca;
    private $id_sessao;

    public function __construct($url,$id_sessao,$licenca) {

        $this->url = $url;
        $this->licenca = $licenca;
        $this->id_sessao = $id_sessao;

    }

    private function send($method,$resource,$request = []) {

        $endpoint = $this->url . $resource;

		$headers = [
			"Cache-Control: no-cache",
			"Content-type: application/json"
		];

		$curl = curl_init();

        curl_setopt_array($curl,[

        	CURLOPT_URL 			=> 	$endpoint,
            CURLOPT_RETURNTRANSFER 	=> 	true,
            CURLOPT_CUSTOMREQUEST 	=> 	$method,
            CURLOPT_HTTPHEADER 		=> 	$headers,
            CURLOPT_SSL_VERIFYHOST  =>  false,
            CURLOPT_SSL_VERIFYPEER  =>  false

        ]);

        switch ($method) {
        	case "POST":
        	case "PUT":

        		curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($request));
        		break;
        }

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response,true);

    }

    public function validar_numero($telefone) {

        $request    =   [
            "numero"   =>  $telefone
        ];

        return $this->send("POST","/{$this->id_sessao}/rest/consultas/{$this->licenca}/numero",$request);

    }

    public function sumular_presenca($telefone,$tipo) {

        $Numero_Recebedio   =   ltrim(preg_replace('/\D/', '', $telefone), 0);

        $validacaoNumero    =   self::VerificarNumeroValido($Numero_Recebedio);

        $request    =   [
            "numero"   =>  $telefone,
            "presenca"  =>  $tipo
        ];

        return $this->send("POST","/{$this->id_sessao}/rest/acoes/{$this->licenca}/presenca",$request);

    }

    public function sendText($numero,$texto) {

        $Numero_Recebedio = ltrim(preg_replace('/\D/', '', $telefone), 0);

        $validacaoNumero = self::validar_numero($Numero_Recebedio);

        if(($validacaoNumero["exists"] == true)) {

            if((strlen($Numero_Recebedio) < 5)) {
    
                return "[ERROR][{$Numero_Recebedio}] Não foi possivel enviar sua mensagem número de telefone invalido.";
    
            } else {
    
                $request    =   [
    
                    "messageData"   =>  [
                        "numero"    =>  str_replace("@s.whatsapp.net", "", ($validacaoNumero["jid"] != '' ? $validacaoNumero["jid"] : $Numero_Recebedio) ),
                        "text"  =>  html_entity_decode($texto)                   
                    ]
    
                ];
    
                // Envia uma simulação de presença para o whatsapp
                self::sumular_presenca(str_replace("@s.whatsapp.net", "", ($validacaoNumero["jid"] != '' ? $validacaoNumero["jid"] : $Numero_Recebedio) ),'composing');
    
                // Envia a mensagem para o whatsapp
                $send   =   $this->send("POST","/{$this->id_sessao}/rest/envio/{$this->licenca}/texto",$request);           
                
                if(($send["error"] != true)) {
        
                    return $send;
        
                } else {
        
                    return $send;
        
                }
    
                return $send;
    
            }

        }

    }

}