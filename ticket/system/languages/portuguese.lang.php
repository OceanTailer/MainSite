<?php
namespace sts;


class lang {

	private $lang_array = array();

	function __construct() {
	
		$language_array['Add'] 									= 'Adicionar';
		$language_array['Edit'] 								= 'Editar';
		$language_array['Save'] 								= 'Salvar';
		$language_array['Cancel'] 								= 'Cancelar';
		$language_array['Delete'] 								= 'Deletar';
		$language_array['Yes'] 									= 'Sim';
		$language_array['No'] 									= 'Não';
		$language_array['On'] 									= 'On';
		$language_array['Off'] 									= 'Off';

		$language_array['Guest Portal'] 						= 'Área Visitante';
		$language_array['Tickets'] 								= 'Tickets';
		$language_array['Login'] 								= 'Login';
		$language_array['Logout'] 								= 'Sair';
		$language_array['Home'] 								= 'Home';
		$language_array['Welcome'] 								= 'Bem vindo';
		$language_array['Profile'] 								= 'Perfil';
		$language_array['Users'] 								= 'Usuários';
		$language_array['User'] 								= 'Usuário';
		$language_array['Settings'] 							= 'Configurações';
		$language_array['Email'] 								= 'E-mail';
		$language_array['Register'] 							= 'Registrar';

		$language_array['Name'] 								= 'Nome';
		$language_array['Username'] 							= 'Username';
		$language_array['Password'] 							= 'Senha';
		$language_array['Password Again'] 						= 'Nova Senha';

		$language_array['Forgot Password'] 						= 'Esqueci a Senha';
		$language_array['Create Account'] 						= 'Criar Conta';
		$language_array['Login Failed'] 						= 'Login Falhou';
		
		$language_array['Departments'] 							= 'Departamentos';
		$language_array['Priorities'] 							= 'Prioridades';
		$language_array['AD'] 									= 'AD';
		$language_array['Plugins'] 								= 'Plugins';
		$language_array['View Log'] 							= 'Ver Log';
		$language_array['Log'] 									= 'Log';
		$language_array['Logs'] 								= 'Logs';
		$language_array['All login attempts are logged.']		= 'Todas as tentativas de login são registradas.';
		
		$language_array['You must have an account before you can submit a ticket. Please register here.'] = 
		'Voc� precisa estar registrado antes de enviar um Ticket. Por favor, registre-se aqui.';
		
		$language_array['Account Registration Is Disabled.']	= 'O Registo de Conta estão Desativado.';

		$language_array['Ticket']								= 'Ticket';
		$language_array['Edit Ticket']							= 'Editar Ticket';
		$language_array['View Ticket']							= 'Ver Ticket';

		$language_array['Gravatar']								= 'Gravatar';

		$language_array['Change Password']						= 'Mudar Senha';
		$language_array['Current Password']						= 'Senha Atual';

		$language_array['Email Notifications']					= 'Notificações por E-mail';

		$language_array['New Password']							= 'Nova Senha';
		$language_array['New Password Again']					= 'Confirme a Nova Senha';

		$language_array['Profile Updated']						= 'Perfil Atualizado';

		$language_array['New Ticket']							= 'Novo Ticket';
		$language_array['Permissions']							= 'Permissões';

		$language_array['Status']								= 'Status';
		$language_array['Priority']								= 'Prioridade';
		$language_array['Submitted By']							= 'Enviado por';
		$language_array['Assigned User']						= 'Responsável';
		$language_array['Department']							= 'Departamento';
		$language_array['Added']								= 'Registros';
		$language_array['Updated']								= 'Atualizado';
		$language_array['ID']									= 'ID';

		$language_array['User Details']							= 'Detalhes de Usuário';
		$language_array['Phone']								= 'Fone';
		$language_array['Files']								= 'Arquivos';

		$language_array['Notes']								= 'Notas';
		$language_array['Add Note']								= 'Adicionar Nota';
		$language_array['Attach File']							= 'Anexar Arquivo';
		$language_array['Close Ticket']							= 'Fechar Ticket';
		
		$language_array['ago']									= 'atrás';

		$language_array['Open']									= 'Aberto';
		$language_array['Closed']								= 'Fechado';

		$language_array['Search']								= 'Pesquisar';
		$language_array['Sort By']								= 'Listar Por';
		$language_array['Sort Order']							= 'Ordenar Por';
		$language_array['Assigned']								= 'Responsável';

		$language_array['Ascending']							= 'Crescente';
		$language_array['Descending']							= 'Decrescente';

		$language_array['Close']								= 'Fechar';
		$language_array['Filter']								= 'Filtrar';
		$language_array['Clear']								= 'Apagar';
		
		$language_array['Failed To Create Account']				= 'Falha ao Criar a Conta';
		$language_array['Passwords Do Not Match']				= 'As Senhas não Conferem';
		$language_array['Username Invalid']						= 'Username Inválido';
		$language_array['Email Address In Use']					= 'Este e-mail já esta em uso';
		$language_array['Email Address Invalid']				= 'E-mail Inválido';
		$language_array['Please Enter A Name']					= 'Por favor, Entre com o Nome';
		$language_array['Account Registration Is Disabled.']	= 'O Registro de Conta está Desativado.';
		$language_array['Create a Support Ticket']				= 'Criar um Ticket de Suporte';
		$language_array['Page Limit']							= 'Limite de Páginas';
		
		$language_array['The database needs upgrading before you continue.']	= 'O Banco de Dados precisa de atualização antes de continuar.';
		
		$language_array['Upgrade']								= 'Upgrade';
		$language_array['Open Tickets']							= 'Tickets Abertos';
		$language_array['Copyright']							= 'Copyright';
		$language_array['This ticket is from a user without an account.'] = 'Este ticket é de um usuário sem uma conta.';

		$language_array['Subject']								= 'Assunto';
		$language_array['Description']							= 'Descrição';
		$language_array['Subject Empty']						= 'Assunto Vazio';
		$language_array['File Upload Failed. Ticket Not Submitted.']						= 'Falha de Upload de arquivos. Ticket não Enviado.';

		$language_array['Description']							= 'Descrição';
		$language_array['IP Address']							= 'Endereço de IP';
		$language_array['This page displays the last 100 events in the system.']	= 'Esta página exibe os últimos 100 eventos no sistema.';
		
		$language_array['Show All']								= 'Ver Todos';

		$language_array['Item']									= 'Item';
		$language_array['Value']								= 'Valor';

		$language_array['Severity']								= 'Gravidade';
		$language_array['Type']									= 'Tipo';
		$language_array['Source']								= 'Fonte';
		$language_array['User ID']								= 'Usuário ID';
		$language_array['Reverse DNS Entry']					= 'Reverter entrada de DNS';
		$language_array['File']									= 'Arquivo';
		$language_array['File Line']							= 'Linha do Arquivo';
		
		$language_array['Are you sure you wish to delete this ticket?']							= 'Tem certeza de que deseja apagar este ticket?';
		
		$language_array['Selected Tickets']						= 'Aplicar ação abaixo no(s) Ticket(s) Selecionado(s)';
		$language_array['No Tickets Found.']					= 'Tickets não encontrados.';

		$language_array['Previous']								= 'Anterior';
		$language_array['Next']									= 'Próxima';
		$language_array['Page']									= 'Página';

		$language_array['Toggle']								= 'Alternar';
		$language_array['Do']									= 'OK';
		$language_array['New Guest Ticket']						= 'Novo Ticket de visitante';

		$language_array['Address']								= 'Endereço';
		$language_array['Authentication Type']					= 'Tipo de Autenticação';


		$language_array['Program Version']						= 'Versão do Programa';
		$language_array['Database Version']						= 'Versão do Bando de Dados';

		$language_array['There is a software update available.'] = 'Existe uma atualização de software disponível.';

		$language_array['More Information']						= 'Mais Informações';
		$language_array['Settings Saved']						= 'Configurações Salvas';
		$language_array['Site Settings']						= 'Configurações do Site';

		$language_array['View Guest Ticket']					= 'Ver Ticket do visitante';
		$language_array['Unable to reset password.']			= 'Não foi possível redefinir a senha.';
		$language_array['An email with a reset link has been sent to your account.']			= 'Enviamos um e-mail com um link para redefinir a senha de sua conta.';
		
		$language_array['Request Reset']						= 'Pedir Redefinição';

		$language_array['If you have forgotten your password you can reset it here.'] = 'Se você esqueceu sua senha, poderá redefini-la aqui.';
		$language_array['An email will be sent to your account with a reset password link. Please follow this link to complete the password reset process.'] = 'Um e-mail será enviado para a sua conta com um link de redefinição de senha. Por favor, clique neste link para completar o processo de redefinição de senha.';

		$language_array['Update Info']							= 'Atualizar Info';
		$language_array['Update Information']					= 'Atualizar informações';
		$language_array['Installed Version']					= 'Versão Instalada';
		$language_array['Available Version']					= 'Versão Disponível';
		
		$language_array['Download']								= 'Download';
		$language_array['No updates found.']					= 'Nenhuma atualização encontrada.';


		$language_array['Submitter']							= 'Emissor';
		$language_array['Administrator']						= 'Administrador';
		$language_array['Plus User']							= 'Usuário Plus';
		$language_array['Moderator']							= 'Moderador';

		$language_array['Edit User']							= 'Editar Usuário';		
		$language_array['View User']							= 'Ver Usuário';

		$language_array['Local']								= 'Local';
		$language_array['Active Directory']						= 'Active Directory';
		
		$language_array['Add User']								= 'Adicionar Usuário';
		$language_array['New User']								= 'Novo Usuário';
		
		$language_array['Full Name']							= 'Nome Completo';
		
		$language_array['Email (recommended)']					= 'E-mail (recomendado)';
		$language_array['Phone (optional)']						= 'Fone (opcional)';
		$language_array['Address (optional)']					= 'Endereço (opcional)';

		$language_array['Name Empty']							= 'Nome - Vazio';
		$language_array['Username Empty']						= 'Username - Vazio';
		$language_array['Password Empty']						= 'Senha - Vazio';
		$language_array['Username In Use']						= 'Username em uso';

		$language_array['Passwords Do Not Match']				= 'As Senhas não conferem';
		$language_array['Password (if blank the password is not changed)']				= 'Senha (se a senha estiver em branco não é alterada.)';

		$language_array['Version']								= 'Versão';
		$language_array['Disabled']								= 'Desativado';
		$language_array['Enabled']								= 'Ativo';

		$language_array['This page upgrades the database to the latest version.'] = 'Esta página atualiza o banco de dados para a versão mais recente.';

		$language_array['Your database is currently up to date and does not need upgrading.'] = 'Seu banco de dados está atualmente em dia e não precisa de atualização';

		$language_array['Upgrade Complete.']					= 'Atualização completa.';

		$language_array['Please ensure you have a full database backup before continuing.']	= 'Por favor, certifique-se que tenha um backup completo antes de continuar.';
	
		$language_array['Start Upgrade']						= 'Iniciar Atualização';
		$language_array['Site Name']							= 'Nome do Site';
		$language_array['Domain Name (e.g example.com)']		= 'Nome de domínio  (ex. dominio.com)';
		$language_array['Script Path (e.g /sts)']				= 'Caminho do script (ex. /sts)';
	
		$language_array['Port Number (80 for HTTP and 443 for Secure HTTP are the norm)']				= 'Número da porta (80 para HTTP e 443 para HTTP seguro é a norma)';

		$language_array['Secure HTTP (recommended, requires SSL certificate)']		= 'HTTP seguro (recomendado, exige certificado SSL)';

		$language_array['Default Language']						= 'Idioma padrão';
		$language_array['Site Options']							= 'Opções do Site';
		$language_array['HTML & WYSIWYG Editor']				= 'Editor HTML & WYSIWYG';
		$language_array['Account Protection (user accounts are locked for 15 minutes after 5 failed logins)']	= 'Proteção da conta (contas de usuário são bloqueadas por 15 minutos após 5 falhas de logins)';
		
		$language_array['Login Message']						= 'Mensagem para exibição na página de Login.';
		$language_array['Account Registration Enabled']			= 'Registro de Novas Contas - Área do Portal';

		$language_array['Gravatar Enabled']						= 'Gravatar Ativado';
		$language_array['File Storage Enabled (for file attachments)']	= 'Pasta de armazenamento Ativada (para arquivos anexos)';

		$language_array['File Storage Path (must be outside the public web folder e.g./home/sts/files/ or C:\sts\files\)']						= 'Caminho de armazenamento de arquivos (deve ser fora da pasta "public_html". Pode ser por ex. /home/sts/arquivos/ ou C:\sts\arquivos\)';

		$language_array['Ticket Settings']						= 'Ticket Configurações';
		$language_array['Ticket Settings Saved']				= 'Ticket Configurações Salvas';
		
		$language_array['Are you sure you wish to delete this user?'] = 'Tem certeza de que deseja excluir este usuário?';

		$language_array['General Settings']						= 'Configurações Gerais';
		$language_array['Reply/Notifications for Anonymous Tickets (sends emails to non-users)'] = 'Responder / Notificações para tickets anônimos (envia e-mails para não-usuários)';

		$language_array['Guest Portal Text']					= 'Texto - Portal Visitante';
		
		$language_array['Please note that removing priorities that are in use will leave tickets without a priority.']					= 'Por favor, note que a remoçao de prioridades que estão em uso, irá deixar Tickets sem uma prioridade.';

		$language_array['Please note that removing departments that are in use will leave tickets without a department.']				= 'Por favor, note que a remoção de departamentos que estão em uso, irá deixar Tickets sem um departamento.';

		$language_array['Default Department cannot be deleted.']				= 'Departamento padrão não pode ser excluído.';

		$language_array['You cannot delete yourself.']							= 'Você não pode excluir-se.';
		
		$language_array['Note: LDAP is required for this function to work.']	= 'Nota: LDAP é necessário para esta função funcionar.';

		$language_array['Server (e.g. dc.example.local or 192.168.1.1)']		= 'Servidor (ex. dc.exemplo.local ou 192.168.1.1)';
		$language_array['Account Suffix (e.g. @example.local)']					= 'Conta Sufixo (ex. @exemplo.local)';
		$language_array['Base DN (e.g. DC=example,DC=local)']					= 'Base DN (ex. DC=examplo,DC=local)';
		$language_array['Create user on valid login']							= 'Criar usuário no login válido';

		$language_array['Plugins can be used to add extra functionality to Tickets.']							= 'Plugins podem ser usados para adicionar funcionalidades extras ao sistema de Tickets.';
		$language_array['Please ensure that you only install trusted plugins.']							= 'Certifique-se que você só instalará plugins confiáveis.';

		$language_array['Email Settings']										= 'E-mail Configurações';
		$language_array['Cron has been run.']									= 'Cron foi executado.';

		$language_array['Please ensure that you have the cron system setup, otherwise emails will not be sent or downloaded.'] = 'Certifique-se que você tenha a configuração do sistema cron. Caso contrário, os e-mails não serão enviados ou baixados.';

		$language_array['Run Cron Manually']									= 'Executar o Cron manualmente';
		$language_array['Test Email']											= 'E-mail de teste';
		$language_array['Email Address']										= 'End. de E-mail';
		$language_array['Send Test']											= 'Enviar Teste';

		$language_array['Outbound SMTP Server']									= 'Servidor de saída SMTP';
		$language_array['SMTP Enabled']											= 'SMTP Ativado';
		$language_array['Server']												= 'Servidor';
		$language_array['Port']													= 'Porta';
		$language_array['TLS']													= 'TLS';
		$language_array['Outgoing Email Address']								= 'Endereço de e-mail de saída';
		$language_array['SMTP Authentication']									= 'Autenticação SMTP';

		$language_array['POP3 Accounts']										= 'Contas POP3';
		$language_array['Hostname']												= 'Servidor';

		$language_array['Email Notification Templates']							= 'Templates para Notificações de E-mail';
		$language_array['Body']													= 'Mensagem';
		$language_array['New Ticket Note']										= 'Nova anotação no Ticket';
	

		$language_array['Add POP Account']										= 'Adicionar Conta POP';
		$language_array['Add Account']											= 'Adicionar Conta';
		$language_array['Edit Account']											= 'Editar Conta';

		$language_array['No POP3 Accounts Are Setup.']							= 'Nenhuma conta POP3 instalada.';

		$language_array['Name (nickname for this account)']						= 'Nome (Nome de identificação para esta conta)';
		$language_array['Hostname (i.e mail.example.com)']						= 'Servidor (ex. mail.dominio.com)';
		$language_array['TLS (required for gmail and other servers that use SSL)']	= 'TLS (necessário para os servidores do Gmail e outros que usam SSL)';
		
		$language_array['Port (default 110)']									= 'Porta (padrão 110)';
	
		$language_array['Download File Attachments']							= 'Download Arquivo Anexos';
		$language_array['Leave Message on Server']								= 'Deixar mensagem no servidor';

		$language_array['Adding a POP account allows the system to download emails from the POP account and convert them into Tickets.'] = 'Adicionando uma conta POP permite que o sistema baixe e-mails da conta POP para converte-los em Tickets.';
		$language_array['The system will match email address to existing users and attach emails to ticket notes if the email is part of an existing ticket.'] = 'O sistema corresponde ao endereço de e-mail para os usuários existentes e anexa e-mails para as notas do Ticket se o e-mail faz parte de um ticket existente.';
		$language_array['The Department and Priority options are only used when creating a new ticket and not when attaching an email to an existing ticket.']								= 'O Departamento e opções de prioridade são usados apenas quando a criação de um novo ticket, e não ao anexar um e-mail para um ticket existente.';

		$language_array['Are you sure you wish to delete this POP3 Account?']	= 'Tem certeza de que deseja apagar esta conta POP3?';

		$language_array['Test Email Failed. View the logs for more details.']	= 'E-mail de teste falhou. Ver os logs para mais detalhes.';
		$language_array['Test Email Failed. Email address was empty.']			= 'E-mail de teste falhou. Endereço estava vazio.';
		$language_array['Test Email Failed. SMTP server not set.']				= 'E-mail de teste falhou. Servidor SMTP não definido.';

		$language_array['Error']												= 'Erro!';

		$language_array['Captcha']												= 'Captcha';
		$language_array['Anti-Spam Image']										= 'Imagem Anti-Spam';
		$language_array['Anti-Spam Text']										= 'Texto Anti-Spam';
		$language_array['Anti-Spam Text Incorrect']								= 'Texto Anti-Spam Incorreto';
		$language_array['Anti-Spam Captcha Enabled (helps protect the guest portal and user registration from bots)']	= 'Captcha Anti-Spam Ativado (ajuda a proteger o portal de visitantes e o registro de usuários, de robôs maliciosos).';

		$language_array['If email address is present notifications can be emailed to the user.'] = 'Se o endereço de e-mail for informado, as notificações poderão ser enviadas para o usuário.';
		$language_array['Local: The password is stored in the local database.']	= 'Local: A senha é armazenada no banco de dados local.';
		$language_array['Active Directory: The password is stored in Active Directory, password fields are ignored.'] = 'Active Directory: A senha é armazenada no Active Directory, campos de senha são ignorados.';
		$language_array['Note: Active Directory must be enabled and connected to an Active Directory server in the settings page.'] = 'Nota: Active Directory deve ser ativado e conectado a um servidor de Active Directory na página de configurações.';
		$language_array['Submitters: Can create and view their own tickets.'] = 'Emissores: É possível criar e visualizar seus próprios tickets.';
		$language_array['Users: Can create and view their own tickets and view assigned tickets.'] = 'Usuários: Podem criar e exibir seus próprios tickets e ver a quem foi atribuído a responsabilidade do atendimento.';
		$language_array['Moderators: Can create and view all tickets, assign tickets and create tickets for other users.'] = 'Moderadores: É possível criar e visualizar todos os tickets, atribuir responsáveis para tickets e criar tickets para outros usuários.';
		$language_array['Administrators: The same as Moderators but can add users and change System Settings.'] = 'Administradores: As mesmas permissões dos moderadores, mas podem adicionar usuários e mudar configurações do sistema.';

		$language_array['You cannot change the password for this account.']		= 'Você não pode alterar a Senha desta conta.';

		$language_array['Private Message']										= 'Mensagem Privada';
		$language_array['Private Messages']										= 'Mensagens Privadas';
		$language_array['To']													= 'Para';
		$language_array['From']													= 'De';
		$language_array['Date']													= 'Data';
		$language_array['Unread']												= 'Não lido';
		$language_array['Sent']													= 'Enviada';
		
		$language_array['Are you sure you wish to delete this message?']		= 'Tem certeza de que deseja apagar esta mensagem?';

		$language_array['View Message']											= 'Ver Mensagem';
		$language_array['Create Message']										= 'Criar Mensagem';
		$language_array['Send']													= 'Enviar';

		$language_array['Notice']												= 'Nota';
		$language_array['Warning']												= 'Aviso';
		$language_array['Authentication']										= 'Autenticação';
		$language_array['Cron']													= 'Cron';
		$language_array['POP3']													= 'POP3';
		$language_array['Storage']												= 'Armazenagem';
		$language_array['No Messages']											= 'Nenhuma Mensagem';
		
		
		//Version 2.1+
		
		$language_array['Custom Fields']										= 'Campos Personalizados';
		$language_array['Text Input']											= 'Text Input';
		$language_array['Text Area']											= 'Text Area';
		$language_array['Drop Down']											= 'Drop Down';
		$language_array['Dropdown']												= 'Dropdown';
		$language_array['Dropdown Fields']										= 'Opções do Seletor';
		$language_array['Input Type']											= 'Tipo de Campo';
		$language_array['Option']												= 'Opção';
		$language_array['Input Options']										= 'Opções de Campos';

		$language_array['Custom Fields allow you to add extra global fields to your tickets.']	= 'Os campos personalizados permitem adicionar Campos Extras globais para os seus tickets.';


		$language_array['Text Input (single line of text).']					= 'Text Input (Linha única de texto).';
		$language_array['Text Area (multiple lines of text).']					= 'Text Area (Multiplas Linhas de texto).';
		$language_array['Dropdown box with options.']							= 'Drop Down (Caixa com seletor de opções).';
		$language_array['All data attached to this custom field will be deleted. Are you sure you wish to delete this Custom Field?'] = 'Todos os dados anexados a este campo personalizado será excluído. Tem certeza de que deseja apagar este campo personalizado?';

		
		//Version 2.2+
		$language_array['Closed Tickets']										= 'Tickets Fechados';
		$language_array['Show Extra Settings']									= 'Exibir opções extra';
		$language_array['Default Timezone']										= 'Fuso Horário Local';
		$language_array['Colour']												= 'Cor';
		$language_array['Add Status']											= 'Adicionar Status';
		$language_array['Edit Status']											= 'Editar Status';
		$language_array['HEX Colour']											= 'Cor Hexadecimal';
		$language_array['Are you sure you wish to delete this Status?']			= 'Tem certeza de que deseja apagar este Status?';

		
		//Vesion 2.3+
		$language_array['External Services']									= 'Serviços Externos';
		$language_array['Add SMTP Account']										= 'Adicionar conta SMTP';
		$language_array['Select SMTP Account']									= 'Selecionar conta SMTP';
		$language_array['Default SMTP Account']									= 'Conta SMTP Padrão';
		$language_array['SMTP Accounts']										= 'Contas SMTP';
		$language_array['Are you sure you wish to delete this SMTP account?']	= 'Tem certeza de que deseja apagar esta conta SMTP?';
		$language_array['Port (default 25)']									= 'Porta (padrão 25)';
		$language_array['Pushover Enabled']										= 'Pushover Ativado';
		$language_array['Pushover for all Users']								= 'Pushover para todos os usuários';
		$language_array['Pushover Application Token']							= 'Pushover aplicação de Token';
		$language_array['Pushover Key']											= 'Pushover Key';

		$language_array['Notifications']										= 'Notificações';

		$language_array['Below is a list of the users who will receive pushover notifications whenever a new ticket or ticket note is added.']										= 'Abaixo, uma Lista de Usuários que receberão notificações pushover sempre que um novo ticket ou nota ao ticket for adicionada.';
		
		$language_array['On Behalf Of']											= 'Em nome de';
		$language_array['Assigned To']											= 'Responsabilidade';
		
		//Version 2.4+
		$language_array['Global Moderator']										= 'Moderador Global';
		$language_array['Staff']												= 'Pessoal';
		$language_array['Public']												= 'Público';
		$language_array['Members']												= 'Membros';
		$language_array['Add Department']										= 'Adicionar Departamento';
		$language_array['Edit Department']										= 'Editar Departamento';
		$language_array['Are you sure you wish to delete this Department?']		= 'Tem certeza de que deseja apagar este Departamento?';
		$language_array['Replies']												= 'Respostas';
		$language_array['Reply']												= 'Responder';

		$language_array['Staff: Can create and view their own tickets, view assigned tickets and view tickets within assigned departments.'] = 'Funcionários: é possível criar e visualizar seus próprios bilhetes, bilhetes atribuídos ver e ver bilhetes dentro dos departamentos atribuídas.';
		$language_array['Moderators: Can create and view tickets, assign tickets and create tickets for other users within assigned departments.'] = 'Moderadores: Pode criar e visualizar tickets, atribuir bilhetes e criar tickets para outros usuários dentro dos departamentos atribuídas.';
		$language_array['Global Moderators: Can create and view all tickets, assign tickets and create tickets for other users.'] = 'Moderadores globais: Pode criar e visualizar todos os bilhetes, atribuir bilhetes e criar tickets para outros usuários.';
		$language_array['Administrators: The same as Global Moderators but can add users and change System Settings.'] = 'Administradores: O mesmo que moderadores globais, mas pode adicionar usuários e alterar configurações do sistema.';

		//Version 2.5+
		$language_array['Email Account']										= 'Conta de e-mail';
		$language_array['Map']													= 'mapa';
		$language_array['Send Welcome Email']									= 'Enviar e-mail de boas-vindas';
		$language_array['New User (Welcome Email)']								= 'Novo Usuário (e-mail de boas-vindas)';
		$language_array['Are you sure you wish to clear the queue?']			= 'Tem certeza de que deseja limpar a fila?';
		$language_array['Reset Cron']											= 'Redefinir Cron';
		$language_array['Clear Queue']											= 'Clear Queue';
	
	
		$this->lang_array 			= $language_array;
		
	}
	
	public function get() {
		return $this->lang_array;
	}

}	
?>