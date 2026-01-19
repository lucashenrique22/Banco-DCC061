# 🏦 Sistema Bancário — Laravel

Projeto desenvolvido em Laravel com foco em simulação de operações bancárias, contemplando gestão de usuários, contas, transações financeiras, crédito e investimentos.

---

## 📌 Objetivo

Implementar um sistema bancário funcional permitindo:

- Controle de usuários (admin e cliente)  
- Operações financeiras (depósito, transferência)  
- Solicitação e análise de crédito  
- Gestão de investimentos  
- Consulta de saldo e extrato com exportação  
- Geração de comprovantes digitais  

---

## ⚙️ Tecnologias Utilizadas

- Laravel 10+  
- PHP 8+  
- SQLite  
- TailwindCSS  
- Alpine.js  
- IMask.js  
- DomPDF  
- XMLWriter  

---

## 🚀 Como Executar

```bash
git clone ...
cd projeto
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
