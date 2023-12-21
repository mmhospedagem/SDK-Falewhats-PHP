# SDK API Falewhats PHP

<h4 align="left"> 
	SDK desenvolvido para ajudar nossos clientes com integrações da API Whatsapp com seus projetos em PHP. <br> O sistema foi desenvolvido para receber mensagens por URL. Deixaremos abaixo um exemplo de envio de mensagem de texto!
</h4>

```bash
# Como fica o "request" ou seja a url para envio.
https://www.seudominio.com.br/suapasta/api.php?tipo_mensagem=texto&numero=556284879620&mensagem=Sua Mensagem
```

<h4 align="left">Configuração</h4>

```bash
# Abra o arquivo config.php e altere as linhas abaixo conforme informações em nossa área do cliente
$config = [
    "url" => "https://api.falewhats.com.br",
    "licenca" => "SUALICENCA",
    "id_sessao" => "SEUID",
    "simular_presenca" => true
];
```
SEUID = Altere para seu ID de sessão<br>
SUALICENCA = Altere para o número da sua licença<br>
Se simular_presenca for definido como true o whatsapp ira simular digitando<br>

---
<a href="https://www.mmhospedagem.com.br">
    <img style="border-radius: 50%;" src="https://www.mmhospedagem.com.br/templates/mmhospedagem/assets/imagens/logo-tipo.png" width="100px;" alt=""/>
</a>
Feito com ❤️ por MMHospedagem 👋🏽 Entre em contato conosco!
