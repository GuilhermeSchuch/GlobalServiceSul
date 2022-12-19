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
       <li><a href="#" id="home">Home</a></li>
       <li><a href="#" id="cliente">Clientes</a></li>
       <li><a href="#">Services</a></li>
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
        elseif ($navbar == "cliente") {
            echo "<script>";
                echo "const item = document.querySelector('#cliente');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
        elseif ($navbar == "chart") {
            echo "<script>";
                echo "const item = document.querySelector('#chart');";
                echo "item.classList.add('active');";
            echo "</script>";
        }
    }
?>