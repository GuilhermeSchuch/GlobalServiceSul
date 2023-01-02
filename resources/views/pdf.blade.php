<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orçamento</title>
</head>

<style>
    body{
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .pdf-container{
        /* border: 1px solid red; */
        display: flex;
        flex-direction: column;
    }

    .logo{
        /* border: 1px solid blue; */
        display: flex;
        flex-direction: row;
    }

    .logo h1{
        /* border: 1px solid green; */
        font-size: 20px;
        margin: 0;
    }

    .logo img{
        /* border: 1px solid green; */
    }

    .bold{
        font-weight: bold;
        margin-bottom: 10px;
    }

    .data-container{
        margin-bottom: 10px;
        border: 1px solid #000;
        padding: 3px;
    }

    .address{
        font-size: 13px;
        padding: 5px 0;
    }

    .address p{
        margin: 0;
    }

    .data-header{
        font-size: 10px;
        text-align: center;
    }

    .header_fixed {
        max-height: 100vh;
        width: 100%;
        overflow: auto;
        border: 1px solid #dddddd;
        text-align: center;
        
    }

    .header_fixed thead th {
        /* position: sticky; */
        top: 0;
        background-color: black;
        color: #e6e7e8;
        font-size: 15px;
        text-align: center;
    }

    th,
    td {
        border-bottom: 1px solid #dddddd;
        padding: 10px 20px;
        font-size: 14px;
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    tr:nth-child(odd) {
        background-color: #edeef1;
    }

    #desc{
        min-width: 450px;
    }

</style>

<body>
    <div class="pdf-container">
        
        <div class="logo">
            <h1>
                GLOBALSERVICESUL INFORMATICA E ELETRONICA
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Tux.png/220px-Tux.png" width="40px" height="40px" style="margin: 0">
            </h1>
        </div>

        <div class="address">
            <p>NESTOR VILAS BOAS, 155, IGREJINHA</p>
            <p>(51) 991760039</p>
        </div>

        <div class="data">
            <div class="data-header">
                <h1>ORÇAMENTO - Nº. 0003</h1>
            </div>

            <?php

                if(isset($data)){

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Razão Social / Nome: </span>"; echo $data["firstname"] . ' ' . $data["lastname"];
                    echo "</div>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Endereço: </span>"; echo $data["address"];
                    echo "</div class='data-container'>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Tel: </span>"; echo $data["telefone"];
                    echo "</div class='data-container'>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>CPF/CNPJ: </span>"; echo $data["cpf"];
                    echo "</div class='data-container'>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Data de emissão: </span>"; echo DateTime::createFromFormat('Y-m-d', $data["creationDate"])->format("d/m/Y");;
                    echo "</div>";
                }
            ?>

            <?php if(isset($services)): ?>
                <div class="header_fixed">
                    <table>
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th id="desc">Descrição</th>
                                <th>Valor</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service["id"] }}</td>
                                    <td>{{ $service["description"] }}</td>
                                    <td>R$ {{ $service["price"] }}</td>
                                </tr>
                            @endforeach

                            @if (isset($totalPrice))
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total: R$ {{ number_format($totalPrice["total"], 2) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            
            @if (isset($notes))
                <h3>Anotações:</h3>
                <p>{{ $notes["notes"] }}</p>
            @endif
            
        </div>

        <div class="data-footer">
            <h3>Assinatura do emitente: _______________________________</h3>
        </div>
    </div>
</body>
</html>