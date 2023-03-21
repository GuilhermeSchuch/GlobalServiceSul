<nav>
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ url('img/logo.png') }}" alt="" width="40px" height="40px"/>
            <span>Global</span>
        </a>
    </div>


    <ul>
       <li>
            <form action="" method="GET" id="search-form" class="search-form">
                @if ($navbar === "service")
                    @if (request()["query"])
                        <input type="text" name="query" id="query" class="form-control mr-sm-2" type="search" placeholder="Pesquise pelo idr" value="{{ request()['query'] }}">
                        <a href="{{ route('service') }}">Limpar</a>
                    @else
                        <input type="text" name="query" id="query" class="form-control mr-sm-2" type="search" placeholder="Pesquise pelo id">
                    @endif
                @endif

                @if ($navbar === "client")
                    @if (request()["query"])
                        <input type="text" name="query" id="query" class="form-control mr-sm-2" type="search" placeholder="Pesquise pelo nome" value="{{ request()['query'] }}">
                        <a href="{{ route('client') }}">Limpar</a>
                    @else
                        <input type="text" name="query" id="query" class="form-control mr-sm-2" type="search" placeholder="Pesquise pelo nome">
                    @endif
                @endif

                <button class="btn my-2 my-sm-0" type="submit" style="display: none"></button>
            </form>
       </li>

       <li><a href="{{ route('client') }}" id="client">Clientes</a></li>
       <li><a href="{{ route('service') }}" id="service">Serviços</a></li>
       <li><a href="{{ route('budget') }}" id="budget">Orçamentos</a></li>
       <li><a href="{{ route('logout') }}">Sair</a></li>
    </ul>
 </nav>

 <?php
    if(isset($navbar)){
        if($navbar == "home"){
            echo "<script>";
                echo "const item = document.querySelector('#home');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
        elseif ($navbar == "client") {
            echo "<script>";
                echo "const item = document.querySelector('#client');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
        elseif ($navbar == "service") {
            echo "<script>";
                echo "const item = document.querySelector('#service');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
        elseif ($navbar == "budget") {
            echo "<script>";
                echo "const item = document.querySelector('#budget');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
    }
?>
