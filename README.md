# Login System

Sistema de login simples desenvolvido em PHP com banco de dados MySQL.

## Funcionalidades

- Formulário de login com validação
- Autenticação via banco de dados MySQL
- Senhas com hash SHA-256
- Sessão de usuário
- Dashboard protegido
- Logout seguro

## Tecnologias

- PHP 8+
- MySQL
- HTML/CSS
- PHP Sessions

## Como Rodar

1. Importe o arquivo `users.sql` no MySQL para criar o banco e a tabela
2. Configure a conexão em `db.php` (host, usuário, senha)
3. Coloque os arquivos em um servidor com PHP (ex: XAMPP, WAMP)
4. Acesse `index.html` no navegador

## Credenciais Padrão

- **Usuário:** `admin`
- **Senha:** `123456`

## Estrutura

```
testes/
├── index.html    # Formulário de login
├── login.php     # Processamento do login
├── dashboard.php # Painel do usuário
├── logout.php    # Encerrar sessão
├── db.php        # Conexão com o banco
└── users.sql     # SQL para criar o banco
```

## Autor

**Rafael Melinsky** - [GitHub](https://github.com/melinskyRf)
