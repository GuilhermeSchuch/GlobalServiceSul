<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota fiscal</title>
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
                <h1>Orçamento número</h1>
            </div>

            <?php

                if(isset($data)){

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Nome: </span>"; echo $data["name"];
                    echo "</div>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Cliente: </span>"; echo $data["firstname"] . ' ' . $data["lastname"];
                    echo "</div>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Descrição: </span>"; echo $data["description"];
                    echo "</div class='data-container'>";

                    echo "<div class='data-container'>";
                        echo "<span class='bold'>Data de emissão: </span>"; echo DateTime::createFromFormat('Y-m-d', $data["creationDate"])->format("d/m/Y");;
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>