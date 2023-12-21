# SDK API Falewhats PHP

SDK desenvolvido para ajudar nossos clientes com integrações da API Whatsapp com seus projetos em PHP, o sistema foi desenvolvido para receber mensagens por URL deixaremos abaixo um exemplo de envio de mensagem de texto!

https://www.seudominio.com.br/suapasta/api.php?mensagem=texto&numero=556284879620&texto=Sua Mensagem

Configuração

Abra o arquivo config.php e altere as linhas abaixo conforme informações em nossa área do cliente

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Altere abaixo conforme sua necessidade
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$config = [
    "url" => "https://api.falewhats.com.br",
    "id_sessao" => "SEUID",
    "licenca" => "SUALICENCA"
];

SEUID = Altere para seu ID de sessão
SUALICENCA = Altere para o número da sua licença