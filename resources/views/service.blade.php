<x-header :bootstrap="$bootstrap"/>
<x-navbar :navbar="$navbar"/>

<div class="buttons">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filtrar por...
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php if(str_contains(url()->current(), "pending")): ?>
                <a class="dropdown-item active" href="{{ route('service.pending') }}">Pendente</a>
                <a class="dropdown-item" href="{{ route('service.done') }}">Concluido</a>
                <a class="dropdown-item" href="{{ route('service') }}">Limpar filtro</a>

            <?php elseif(str_contains(url()->current(), "done")): ?>
                <a class="dropdown-item" href="{{ route('service.pending') }}">Pendente</a>
                <a class="dropdown-item active" href="{{ route('service.done') }}">Concluido</a>
                <a class="dropdown-item" href="{{ route('service') }}">Limpar filtro</a>

            <?php else: ?>
                <a class="dropdown-item" href="{{ route('service.pending') }}">Pendente</a>
                <a class="dropdown-item" href="{{ route('service.done') }}">Concluido</a>
                <a class="dropdown-item" href="{{ route('service') }}">Limpar filtro</a>
            <?php endif; ?>


        </div>
    </div>
</div>

<div class="service-container">

    @if (!request()["pending"])
        <?php
            if(isset($services)):?>
                <div class="header_fixed">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cliente</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for($i = 0; $i < count($services); $i++): ?>
                                <tr>
                                    <td>
                                        {{ $services[$i]["name"] }}

                                        @if ($services[$i]["status"] === 1)
                                            <img src="{{ url('img/flaticon/pending.png') }}" alt="Pendente" width="30px">
                                        @else
                                            <img src="{{ url('img/flaticon/done.png') }}" alt="Concluido" width="30px">
                                        @endif
                                    </td>

                                    <td>{{ $services[$i]["firstname"] . ' ' . $services[$i]["lastname"]}}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary delete-modal" data-toggle="modal" data-target="#exampleModal{{ $services[$i]["id"] }}" data-whatever="@mdo{{ $services[$i]["id"] }}">Ver mais</button>
                                        <div class="modal fade delete-modal" id="exampleModal{{ $services[$i]["id"] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $services[$i]["id"] }}" aria-hidden="true">


                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header" style="color: #000">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $services[$i]["id"] }}">{{ $services[$i]["name"] }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="color: #000">

                                                <form action="{{ route('service.update', $services[$i]["id"]) }}" method="POST" id="edit-form">
                                                    @method('put')
                                                    {{ csrf_field() }}
                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="name" class="col-form-label">Nome:</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $services[$i]["name"] }}">
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="description" class="col-form-label">Descrição:</label>
                                                        {{-- <input type="text" class="form-control" id="description" name="description" value="{{ $services[$i]["description"] }}"> --}}
                                                        <textarea class="form-control" id="description" name="description">{{ $services[$i]["description"] }}</textarea>
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="price" class="col-form-label" >Preço:</label>
                                                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Insira o preço" value="{{ $services[$i]["price"] }}">
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="qtd" class="col-form-label" >Quantidade:</label>
                                                        <input type="number" class="form-control" id="qtd" name="qtd" placeholder="Insira a quantidade" value="{{ $services[$i]["qtd"] }}">
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="status" class="col-form-label">Status:</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <?php if(isset($status)): ?>
                                                                <?php
                                                                    foreach ($status as $stats) {
                                                                        if($services[$i]["status"] == $stats["id"]){
                                                                            echo "<option value='" . $stats["id"] . "' selected>";
                                                                                echo $stats["status"];
                                                                            echo "</option>";
                                                                        }
                                                                        else{
                                                                            echo "<option value='" . $stats["id"] . "'>";
                                                                                echo $stats["status"];
                                                                            echo "</option>";
                                                                        }
                                                                    }
                                                                ?>
                                                        <?php endif; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="creationDate" class="col-form-label">Data de criação:</label>
                                                        <input type="text" class="form-control" id="creationDate" name="creationDate" value="{{ date('d/m/Y',  strtotime($services[$i]["creationDate"])) }}" disabled>
                                                    </div>

                                                    @if ($services[$i]["status"] == 2)
                                                        <div class="form-group" style="min-width: 230px">
                                                            <label for="endingDate" class="col-form-label">Data serviço finalizado:</label>
                                                            <input type="date" class="form-control" id="endingDate" name="endingDate" value="{{ $services[$i]["endingDate"] }}" disabled>
                                                        </div>
                                                    @endif

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="client" class="col-form-label">Cliente:</label>
                                                        {{-- <input type="text" class="form-control" id="client" name="client" value="{{ $services[$i]["firstname"] . ' ' . $services[$i]["lastname"] }}" disabled> --}}
                                                        <select class="form-control" id="client" name="client">
                                                            <?php if(isset($clients)): ?>
                                                                <?php
                                                                    foreach ($clients as $client) {
                                                                        if($services[$i]["id_client"] == $client["id"]){
                                                                            echo "<option value='" . $client["id"] . "' selected>";
                                                                                echo $client["firstname"] . ' ' .  $client["lastname"];
                                                                            echo "</option>";
                                                                        }
                                                                        else{
                                                                            echo "<option value='" . $client["id"] . "'>";
                                                                                echo $client["firstname"] . ' ' .  $client["lastname"];
                                                                            echo "</option>";
                                                                        }
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="min-width: 230px">
                                                        <label for="identifier" class="col-form-label">Identificador:</label>
                                                        <input type="text" class="form-control" id="identifier" name="identifier" value="{{ $services[$i]["id"] }}" disabled>
                                                    </div>

                                                    @foreach ($budget as $nf)
                                                        @if ($nf["id_service"] == $services[$i]['id'])
                                                            <div class="form-group nf" style="min-width: 230px">
                                                                <div class="nf-item">
                                                                    <a href="{{ route('pdf', $nf["id_budget"]) }}" target="_blank" style="margin-right: 5px">Ver nota {{ $nf["id_budget"] }}</a>
                                                                </div>

                                                                <div class="nf-item">
                                                                    <form action=""></form>
                                                                    <form id="delete-form" action="{{ route('budget.destroy', $nf["id_budget"]) }}" method="post" style="padding:  0;" onclick="handleDelete()">
                                                                        @method('delete')
                                                                        {{ csrf_field() }}

                                                                        <button type="submit" class="btn btn-primary" style="background-color: transparent; border: 0; padding: 0;"><img src="{{ url('img/flaticon/trash.png') }}" alt="Del" width="15px"></button>

                                                                        <script>
                                                                            const handleDelete = (e) => {
                                                                                var deleteForm = document.querySelector('#delete-form');
                                                                                var editForm = document.querySelector('#edit-form');

                                                                                deleteForm.addEventListener('submit', function(event) {
                                                                                    event.preventDefault();
                                                                                    preventEditFormSubmit();
                                                                                });

                                                                                function preventEditFormSubmit() {
                                                                                    editForm.addEventListener('submit', function(event) {
                                                                                        event.preventDefault();
                                                                                    });
                                                                                }
                                                                            }


                                                                            const handleEdit = () => {
                                                                                var deleteForm = document.querySelector('#delete-form');
                                                                                deleteForm.innerHTML = null;
                                                                            }
                                                                        </script>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    @endforeach
                                                    {{-- @foreach ($budget as $nf)
                                                        @if ($nf["id_service"] == $services[$i]['id'])
                                                            <div class="form-group nf" style="min-width: 230px">
                                                                <div class="nf-item">
                                                                    <a href="{{ route('pdf', $nf["id_budget"]) }}" target="_blank" style="margin-right: 5px">Ver nota {{ $nf["id_budget"] }}</a>
                                                                </div>

                                                                <div class="nf-item">
                                                                    <form action="{{ route('budget.destroy', $nf["id_budget"]) }}" method="post" style="padding:  0;">
                                                                        @method('delete')
                                                                        {{ csrf_field() }}

                                                                        <button type="submit" class="btn btn-primary" style="background-color: transparent; border: 0; padding: 0;"><img src="{{ url('img/flaticon/trash.png') }}" alt="Del" width="15px"></button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach --}}

                                                    {{-- <div class="form-group" style="min-width: 230px">
                                                        @if ($services[$i]["status"] == 1)

                                                        @endif
                                                    </div> --}}

                                                    <div class="modal-footer" style="min-width: 230px">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary" onclick="handleEdit()">Salvar1</button>
                                                    </div>
                                                </form>

                                            </div>

                                            </div>
                                        </div>
                                        </div>

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delUserModal{{ $services[$i]["id"] }}">Apagar</button>
                                        <div class="modal fade" id="delUserModal{{ $services[$i]["id"] }}" tabindex="-1" role="dialog" aria-labelledby="delUserModalLabel{{ $services[$i]["id"] }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="color: #000">
                                                        <h5 class="modal-title" id="delUserModalLabel{{ $services[$i]["id"] }}">Apagar Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body" style="color: #000">
                                                    Tem certeza que deseja apagar {{ $services[$i]["name"] }} ?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                                        <form action="{{ route('service.destroy', $services[$i]["id"]) }}" method="post">
                                                            @method('delete')
                                                            {{ csrf_field() }}

                                                            <button type="submit" class="btn btn-primary">Apagar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
        <?php endif; ?>
    @else
    @endif
</div>


<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#newService" data-whatever="newService">Cadastrar novo serviço</button>
<div class="modal fade" id="newService" tabindex="-1" role="dialog" aria-labelledby="newServiceLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClientModalLabel">Preencha os campos!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('service.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group" style="min-width: 230px">
            <label for="name" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Dê um título ao serviço">
          </div>

          <div class="form-group" style="min-width: 230px">
            <label for="description" class="col-form-label" >Descrição:</label>
            {{-- <input type="text" class="form-control" id="description" name="description" placeholder="Insira o sobrenome"> --}}
            <textarea class="form-control" id="description" name="description" placeholder="Insira a descrição"></textarea>
          </div>

          <div class="form-group" style="min-width: 230px">
            <label for="price" class="col-form-label" >Preço unitário:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Insira o preço">
          </div>

          <div class="form-group" style="min-width: 230px">
            <label for="qtd" class="col-form-label" >Quantidade:</label>
            <input type="number" class="form-control" id="qtd" name="qtd" placeholder="Insira a quantidade">
          </div>

          <div class="form-group" style="min-width: 230px">
            <label for="creationDate" class="col-form-label">Data de criação: </label>
            <input type="date" class="form-control" id="creationDate" name="creationDate">
          </div>

          <div class="form-group" style="min-width: 230px">
            <label for="client" class="col-form-label">Cliente:</label>
            {{-- <input type="text" class="form-control" id="client" name="client" placeholder="Insira o Endereço"> --}}
            <select class="form-control" id="client" name="client">
                <?php if(isset($clients)): ?>
                    <?php
                        foreach ($clients as $client) {
                            echo "<option value='" . $client["id"] . "'>";
                                echo $client["firstname"] . ' ' .  $client["lastname"];
                            echo "</option>";
                        }
                    ?>
                <?php endif; ?>
            </select>

            <a href="{{ route('client') }}">Criar cliente</a>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>



<x-footer />
