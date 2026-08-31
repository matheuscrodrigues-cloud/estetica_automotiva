# Sistema de Estética Automotiva

## Visão Geral do Projeto
Aplicação web Full-Stack desenvolvida em PHP para gestão e agendamento de serviços de estética automotiva (lavagens, polimentos e higienizações).

## Requisitos Funcionais (RF)
* **RF01:** O sistema deve permitir o cadastro de novos usuários.
* **RF02:** O sistema deve permitir o login e autenticação de usuários cadastrados.
* **RF03:** O sistema deve permitir o agendamento de serviços automotivos com data e horário.
* **RF04:** O sistema deve listar todos os agendamentos vinculados ao usuário logado.
* **RF05:** O sistema deve permitir a exclusão de agendamentos.
* **RF06:** O sistema deve permitir o encerramento da sessão (Logout).

## Requisitos Não Funcionais (RNF)
* **RNF01:** A senha do usuário deve ser armazenada de forma criptografada usando `password_hash`.
* **RNF02:** O sistema deve utilizar banco de dados relacional MySQL.
* **RNF03:** A interface deve ser simples, funcional e desenvolvida em HTML5 e CSS3.
* **RNF04:** O código Back-End deve ser estruturado em PHP (versão 8.3 ou superior).