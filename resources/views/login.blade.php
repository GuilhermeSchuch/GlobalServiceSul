<x-header :bootstrap="$bootstrap"/>

    @if (Session::get('error'))
        <div class="alert alert-danger msg">{{ Session::get('error') }}</div>
    @endif

    @if (isset($userData))
        <?php print_r($userData); ?>
    @endif

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{ route('login') }}" class="sign-in-form" method="POST">
            {{ csrf_field() }}
            <h2 class="title">Login</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="E-mail" id="login_email" name="login_email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Senha" name="login_password" id="login_password"/>
            </div>
            <input type="submit" value="Login" class="btn-auth solid" />
          </form>
          <form action="{{ route('register') }}" class="sign-up-form" method="POST">
            {{ csrf_field() }}
            <h2 class="title">Cadastrar</h2>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nome" name="name" id="name"/>
            </div>

            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Sobrenome"  name="lastname" id="lastname"/>
              </div>

            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="E-mail" id="email" name="email"/>
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Senha" name="password" id="password"/>
            </div>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirmar senha" name="confirmpassword" id="confirmpassword"/>
              </div>

            <input type="submit" class="btn-auth" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Novo por aqui ?</h3>
            <p>
              Crie sua conta!
            </p>
            <button class="btn-auth transparent" id="sign-up-btn">Cadastrar</button>
          </div>
          {{-- <img src="img/log.svg" class="image" alt="" /> --}}
          <img src="img/logo.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Já cadastrado ?</h3>
            <p>
              Acesse a página de Login!
            </p>
            <button class="btn-auth transparent" id="sign-in-btn">
              Login
            </button>
          </div>
          <img src="img/logo.png" class="image" alt="" />
        </div>
      </div>
    </div>

<x-footer />