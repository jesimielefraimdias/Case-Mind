Para este case usei o servidor de teste do codeigniter.

Banco de dados:
O banco de dados escolhido foi o postgre por ter uma interface mais amigável em relação aos 
scripts SQL.
Você poderá ver o registro criado em tabela.sql ou poderá usar o arquivo registros que contém o backup.

Como iniciar o servidor?
Você poderá iniciar o servidor usando  o comando "php spark serve" no cmd
no mesmo nível de diretório do arquivo spark.
O servidor ficará rodando em "localhost:8080"

Configurações:
Para utilizar o servidor spark em conjunto com postgre e sql foi necessário
adicionar o php a variáveis de ambiente e descomentar algumas linhas do php.ini que habilitam
o postgre ser usado com PDO.
Para habilitar as variáveis de ambiente basta apenas adicionar o caminho do php em path.
Para usar postgree descomente as seguintes linhas no php.ini:
extension=pdo_pgsql
extension=pdo_sqlite
extension=pgsql

Inscrição:
Ao entrar no site, a página padrão é a de login, você poderá acessar a inscrição
no canto superior direito.
Na página de inscrição basta preencher corretamente os campos, mensagens de erro irão guiar
você.
Adicione uma foto de perfil clicando sobre a imagem !(Criei a
pasta imagem que contém algumas imagens para você selecionar)

Login:
A página de login exige cpf ou email para o campo de login e a senha.
Para facilitar, já criei alguns usuários que já estão cadastrado no banco de dados.
Todas as senhas de usuários são "Senha123#" para facilitar os testes.
E temos a conta admin com Login: "admin@teste.gmail.com" e senha: "Admin123#"

Home:
A página home tem um mini-tutorial de como navegar no site apenas para fins didáticos.
Ao clicar em Meus dados sua imagem e seus dados serão carregados na página.
Ao clicar em Alterar meus dados você será redirecionado para a página de alteração de dados!

Alteração de dados:
Funciona basicamente do mesmo modo da página de inscrição com a diferença que se o usuário
não trocar a imagem ou não mexer no campo da senha não trocaremos os mesmos.

Listagem de usuários:
O administrador terá acesso em sua home a página de listagem de usuários.
Nela, o administrador poderá ver todos os usuários e poderá:
Alterar os dados do usuário.
Ativar ou inativar sua conta, o que pode impossibilitar o usuário de fazer o login!