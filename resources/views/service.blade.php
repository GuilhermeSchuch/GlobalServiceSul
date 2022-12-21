<x-header :bootstrap="$bootstrap"/>
<x-navbar :navbar="$navbar"/>

<div class="service-container">
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $services[$i]["id"] }}" data-whatever="@mdo{{ $services[$i]["id"] }}">Editar</button>
                                    <div class="modal fade" id="exampleModal{{ $services[$i]["id"] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $services[$i]["id"] }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header" style="color: #000">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $services[$i]["id"] }}">{{ $services[$i]["name"] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="color: #000">

                                            <form action="{{ route('service.update', $services[$i]["id"]) }}" method="POST">
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

                                            <div class="form-group" style="min-width: 230px">
                                                <label for="endingDate" class="col-form-label">Data serviço finalizado:</label>
                                                <input type="date" class="form-control" id="endingDate" name="endingDate" value="{{ $services[$i]["endingDate"] }}">
                                            </div>

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

                                            <div class="modal-footer" style="min-width: 230px">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
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