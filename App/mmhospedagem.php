<?php

namespace MMHospedagem\SDK\App\Api;

class Whatsapp {

    private $url;
    private $licenca;
    private $id_sessao;
    private $simular_presenca;

    public function __construct($url,$id_sessao,$licenca,$simular_presenca) {

        $this->url = $url;
        $this->licenca = $licenca;
        $this->id_sessao = $id_sessao;
        $this->simular_presenca = $simular_presenca;

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

        $send = self::send("POST","/{$this->id_sessao}/rest/consultas/{$this->licenca}/numero",$request);

        self::log("[JSON][API][VERIFICAÇÃO DE NÚMERO]: " . json_encode($send));

        return $send;

    }

    public function sumular_presenca($telefone,$tipo) {

        $Numero_Recebedio   =   preg_replace('/\D/', '', $telefone);
        $validacaoNumero    =   self::validar_numero($Numero_Recebedio);

        $request    =   [
            "numero"   =>  $telefone,
            "presenca"  =>  $tipo
        ];

        $send = self::send("POST","/{$this->id_sessao}/rest/acoes/{$this->licenca}/presenca",$request);

        self::log("[JSON][API][SIMULAR PRESENÇA]: " . json_encode($send));

        return $send;

    }

    public function send_texto($telefone,$texto) {

        $Numero_Recebedio = preg_replace('/\D/', '', $telefone);

        $validacaoNumero = self::validar_numero($Numero_Recebedio);

        if(($validacaoNumero["exists"] == true)) {

            if((strlen($Numero_Recebedio) < 5)) {
    
                return "[ERROR][{$Numero_Recebedio}] Não foi possivel enviar sua mensagem número de telefone invalido.";
    
            } else {
    
                $request    =   [
    
                    "messageData"   =>  [
                        "numero"    =>  $validacaoNumero["jid"],
                        "text"  =>  html_entity_decode($texto)                   
                    ]
    
                ];
                
                if(($this->simular_presenca == true)) {
                    self::sumular_presenca($validacaoNumero["jid"],'composing');
                }
    
                $send = self::send("POST","/{$this->id_sessao}/rest/envio/{$this->licenca}/texto",$request);   
                
                self::log("[JSON][API][SEND MSG]: " . json_encode($send));
                    
                return $send;
    
            }

        }

    }

    public function log($mensagem, $arquivo = null) {

        $diretorio = dianame(__FILE__) . "/../Logs";
        
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
    
        if ($arquivo === null) {
            $arquivo = $diretorio . '/' . date('Y-m-d') . '.log';
        } else {
            $arquivo = $diretorio . '/' . $arquivo;
            $arquivoDiretorio = pathinfo($arquivo, PATHINFO_DIRNAME);
            if (!is_dir($arquivoDiretorio)) {
                mkdir($arquivoDiretorio, 0777, true);
            }
        }
    
        $dataHora = date('Y-m-d H:i:s');
        
        $mensagemFormatada = "[$dataHora] $mensagem" . PHP_EOL;

        $handle = fopen($arquivo, 'a');

        fwrite($handle, $mensagemFormatada);

        fclose($handle);

    }
    

}