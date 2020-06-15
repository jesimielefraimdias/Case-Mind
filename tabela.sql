	CREATE TABLE usuario(
		id_usuario serial PRIMARY KEY,
		nome varchar(255) NOT NULL,
		cpf char(11) NOT NULL,
		email varchar(255) NOT NULL,
		senha varchar(255) NOT NULL,
		grau_acesso char NOT NULL DEFAULT 'U' -- A de admin, U de usuário e I de inativo.
	);