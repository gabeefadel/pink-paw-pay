# 🌸 Pink Paw Pay API 🐾

> **Disponível em:** [Português](https://www.google.com/search?q=%23-portugu%C3%AAs) | [English]()

---

## 🇧🇷 Português

Seja bem-vinda ao core da Pink Paw ! Esta é uma API robusta e segura desenvolvida para transformar doações em amor para nossos pets.

### 🛠 Tech Stack

* **Framework:** Laravel 11.
* **Runtime:** Docker via Laravel Sail (Ambiente Debian).
* **DB Primário:** MySQL para transações e histórico.
* **DB Logs:** MongoDB para tracking detalhado de cada etapa.
* **Testes:** Pest PHP com cobertura mínima de 90%.
* **Segurança:** Laravel Sanctum e Criptografia AES-256.

### 🏗️ Arquitetura e Decisões Técnicas

Como Senior Fullstack Developer, projetei esta API baseada em três pilares:

* **Persistência Poliglota:** Utilizo o MySQL para garantir transações ACID e o MongoDB para armazenar logs extensos de auditoria sem impactar a performance do banco relacional.
* **Processamento Assíncrono:** Notificações e geração de vouchers são delegados para **Laravel Queues**, garantindo que a resposta ao usuário seja imediata.
* **Resiliência Financeira:** Implementação de `DB Transactions` em todos os fluxos de pagamento para garantir rollbacks automáticos em caso de falha.
* **Segurança em Camadas:** Dados sensíveis (CPF/Cartão) são criptografados em repouso. O sistema possui um *Circuit Breaker* que bloqueia acessos após 3 tentativas falhas.

### 💅 Funcionalidades Principais

* **Gestão de Doações:** Processamento completo de doações via Pix ou Cartão de Crédito.
* **Vouchers de Recompensa:** Geração automática de voucher de 20% de desconto para doações acima de R$ 200,00.
* **Mensageria e Notificações:** Disparo de alertas via filas (Queue) para o doador e para a instituição após a conclusão da transação.
* **Rastreabilidade Total:** Registro de cada etapa da transação no MongoDB para auditoria e logs de falha.
* **Bloqueio de Segurança:** Encerramento automático de interações após 3 tentativas de transação falhas, com envio de alerta por e-mail.

### 🔒 Práticas de Segurança Adotadas

A segurança é tratada como prioridade máxima no desenvolvimento desta API:

* **Autenticação Obrigatória:** Todas as rotas de transação são protegidas pelo Laravel Sanctum, exigindo que o usuário esteja logado.
* **Privacidade de Dados (Encryption at Rest):** Dados sensíveis, como CPF e informações de cartão de crédito, são salvos criptografados no banco de dados.
* **Integridade Financeira:** O uso de `DB Transactions` garante o rollback automático em caso de qualquer falha durante o processo de pagamento, evitando inconsistências.
* **Identificação Única:** Cada transação utiliza um UUID como chave primária para garantir a unicidade e segurança dos registros.

### 🐶 Fluxo de Uso da API

O ciclo de vida de uma doação segue um fluxo rigoroso para garantir o sucesso da operação:

1. **Autenticação:** O usuário realiza o login para obter o token de acesso.
2. **Envio de Dados:** A API recebe os dados bancários e informações do usuário (nome, CPF, endereço, e-mail, celular, método de pagamento e valor).
3. **Validação:** O sistema valida obrigatoriamente todos os campos e o método de pagamento.
4. **Execução da Transação:**
* Início da `DB Transaction`.
* Transferência do valor para a conta do grupo Ação Dogs.
* Persistência do histórico no MySQL e registro de logs no MongoDB.


5. **Pós-Processamento:**
* Se valor > R$ 200,00: Geração do voucher de desconto.
* Envio de notificações via mensageria para ambas as partes.
* Confirmação (Commit) da transação.


6. **Tratamento de Exceção:** Em caso de erro, o sistema realiza o rollback, salva o log da falha e avisa o usuário. Se houver reincidência (3x), o acesso é bloqueado temporariamente por segurança.

### 🚀 Configuração do Ambiente

```bash
# Instalar dependências via Docker
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install

# Configurar ambiente
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

```

---

## 🇺🇸 English

Welcome to the core of **Pink Paw**! This is a robust, secure, and completely "girly-tech" API developed to transform donations into love for our pets.

### 🛠 Tech Stack

* **Framework:** Laravel 11.
* **Runtime:** Docker via Laravel Sail (Debian Environment).
* **Primary DB:** MySQL for transactions and history.
* **Logs DB:** MongoDB for detailed tracking of every stage.
* **Testing:** Pest PHP with 90% minimum coverage.
* **Security:** Laravel Sanctum and AES-256 Encryption.

### 🏗️ Architecture & Technical Decisions

As a Senior Fullstack Developer, I designed this API based on three pillars:

* **Polyglot Persistence:** MySQL ensures ACID transactions, while MongoDB stores extensive audit logs without impacting relational performance.
* **Asynchronous Processing:** Notifications and voucher generation are handled via **Laravel Queues** for immediate user response.
* **Financial Resilience:** `DB Transactions` are used in all payment flows to ensure automatic rollbacks on failure.
* **Layered Security:** Sensitive data is encrypted at rest. Features a *Circuit Breaker* that blocks access after 3 failed attempts.

### 💅 Main Features

* **Donation Management:** Full processing via Pix or Credit Card.
* **Reward Vouchers:** Automatic 20% discount voucher for donations over R$ 200.00.
* **Messaging & Notifications:** Queue-based alerts for both donor and institution after transaction completion.
* **Total Traceability:** Every transaction step is logged in MongoDB for audit and failure tracking.
* **Security Lockout:** Automatic interaction termination after 3 failed attempts, with email alerts.

### 🔒 Security Practices

Security is a top priority in this API's development:

* **Mandatory Authentication:** All transaction routes protected by Laravel Sanctum.
* **Data Privacy (Encryption at Rest):** Sensitive data (Tax ID/Cards) saved with AES-256 encryption.
* **Financial Integrity:** Guaranteed consistency through database transactions, ensuring rollbacks on failure.
* **Unique Identification:** UUIDs used as primary keys for security and record uniqueness.

### 🐶 API Usage Flow

The donation lifecycle follows a strict flow to ensure operational success:

1. **Authentication:** User logs in to obtain an access token.
2. **Data Submission:** Receives banking and donor information (Name, Tax ID, address, etc.).
3. **Validation:** Mandatory field and payment method verification.
4. **Execution:** Starts `DB Transaction`, processes transfer to "Ação Dogs" group, and persists data in MySQL/MongoDB.
5. **Post-Processing:** Voucher generation (> R$ 200) and notifications.
6. **Exception Handling:** Automatic rollback on error, failure logging, and temporary lockout after 3 failures.

### 🚀 Environment Setup

```bash
# Install dependencies via Docker
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install

# Set up environment
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

```

---

### 🧪 Qualidade e Commits / Quality Assurance

Para manter a excelência, o projeto conta com um lint que permite o commit apenas se os testes unitários e de feature atingirem a cobertura de 90%.

```bash
# Executar testes manualmente / Run tests manually
./vendor/bin/sail pest --coverage

```

---

Criado com 💖 por **Gabi** | `@thedevinpink` 🐾