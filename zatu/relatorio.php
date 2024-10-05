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
            <img src="./assets/images/brasao_tarauaca.png" alt="">
        </div>
        <div class="info">
            <span>Estado do Acre</span>
            <span>Prefeitura Municipal de Tarauacá</span>
            <span>Secretaria Municipal de Administração</span>
            <span>Coordenação de Recursos Humanos</span>
        </div>
        <div class="data">
            <span><strong>Data:</strong> 22/01/2022</span>
            <span><strong>Hora:</strong> 16:35</span>
            <span><strong>Usuário:</strong> 10057</span>
        </div>
    </header>
    <div class="content">
        <h1>Relatório de Servidores por Mês de Aniversário</h1>
        <div class="list-info">
            <ul>
                <li><strong>Comarca:</strong> Todos</li>
                <li><strong>Lotação:</strong> Todos</li>
                <li><strong>Atualização Cadastral:</strong> Todos</li>
            </ul>
            <ul>
                <li><strong>Mês de Aniversário:</strong> Janeiro</li>
                <li><strong>Tipo de Pessoa:</strong> Servidor</li>
                <li><strong></strong></li>
            </ul>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Tipo Pessoa</th>
                    <th>Lotação Atual</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>323243</td>
                    <td>Rogério Moura Rosas Marinho Júnior</td>
                    <td>26/04/1992</td>
                    <td>Médico</td>
                    <td>Secretaria de Saúde</td>
                    <td>rogerio.marinho@gmail.com</td>
                    <td>(68)99966-6666</td>
                </tr>
                <tr>
                    <td>323243</td>
                    <td>Rogério Moura Rosas Marinho Júnior</td>
                    <td>26/04/1992</td>
                    <td>Médico</td>
                    <td>Secretaria de Saúde</td>
                    <td>rogerio.marinho@gmail.com</td>
                    <td>(68)99966-6666</td>
                </tr>
                <tr>
                    <td>323243</td>
                    <td>Rogério Moura Rosas Marinho Júnior</td>
                    <td>26/04/1992</td>
                    <td>Médico</td>
                    <td>Secretaria de Saúde</td>
                    <td>rogerio.marinho@gmail.com</td>
                    <td>(68)99966-6666</td>
                </tr>
                <tr>
                    <td>323243</td>
                    <td>Rogério Moura Rosas Marinho Júnior</td>
                    <td>26/04/1992</td>
                    <td>Médico</td>
                    <td>Secretaria de Saúde</td>
                    <td>rogerio.marinho@gmail.com</td>
                    <td>(68)99966-6666</td>
                </tr>
                <tr>
                    <td>323243</td>
                    <td>Rogério Moura Rosas Marinho Júnior</td>
                    <td>26/04/1992</td>
                    <td>Médico</td>
                    <td>Secretaria de Saúde</td>
                    <td>rogerio.marinho@gmail.com</td>
                    <td>(68)99966-6666</td>
                </tr>
            </tbody>
        </table>
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
        justify-content: flex-start;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #c1c1c1;
        height:120px;
    }
    header .img{
        width: 100px;
    }
    header .img img{
        width: 100%;
    }
    header .info{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: calc(100% - 250px);
        padding: 0 10px;
    }
    header .info span {
        font-size:15px;
        font-weight: 400;
    }
    header .data{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 150px;
    }
    header .data span{
        font-size:15px;
    }

    .content{
        padding: 20px;
        min-height: calc(100vh - 170px);
    }
    .content h1{
        text-align: center;
        font-size: 24px;
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
    .content table {
        width: 100%;
        border-collapse: collapse;
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