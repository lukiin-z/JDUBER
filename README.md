# JDUBER

## Sumário
- [Introdução](#-introdução)
- [Objetivos](#-objetivos)
- [Desenvolvimento](#-desenvolvimento)
  - [Arquitetura](#arquitetura)
  - [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Páginas e Funcionalidades](#-páginas-e-funcionalidades)
- [Imagens do Projeto](#-imagens-do-projeto)
- [Design](#-design)
- [Resultados](#-resultados)
- [Código Fonte](#-código-fonte)
- [Vídeo de Demonstração](#-vídeo-de-demonstração)
- [Testes de Desempenho](#-testes-de-desempenho)
  - [Definição da Ferramenta de Teste](#definição-da-ferramenta-de-teste)
  - [Evidências de Testes](#evidências-de-testes)
  - [Discussão dos Resultados](#discussão-dos-resultados)
  - [Soluções Futuras](#soluções-futuras)
- [Conclusão](#-conclusão)

---

## 🚀 Introdução

O projeto **JDUBER** foi desenvolvido como parte de uma iniciativa para melhorar a eficiência na movimentação de kits dentro das instalações da **John Deere**. O foco está na aplicação dos conceitos da **Indústria 4.0**, especialmente IoT, para automatizar e monitorar a logística interna usando dispositivos ESP32 conectados a uma plataforma online. O objetivo é proporcionar uma solução escalável e de fácil utilização para operadores, supervisores e montadores da John Deere, permitindo o acompanhamento em tempo real de veículos de transporte e a comunicação entre responsáveis.

---

## 🎯 Objetivos

- **Automatizar** a coleta e entrega de kits usando dispositivos conectados à internet.
- **Localizar em tempo real** os operadores e veículos (carrinhos) envolvidos na movimentação dos kits.
- **Facilitar a comunicação** entre montadores e operadores, permitindo pedidos de kits pela interface do sistema.
- **Fornecer uma visão global para supervisores**, permitindo o acompanhamento de todo o fluxo de kits e operadores no chão de fábrica.

---

## ⚙️ Desenvolvimento

### Arquitetura

A solução JDUBER é composta por uma arquitetura de IoT que integra dispositivos ESP32, comunicação via servidor web e uma interface de usuário acessível por navegadores. 

**Diagrama da Arquitetura do Sistema**:
- **ESP32**: Envia as coordenadas dos veículos de transporte (carrinhos de kits) para o servidor.
- **Servidor (Hostinger)**: Recebe, processa e armazena os dados enviados pelos ESP32, além de servir a aplicação web.
- **Frontend (Interface Web)**: HTML, CSS e JavaScript, com páginas para diferentes usuários:
  - **Montador**: Solicita kits através de uma interface intuitiva.
  - **Operador**: Recebe solicitações de kits e é monitorado enquanto movimenta kits pela fábrica.
  - **Supervisor**: Visualiza em tempo real a localização de operadores e kits, monitorando o fluxo operacional.
- **Banco de Dados (MongoDB)**: Armazena as coordenadas e informações dos operadores e kits.

### Tecnologias Utilizadas

- ![ESP32 Icon](https://img.icons8.com/external-filled-outline-geotatah/48/000000/external-esp32-electronic-components-filled-outline-geotatah.png) **ESP32**: Microcontrolador para comunicação IoT.
- ![Hostinger Icon](https://img.icons8.com/color/48/000000/cloud.png) **Hostinger**: Hospedagem do site e backend PHP.
- ![MongoDB Icon](https://img.icons8.com/color/48/000000/mongodb.png) **MongoDB**: Banco de dados para as informações dos dispositivos ESP32.
- ![PHP Icon](https://img.icons8.com/color/48/000000/php.png) **PHP**: Backend para processar as requisições do ESP32 e gerenciar a lógica do sistema.
- ![JavaScript Icon](https://img.icons8.com/color/48/000000/javascript.png) **JavaScript**: Interação dos usuários com o sistema.
- ![HTML Icon](https://img.icons8.com/color/48/000000/html.png) **HTML/CSS**: Estrutura e estilo das páginas web.

### Diagrama de Blocos da Arquitetura

![Diagrama Indústria 4.0](https://github.com/user-attachments/assets/217c3e4e-eba4-4659-b6fb-0a32f54ea2ad)

---

## 🔍 Páginas e Funcionalidades

| Usuário    | Funcionalidade Principal                       | Descrição                                                                                  |
|------------|-----------------------------------------------|--------------------------------------------------------------------------------------------|
| **Montador** | Solicitação de kits                           | Solicita kits para os operadores, que realizam as entregas                                 |
| **Operador** | Receber solicitações e monitoramento de kits | Recebe solicitações dos montadores e movimenta os kits, com a localização atualizada no mapa |
| **Supervisor** | Visão geral do fluxo de trabalho             | Visualiza em tempo real as localizações dos operadores e kits em toda a planta             |

- **Login e Registro**: Autenticação robusta com controle de acesso baseado em funções (Supervisor, Operador, Montador).
- **Mapa Interativo**: Atualização em tempo real da localização de operadores e kits, com visão global para supervisores.
- **Solicitação de Kits**: Montadores podem solicitar kits, e operadores recebem as solicitações e realizam as entregas.
- **Recuperação de Senha**: Implementado via SMTP, permitindo redefinição segura de senha.

---

## 🖼️ Imagens do Projeto

### Capturas de Tela do Projeto

| Captura de Tela |
| --- |
| ![Captura_de_tela_2024-09-30_084109](https://github.com/user-attachments/assets/ee61cfea-d762-4453-a948-21f67677a715) |
| ![Captura_de_tela_2024-09-30_083948](https://github.com/user-attachments/assets/1b441dbe-8113-4d9c-956b-596eabe44a14) |
| ![Captura_de_tela_2024-09-30_083852](https://github.com/user-attachments/assets/ac5a0dba-8147-4be9-8d94-2025bb5239a6) |

### Tela do Protótipo ESP32 e Banco de Dados

| Protótipo ESP32 e Banco de Dados |
| --- |
| ![Captura_de_tela_2024-09-30_090436](https://github.com/user-attachments/assets/c09d51c3-e9f1-408a-a003-3af42fc74e93) |
| ![Captura_de_tela_2024-09-30_085904](https://github.com/user-attachments/assets/4382f03e-7a11-4532-8e0a-60fe8942b7b7) |
| ![Captura_de_tela_2024-09-30_085521](https://github.com/user-attachments/assets/e453e0ac-7a9e-4e20-a1e3-ce613214bdb6) |

---

## 🎨 Design

O projeto JDUBER adota um design minimalista inspirado nas cores da **Uber**, com um esquema de cores preto e branco que reflete simplicidade e elegância. A interface é **responsiva**, garantindo uma experiência agradável em desktops e dispositivos móveis.

---

## 📈 Resultados

Os principais resultados até o momento incluem:

- **Localização em Tempo Real**: Atualização fluida das coordenadas de operadores e kits, permitindo monitoramento completo.
- **Sistema de Solicitação de Kits**: Otimização no tempo de entrega de kits com fluxo de solicitações funcional.
- **Recuperação de Senhas**: Sistema configurado e funcionando via e-mail.

---

## 💻 Código Fonte

O código-fonte completo do projeto está na pasta `/public_html` e inclui:

- **Frontend**: Arquivos HTML, CSS e JavaScript.
- **Backend**: Scripts PHP para a comunicação com o ESP32 e o banco de dados.

---

## 🎬 Vídeo de Demonstração

Assista à [demonstração do projeto no YouTube](https://www.youtube.com/watch?v=jGpozfe2yeo).

---

## 🧪 Testes de Desempenho

Nesta seção, realizamos testes para avaliar a qualidade do projeto JDUBER e identificar oportunidades de melhoria com base no feedback da John Deere. O teste selecionado foi focado na precisão da localização via triangulação WiFi com ESP32.

### Definição da Ferramenta de Teste

Utilizamos uma ferramenta de análise de sinal WiFi para avaliar a precisão da localização fornecida pela triangulação.

- **Teste de Precisão de Localização**: Avalia a precisão da localização dos ativos com base no sinal WiFi, verificando o erro médio de localização em um ambiente de fábrica.

### Evidências de Testes

Abaixo, uma captura de tela dos resultados obtidos durante o teste de precisão de localização.

| Teste de Precisão de Localização |
| --- |
| ![Captura Teste Precisão](https://github.com/user-attachments/assets/d83731db-19d0-4838-b79e-01552f40d893) |

### Discussão dos Resultados

- **Teste de Precisão de Localização**: Os resultados mostraram uma precisão satisfatória para ambientes internos, com erro médio de até 1,5 metros. Este nível de precisão é adequado para o monitoramento de kits e operadores na planta.

### Soluções Futuras

Para aprimorar o desempenho e aumentar a durabilidade dos dispositivos, algumas melhorias futuras poderiam incluir:

- **Aprimorar a Precisão**: Implementar algoritmos de filtragem para refinar ainda mais a precisão da localização.
- **Otimização de Energia**: Considerar modos de economia de energia para prolongar a vida útil da bateria dos ESP32.

---

## 📚 Conclusão

JDUBER é um passo importante na aplicação da Indústria 4.0 na John Deere. Com a automação da logística interna e o uso de IoT, esperamos melhorar a eficiência das operações, além de facilitar o trabalho dos operadores, montadores e supervisores.

---

> **Desenvolvido por**: Lucas Baraldi e Lucas Zolla  
> **Projeto para**: John Deere
