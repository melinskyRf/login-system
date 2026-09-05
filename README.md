# Login System

> **Conteúdo Educativo** - Sistema de login simples desenvolvido em PHP para estudo de autenticação, sessões, banco de dados MySQL e boas práticas de segurança.

[![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5%2B-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](#)

## Sobre o Projeto

O **Login System** é um projeto educacional que demonstra como implementar um sistema completo de autenticação em PHP com banco de dados MySQL. O projeto cobre desde a criação do banco de dados até a proteção de rotas com sessões.

### Objetivo Educacional

Este projeto foi desenvolvido para estudar:
- **Autenticação** de usuários com PHP
- **Sessões PHP** e controle de acesso
- **Banco de dados MySQL** e prepared statements
- **Hash de senhas** com SHA-256
- **Prevenção de SQL Injection** com prepared statements
- **CRUD básico** de usuários
- **HTML/CSS** para formulários

### Aviso Importante

> ⚠️ Este é um projeto de estudo. Em produção, use `password_hash()` e `password_verify()` ao invés de SHA-256, e implemente CSRF tokens.

## Funcionalidades

### Formulário de Login
- Interface limpa e responsiva
- Validação de campos obrigatórios
- Mensagens de erro amigáveis

### Autenticação
- Validação de usuário e senha no banco de dados
- Senhas com hash SHA-256
- Prepared statements para prevenir SQL Injection
- Redirecionamento após login bem-sucedido

### Sessão
- Criação de sessão PHP após autenticação
- Verificação de sessão em páginas protegidas
- Logout seguro com destruição da sessão

### Dashboard
- Página protegida que exibe o nome do usuário
- Link para logout

## Tecnologias Utilizadas

| Tecnologia | Versão | Uso |
|------------|--------|-----|
| PHP | 8+ | Backend e autenticação |
| MySQL | 5+ | Banco de dados |
| HTML5 | - | Estrutura das páginas |
| CSS3 | - | Estilos do formulário |
| PHP Sessions | - | Controle de sessão |

## Pré-requisitos

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Servidor web (XAMPP, WAMP, Laragon)

## Como Rodar

### Passo 1: Configurar o Banco de Dados

1. Abra o phpMyAdmin (geralmente em `http://localhost/phpmyadmin`)
2. Vá na aba **SQL** e cole o conteúdo do arquivo `users.sql`:

```sql
CREATE DATABASE loginDB;
USE loginDB;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password)
VALUES ('admin', SHA2('123456', 256));
```

3. Clique em **Executar** para criar o banco e a tabela

### Passo 2: Configurar a Conexão

Edite o arquivo `db.php` se necessário:

```php
<?php
$host = "localhost";    // Host do MySQL
$db = "loginDB";        // Nome do banco
$user = "root";         // Usuário do MySQL
$pass = "";             // Senha do MySQL (vazio por padrão no XAMPP)
?>
```

### Passo 3: Copiar os Arquivos

Copie todos os arquivos para o diretório do servidor:
```
XAMPP: C:\xampp\htdocs\login\
WAMP:  C:\wamp64\www\login\
```

### Passo 4: Acessar

Abra o navegador e acesse:
```
http://localhost/login/
```

### Credenciais Padrão

| Usuário | Senha |
|---------|-------|
| `admin` | `123456` |

## Estrutura do Projeto

```
testes/
├── index.html       # Formulário de login (front-end)
│                    #   - Formulário HTML com CSS inline
│                    #   - Campos: usuário e senha
│                    #   - Envia para login.php via POST
│
├── login.php        # Processamento do login
│                    #   - Valida credenciais no banco
│                    #   - Cria sessão PHP
│                    #   - Redireciona para dashboard
│
├── dashboard.php    # Painel do usuário (protegido)
│                    #   - Verifica se está logado
│                    #   - Exibe nome do usuário
│                    #   - Link para logout
│
├── logout.php       # Encerrar sessão
│                    #   - Destroi a sessão
│                    #   - Redireciona para login
│
├── db.php           # Conexão com o banco MySQL
│                    #   - Configurações de conexão
│                    #   - Tratamento de erros
│
├── users.sql        # Script SQL
│                    #   - Cria banco loginDB
│                    #   - Cria tabela users
│                    #   - Insere usuário admin
│
├── README.md        # Esta documentação
└── .gitignore       # Arquivos ignorados
```

## Fluxo de Uso

```
┌─────────────┐    POST     ┌─────────────┐    Query    ┌─────────────┐
│ index.html  │ ──────────  │  login.php  │ ──────────  │   MySQL     │
│ (Login)     │  user/senha │  (Valida)   │  SELECT     │ (loginDB)   │
└─────────────┘             └─────────────┘             └─────────────┘
                                │
                                │ Sucesso
                                ▼
                          ┌─────────────┐
                          │ dashboard.php│
                          │ (Protegido)  │
                          └─────────────┘
```

## Conceitos Estudados

### Autenticação com Sessão
```php
// login.php
session_start();
$_SESSION['user'] = $username;
header("Location: dashboard.php");

// dashboard.php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
```

### Prepared Statements (Prevenção de SQL Injection)
```php
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
```

### Hash de Senhas
```php
// Armazenando
$password = hash('sha256', $_POST['password']);

// Verificando (neste projeto)
$password = hash('sha256', $_POST['password']);
```

## Melhorias Sugeridas para Produção

| Aspecto | Este Projeto | Produção Recomendada |
|---------|-------------|---------------------|
| Hash de senhas | SHA-256 | `password_hash()` / `password_verify()` |
| CSRF | Não implementado | Token CSRF em formulários |
| Validação | Básica | Validação completa no backend |
| Rate Limiting | Não | Limite de tentativas |
| HTTPS | Não | Certificado SSL |
| Logs | Não | Sistema de logs de acesso |

## Autor

**Rafael Melinsky** - Desenvolvedor Full Stack

- GitHub: [@melinskyRf](https://github.com/melinskyRf)
- Site: [devmelinsky.site](https://devmelinsky.site)

---

> 📚 **Projeto Educacional** - Feito para aprender os fundamentos de autenticação web com PHP e MySQL.
