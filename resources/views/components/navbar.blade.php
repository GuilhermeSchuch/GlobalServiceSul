<nav>
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="img/logo.png" alt="" width="40px" height="40px"/>
            <span>Global</span>
        </a>
    </div>

    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>

    <ul>
       <li><a href="{{ route('home') }}" id="home">Home</a></li>
       <li><a href="{{ route('client') }}" id="client">Clientes</a></li>
       <li><a href="{{ route('service') }}" id="service">Serviços</a></li>
       <li><a href="#">Gallery</a></li>
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
    }
?>