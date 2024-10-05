<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: ZATU | Relatórios ::</title>
</head>
<body>
    <header>
        <div class="img">
            <img src="./assets/images/logo-prefeitura.svg" alt="">
        </div>
        <div class="data">
            <span>COMPROVANTE DE ATUALIZAÇÃO CADASTRAL ONLINE 2022</span>
            <span>Data/Hora da Alteração: 26/03/2022 13:00:26</span>
        </div>
    </header>
    <div class="content">
        <div class="user-info">
            <span><strong>Servidor:</strong> MILTON CESAR MARÇAL DA SILVA</span>
            <span><strong>CPF:</strong> 096.733.009-72</span>
        </div>
        <div class="list-info">
            <ul>
                <li><strong>Situação:</strong> EXERCICIO</li>
                <li><strong>Secretaria:</strong> SECRETARIA DE ESTADO DA EDUCAÇÃO CULTURA E ESPORTE</li>
                <li><strong>Setor:</strong> DIRETORIA DE REP DA SEE NOS MUNICIPIOS</li>
                <li><strong>Município:</strong> TARAUACA/AC</li>
            </ul>
        </div>
        
        <p>Caro(a) servidor(a), você deverá aguardar a validação de suas informações pela chefia imediata e após pelo Setor de Recursos Humano da 
Secretaria Municipal de Administração, caso a atualização resulte em divergência de informações, deverão ser sanadas no prazo de 02 Dias úteis 
para conclusão da atualização cadastral anual, após sanadas, aparecerá em sua área de usuário o status FINALIZADO.</p>

        <table>
            <thead>
                <tr>
                    <th width="50%">Campo</th>
                    <th width="50%">Conteúdo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Data de Exp. Registro Civil</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Setor Exercício</td>
                    <td>DIRETORIA DE REP DA SEE NOS MUNICIPIOS</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Secretaria Exercício</td>
                    <td>SECRETARIA DE ESTADO DA EDUCAÇÃO CULTURA E ESPORTE</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Setor Exercício</td>
                    <td>DIRETORIA DE REP DA SEE NOS MUNICIPIOS</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Secretaria Exercício</td>
                    <td>SECRETARIA DE ESTADO DA EDUCAÇÃO CULTURA E ESPORTE</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Setor Exercício</td>
                    <td>DIRETORIA DE REP DA SEE NOS MUNICIPIOS</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Secretaria Exercício</td>
                    <td>SECRETARIA DE ESTADO DA EDUCAÇÃO CULTURA E ESPORTE</td>
                </tr>
                <tr>
                    <td>Contrato: 1 - Situação do Contrato</td>
                    <td>EXERCICIO</td>
                </tr>
            </tbody>
        </table>

        <p><strong>IMPORTANTE : Sua atualização será concluída após a validação das informações pelo Setor de Recursos Humano da Secretaria 
Municipal de Administração.</strong></p>
        <p><strong>Esse comprovante permanecerá em sua área de usuário para consulta a qualquer momento.</strong></p>
    
        <div class="authenticator">
            <p>Código de Autenticidade:</p>
            <span>13B6.B45D.1E20.24AB.183F.9E82.BA27.E0F6</span>
        </div>
    </div>
    <footer>
        <div class="logo">
            <img src="./assets/images/zatu-logo.svg" alt="">
        </div>
        <div class="text">
            <p>Copyright © Prefeitura Municipal de Tarauacá - Desenvolvido por Wessix Tecnologia e Informação</p>
        </div>
    </footer>
</body>
</html>

<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Calibri, Helvetica, sans-serif;
    }
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #c1c1c1;
        height:120px;
    }
    header .img{
        width: 240px;
    }
    header .img img{
        width: 100%;
    }
    header .data{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    header .data span{
        font-size:15px;
        font-weight:bold;
    }

    .content{
        padding: 20px;
        min-height: calc(100vh - 200px);
    }
    .content .user-info{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .content .user-info span{
        padding: 0 20px 0 0;
        text-transform: uppercase;
    }
    .content .user-info span strong{
        text-transform: capitalize;
    }
    .content .list-info {
        display: flex;
    }
    .content .list-info ul{
        width:50%;
        min-width: 300px;
        list-style: none;
        padding: 0;
        margin: 20px 0;
        display: flex;
        flex-direction: column;
        
    }
    .content .list-info ul li span{
        text-transform: uppercase;
    }
    .content .list-info ul li span strong{
        text-transform: capitalize;
    }
    .content table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .content table thead{
        border-bottom: 1px solid #c1c1c1;
    }
    .content table th {
        text-align:left;
        padding: 10px 5px;
        text-transform: uppercase;
        font-size: 12px;
    }
    .content table tbody{
        border-bottom: 1px solid #c1c1c1;
    }
    .content table td {
        text-align: left;
        padding: 10px 5px;
        font-size: 12px;
    }
    .content table tbody tr{
        border-bottom: 1px solid #f1f1f1;
    }
    .content table tbody tr:last-child{
        border-bottom: none;
    }
    .content table tbody tr:nth-child(even){
        background-color: #f1f1f1;
    }
    .content .authenticator{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
    }
    .content .authenticator p{
        font-weight: bold;
        font-size: 14px;
    }
    footer {
        border-top: 1px solid #c1c1c1;
        height:50px;
        display: flex;
        justify-content:center;
        align-items: center;
        flex-direction: column;
    }
    footer .logo img {
        width:90px;
    }
    footer .text {
        font-weight:bold;
        font-size:13px;
    }
</style>