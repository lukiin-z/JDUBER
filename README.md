JDUBER

Introdução

O projeto JDUBER foi desenvolvido como parte de uma iniciativa para melhorar a eficiência na movimentação de kits dentro das instalações da John Deere. Nosso foco está em aplicar os conceitos da Indústria 4.0, especificamente no pilar de Internet das Coisas (IoT), para automatizar e monitorar a logística interna de kits utilizando dispositivos ESP32 conectados a uma plataforma online. O principal objetivo do projeto é proporcionar uma solução escalável e de fácil utilização para operadores, supervisores e montadores da John Deere, permitindo o acompanhamento em tempo real de veículos de transporte de kits e a comunicação entre os responsáveis.

Objetivos

Automatizar a coleta e entrega de kits dentro da planta utilizando dispositivos conectados à internet.
Localizar em tempo real os operadores e veículos (carrinhos) envolvidos na movimentação dos kits.
Facilitar a comunicação entre os montadores e operadores, permitindo pedidos de kits diretamente pela interface do sistema.
Fornecer uma visão global para supervisores, permitindo que acompanhem todo o fluxo de kits e operadores no chão de fábrica.

Desenvolvimento

Arquitetura

A solução é composta por uma arquitetura de IoT que integra dispositivos ESP32, comunicação via servidor web e uma interface de usuário acessível por navegadores. Abaixo está o diagrama simplificado da arquitetura do sistema:
ESP32: Dispositivos responsáveis pela comunicação de dados em tempo real. Eles enviam as coordenadas dos veículos de transporte (carrinhos de kits) para o servidor, que processa essas informações.
Servidor: Hospedado na Hostinger, este servidor é responsável por receber, processar e armazenar as informações enviadas pelos ESP32, além de servir a aplicação web.
Frontend (Interface Web): Desenvolvido em HTML, CSS e JavaScript, com páginas específicas para diferentes tipos de usuários:
Montador: Pode solicitar kits através de uma interface intuitiva.
Operador: Recebe as solicitações de kits e tem sua localização monitorada enquanto movimenta os kits pela fábrica.
Supervisor: Visualiza em tempo real a localização de operadores e kits, podendo monitorar todo o fluxo operacional.
Banco de Dados: Utilizamos um banco de dados MongoDB para armazenar as coordenadas e informações dos operadores e kits.
Tecnologias Utilizadas
ESP32: Dispositivo de microcontrolador para comunicação IoT.
Hostinger: Hospedagem do site e do backend PHP.
MongoDB: Banco de dados para armazenar as informações dos dispositivos ESP32.
PHP: Backend responsável por receber e processar as requisições do ESP32 e controlar a lógica do sistema.
JavaScript (Frontend): Gerenciamento da lógica de interação dos usuários com o sistema.
HTML/CSS: Estrutura e estilo das páginas web.
SMTP (Hostinger): Para envio de e-mails de recuperação de senha.

Diagrama de blocos que representa nossa arquitetura:

![DIAGRAMA IND4 0 drawio](https://github.com/user-attachments/assets/217c3e4e-eba4-4659-b6fb-0a32f54ea2ad)


Páginas e Funcionalidades

Login e Registro:

Sistema de autenticação robusto com controle de acesso baseado em funções (Supervisor, Operador, Montador).
Redirecionamento automático para as páginas específicas conforme a função do usuário.

Mapa Interativo:

A localização de operadores e kits é atualizada em tempo real.
Supervisores têm uma visão global dos movimentos na fábrica.

Solicitação de Kits:

Montadores podem solicitar kits que são enviados aos operadores.
Os operadores recebem as solicitações e realizam as entregas de kits.

Recuperação de Senha:

Sistema de recuperação de senha implementado via SMTP, permitindo que os usuários redefinam suas senhas de maneira segura.
Imagens do site funcionando:

![Captura_de_tela_2024-09-30_084109](https://github.com/user-attachments/assets/ee61cfea-d762-4453-a948-21f67677a715)
![Captura_de_tela_2024-09-30_083948](https://github.com/user-attachments/assets/1b441dbe-8113-4d9c-956b-596eabe44a14)
![Captura_de_tela_2024-09-30_083852](https://github.com/user-attachments/assets/ac5a0dba-8147-4be9-8d94-2025bb5239a6)
![Captura_de_tela_2024-09-30_082718](https://github.com/user-attachments/assets/3d7e6e2f-a876-4cdd-a26d-b0b353c24236)
![Captura_de_tela_2024-09-30_082700](https://github.com/user-attachments/assets/d7d21742-3498-40fe-8f57-6bb430c5e512)
![Captura_de_tela_2024-09-30_082640](https://github.com/user-attachments/assets/c7e65916-e750-4aff-b0f7-af49484d7bc6)
![Captura_de_tela_2024-09-30_082619](https://github.com/user-attachments/assets/811448fc-55ae-471c-afff-1173e9f34043)
![Captura_de_tela_2024-09-30_082541](https://github.com/user-attachments/assets/3204694e-ba27-4b4c-8834-6eff3c70586f)
![Captura_de_tela_2024-09-30_082523](https://github.com/user-attachments/assets/bddd4290-ffbd-48b4-9664-e8f26e8bb82d)
![Captura_de_tela_2024-09-30_082458](https://github.com/user-attachments/assets/288b2461-c153-460f-9c9a-f223a40f228b)
![Captura_de_tela_2024-09-30_082443](https://github.com/user-attachments/assets/91a32411-684a-4c8b-b4d8-f341374c71a7)
![Captura_de_tela_2024-09-30_082422](https://github.com/user-attachments/assets/7c369ec1-af29-4395-9a5f-918deedb882d)

Imagens do prototipo ESP32 e banco de dados:

![Captura_de_tela_2024-09-30_090436](https://github.com/user-attachments/assets/c09d51c3-e9f1-408a-a003-3af42fc74e93)
![Captura_de_tela_2024-09-30_090348](https://github.com/user-attachments/assets/d83731db-19d0-4838-b79e-01552f40d893)
![Captura_de_tela_2024-09-30_085904](https://github.com/user-attachments/assets/4382f03e-7a11-4532-8e0a-60fe8942b7b7)
![Captura_de_tela_2024-09-30_085521](https://github.com/user-attachments/assets/e453e0ac-7a9e-4e20-a1e3-ce613214bdb6)

Design

Adotamos um design minimalista inspirado nas cores da Uber, focando em um esquema de cores preto e branco, que reflete a simplicidade e elegância do projeto. A interface é responsiva, garantindo uma experiência de uso agradável tanto em desktops quanto em dispositivos móveis.
Resultados
Até o momento, conseguimos integrar com sucesso os seguintes resultados:

Localização em Tempo Real: 

O sistema já está funcionando com a localização em tempo real dos operadores e dos carrinhos de kits. As coordenadas são atualizadas de forma fluida, permitindo que os supervisores acompanhem todo o fluxo de movimentação na fábrica.

Sistema de Solicitação de Kits:

 O fluxo de solicitações entre montadores e operadores está funcional e otimizado, reduzindo o tempo de espera para entrega de kits.
Recuperação de Senhas: O sistema de recuperação de senha foi configurado corretamente e está funcionando via e-mail.

Código Fonte

O código-fonte completo do projeto pode ser encontrado na pasta /public_html. 

Ele inclui:

Frontend: Todos os arquivos HTML, CSS e JavaScript necessários para o funcionamento do site.
Backend: Os scripts PHP que fazem a lógica de comunicação com o ESP32 e o banco de dados.

Vídeo de Demonstração

Assista à demonstração do projeto em funcionamento no vídeo abaixo:

Link para o vídeo no YouTube

https://www.youtube.com/watch?v=jGpozfe2yeo

Conclusão

O projeto JDUBER é um passo significativo na implementação de tecnologias da Indústria 4.0 dentro da John Deere. Através da automação da logística interna e do uso de IoT, esperamos melhorar a eficiência e a transparência das operações dentro da planta, além de facilitar o dia a dia dos operadores, montadores e supervisores.
