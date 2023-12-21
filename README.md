# SDK API Falewhats PHP

<h4 align="center"> 
	SDK desenvolvido para ajudar nossos clientes com integrações da API Whatsapp com seus projetos em PHP. <br> O sistema foi desenvolvido para receber mensagens por URL. Deixaremos abaixo um exemplo de envio de mensagem de texto!
</h4>

```bash
# Como fica o "request" ou seja a url para envio.
https://www.seudominio.com.br/suapasta/api.php?mensagem=texto&numero=556284879620&texto=Sua Mensagem
```

Configuração

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Altere abaixo conforme sua necessidade
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

```bash
# Abra o arquivo config.php e altere as linhas abaixo conforme informações em nossa área do cliente
$config = [
    "url" => "https://api.falewhats.com.br",
    "id_sessao" => "SEUID",
    "licenca" => "SUALICENCA"
];
```
SEUID = Altere para seu ID de sessão
SUALICENCA = Altere para o número da sua licença

Feito com ❤️ por MMHospedagem 👋🏽 Entre em contato conosco!

<a href="https://www.mmhospedagem.com.br">
 <img style="border-radius: 50%;" src="https://www.mmhospedagem.com.br/templates/mmhospedagem/assets/imagens/logo-tipo.png" width="100px;" alt=""/>
 <br />
 <sub><b>Maik Venancio</b></sub></a> <a href="https://mmhospedagem.com.br" title="Voialá">🚀</a>
