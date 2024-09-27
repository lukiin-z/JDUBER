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

Design
Adotamos um design minimalista inspirado nas cores da Uber, focando em um esquema de cores preto e branco, que reflete a simplicidade e elegância do projeto. A interface é responsiva, garantindo uma experiência de uso agradável tanto em desktops quanto em dispositivos móveis.
Resultados
Até o momento, conseguimos integrar com sucesso os seguintes resultados:
Localização em Tempo Real: O sistema já está funcionando com a localização em tempo real dos operadores e dos carrinhos de kits. As coordenadas são atualizadas de forma fluida, permitindo que os supervisores acompanhem todo o fluxo de movimentação na fábrica.
Sistema de Solicitação de Kits: O fluxo de solicitações entre montadores e operadores está funcional e otimizado, reduzindo o tempo de espera para entrega de kits.
Recuperação de Senhas: O sistema de recuperação de senha foi configurado corretamente e está funcionando via e-mail.

Código Fonte
O código-fonte completo do projeto pode ser encontrado na pasta /scr. Ele inclui:
Frontend: Todos os arquivos HTML, CSS e JavaScript necessários para o funcionamento do site.
Backend: Os scripts PHP que fazem a lógica de comunicação com o ESP32 e o banco de dados.
Vídeo de Demonstração
Assista à demonstração do projeto em funcionamento no vídeo abaixo:

Link para o vídeo no YouTube

Conclusão
O projeto JDUBER é um passo significativo na implementação de tecnologias da Indústria 4.0 dentro da John Deere. Através da automação da logística interna e do uso de IoT, esperamos melhorar a eficiência e a transparência das operações dentro da planta, além de facilitar o dia a dia dos operadores, montadores e supervisores.
