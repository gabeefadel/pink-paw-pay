

# 🌸 Pink Paw Pay API 🎀

Seja bem-vinda ao core da **Pink Paw **! Esta é uma API robusta, segura e completamente "girly-tech" desenvolvida para transformar doações em amor para nossos pets.

## 🛠 Tech Stack

* **Framework:** Laravel 11.


* **Runtime:** Docker via Laravel Sail (Ambiente Debian).


* **DB Primário:** MySQL para transações e histórico.


* **DB Logs:** MongoDB para tracking detalhado de cada etapa.


* **Testes:** Pest PHP com cobertura mínima de 90%.


* **Segurança:** Laravel Sanctum e Criptografia AES-256.



---

## 💅 Funcionalidades Principais

* **Gestão de Doações:** Processamento completo de doações via Pix ou Cartão de Crédito.


* **Vouchers de Recompensa:** Geração automática de voucher de 20% de desconto para doações acima de R$ 200,00.


* **Mensageria e Notificações:** Disparo de alertas via filas (Queue) para o doador e para a instituição após a conclusão da transação.


* **Rastreabilidade Total:** Registro de cada etapa da transação no MongoDB para auditoria e logs de falha.


* **Bloqueio de Segurança:** Encerramento automático de interações após 3 tentativas de transação falhas, com envio de alerta por e-mail.



---

## 🔒 Práticas de Segurança Adotadas

A segurança é tratada como prioridade máxima no desenvolvimento desta API:

* **Autenticação Obrigatória:** Todas as rotas de transação são protegidas pelo Laravel Sanctum, exigindo que o usuário esteja logado.


* **Privacidade de Dados (Encryption at Rest):** Dados sensíveis, como CPF e informações de cartão de crédito, são salvos criptografados no banco de dados.


* **Integridade Financeira:** O uso de `DB Transactions` garante o rollback automático em caso de qualquer falha durante o processo de pagamento, evitando inconsistências.


* **Identificação Única:** Cada transação utiliza um UUID como chave primária para garantir a unicidade e segurança dos registros.



---

## 🐶 Fluxo de Uso da API

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



---

## 🧪 Qualidade e Commits

Para manter a excelência, o projeto conta com um lint que permite o commit apenas se os testes unitários e de feature atingirem a cobertura de 90%.

```bash
# Executar testes manualmente
./vendor/bin/sail pest --coverage

```

---

Criado com 💖 por **Gabi** | `@thedevinpink` 🐾