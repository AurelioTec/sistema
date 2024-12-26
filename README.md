# Sistema de Gestão de Matrículas - Complexo Escolar BG 1237

<img src="https://drive.google.com/file/d/1KkqMsGeDgezzT10ZJ0AlmnwR_Y0MzgzA/view?usp=drive_link" alt="Banner Sistema de Gestão de Matrículas">

Bem-vindo ao repositório do **Sistema de Gestão de Matrículas** do **Complexo Escolar BG 1237**. Este sistema foi desenvolvido para otimizar o gerenciamento de matrículas, organização de turmas e registro acadêmico, utilizando a potência do Laravel 11.

> **Status do projeto:** 🚀🔧 Em desenvolvimento

---

## Funcionalidades Principais

### ✅ Configurações Iniciais

-   Configuração e abertura do ano lectivo
-   Definição dos gestores da escola

### ✅ Gerenciamentos das Inscrições

-   Cadastro e edição de dados pessoais do aluno.
-   Administração simplificada de dados pessoais.

### ✅ Gerenciamento de Matrículas

-   Matricular e edição de alunos matriculados.
-   Administração simplificada de dados e acadêmicos.

### ✅ Organização Escolar

-   Criação e gerenciamento de turmas.
-   Alocação de funcionarios e professores.

### ✅ Relatórios Detalhados

-   Geração de relatórios dinâmicos por aluno, turma ou período.
-   Exportação de dados em formatos PDF.

### ✅ Segurança e Eficiência

-   Sistema de autenticação robusto.
-   Interface responsiva, garantindo usabilidade em diferentes dispositivos.

---

## Tecnologias Utilizadas

-   **Framework**: Laravel 11
-   **Frontend**: Blade Templates, Bootstrap 5
-   **Banco de Dados**: MySQL
-   **Autenticação**: Laravel UI
-   **Exportação**: Html, Maatwebsite Excel

---

## Instalação e Configuração

1. **Clone o repositório**:

```bash
$ git clone https://github.com/AurelioTec/Sistema.git
```

2. **Instale as dependências**:

```bash
$ composer install
```

3. **Configure o arquivo `.env`**:

-   Copie o arquivo de exemplo:

```bash
$ cp .env.example .env
```

-   Configure as credenciais do banco de dados e outras variáveis no arquivo `.env`.

4. **Gere a chave da aplicação**:

```bash
$ php artisan key:generate
```

5. **Execute as migrações e seeders**:

```bash
$ php artisan migrate --seed
```

6. **Inicie o servidor local**:

```bash
$ php artisan serve
```

Acesse o sistema em: `http://localhost:8000`

---

## Layout

### Tela de Login

![Tela de Login](https://drive.google.com/file/d/16pnXGUlFR9akvFzcP8GYjTWDVVXoUfKr/view?usp=drive_link)

### Painel de Controle

![Painel de Controle](https://drive.google.com/file/d/10_5ITjL-iZ15N5DpPJ2JpjrRdg8yAB3z/view?usp=drive_link)

---

## Contribuição

Contribuições são bem-vindas! Siga os passos abaixo para colaborar:

1. Crie um fork deste repositório.
2. Crie um branch com a sua funcionalidade: `git checkout -b minha-nova-funcionalidade`.
3. Envie as modificações: `git commit -m 'Adicionei minha funcionalidade'`.
4. Realize um push para o branch: `git push origin minha-nova-funcionalidade`.
5. Crie um pull request.

---

## Contato

📧 Email: [seuemail@example.com](mailto:aureliofabio16@gmail.com)  
🌐 Website: [seusite.com](https://www.linkedin.com/in/afonso-aur%C3%A9lio-269aa6227/)  
📞 Telefone: +244 939 985 248
📞 Telefone: +244 958 792 104

---

## Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.

---

> Simplifique a gestão escolar com o poder do Laravel 🚀
