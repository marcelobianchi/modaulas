# ModAulas

## Instruções de instalação:

Para instalar o modaulas siga as instruções abaixo:

 1) O pacote modaulas deve ser instalado diretamente em uma pasta
 disponível pelo seu servidor Apache (ou servidor compatível com 
 suporte a PHP). O modaulas é totalmente escrito em PHP e precisa
 ter acesso a uma pasta de dados, onde ele deve poder escrever.

 Localize a pasta raiz do seu servidor WEB, em geral, para instalações
 padrão esta pasta fica em /var/www ou ainda /srv/www. Em algumas distribuições
 o apache também permite o usuário a disponibilizar um site a partir do
 seu HOME, normalmente a partir da pasta ~/public_html/.

 2) Vamos assumir que o seu apache lê os arquivos da pasta /var/www. Inicialmente mude para esta pasta:

 ```bash
 % cd /var/www
 ```

 3) Crie um diretório, por exemplo 'agg000'

 ```bash
 % mkdir agg000
 ```

 4) Copie o conteudo deste arquivo para este diretório. Dentro do diretório
 voce terá os seguintes arquivos. 

 ```bash
 mbianchi@pulso:/var/www/agg000$ ls
 about.html        EDementa.php   funcoes.php        index.php   style.css
 adm.php           EDfile.php     GETavisos.php      login.php
 EDavisos.php      EDhorario.php  GETcalendario.php  logout.php
 EDcalendario.php  EDsigla.php    GETementa.php      modaulas
 ``` 

 5) Crie um diretório chamado moddata dentro do diretório agg000:

 ```bash
 % mkdir moddata
 ```

 6) Mude a permissão dele para 777 para garantir que o apache pode escrever nesta pasta!

 ```bash
 chmod 777 moddata
 ```

 7) Pronto agora é só acessar o site da sua máquina via o seu navegador que você já deve ver o modaulas.
 Para customizar basta logar na interface de administração, disponível pelo link no canto superior, direito
 da página gerada !

[]'s

Marcelo Bianchi

 > ps. A senha padrão para a administração do sistema é 'modaulas'

