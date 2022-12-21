<x-header :bootstrap="$bootstrap"/>
<x-navbar :navbar="$navbar"/>

<div class="client-container">
    <?php if(isset($clients)): ?>
        <div class="header_fixed">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php for($i = 0; $i < count($clients); $i++): ?>
                        <tr>
                            <td>{{ $clients[$i]["firstname"] .  ' ' . $clients[$i]["lastname"] }}</td>
                            <td>{{ $clients[$i]["telefone"] }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$clients[$i]["id"]}}" data-whatever="@mdo{{$clients[$i]["id"]}}">Editar</button>
                                <div class="modal fade" id="exampleModal{{$clients[$i]["id"]}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$clients[$i]["id"]}}" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color: #000; text-align: left">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{$clients[$i]["id"]}}">{{ $clients[$i]["firstname"] .  ' ' . $clients[$i]["lastname"] }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">

                                        <form action="{{ route('client.update', $clients[$i]["id"]) }}" method="POST">
                                          @method('put')
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <label for="firstname" class="col-form-label">Nome:</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$clients[$i]["firstname"]}}">
                                          </div>

                                          <div class="form-group">
                                            <label for="lastname" class="col-form-label">Sobrenome:</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$clients[$i]["lastname"]}}">
                                          </div>

                                          <div class="form-group" style="width: 230px">
                                            <label for="complement" class="col-form-label">Complemento:</label>
                                            <textarea class="form-control" id="complement" name="complement" placeholder="Insira um complemento">{{$clients[$i]["complement"]}}</textarea>
                                          </div>

                                          <div class="form-group">
                                            <label for="cpf" class="col-form-label">CPF/CNPJ:</label>
                                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{$clients[$i]["cpf"]}}">
                                          </div>

                                          <div class="form-group">
                                            <label for="address" class="col-form-label">Endereço:</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{$clients[$i]["address"]}}">
                                          </div>

                                          <div class="form-group">
                                            <label for="telefone" class="col-form-label">Telefone:</label>
                                            <input type="text" class="form-control" id="telefone" name="telefone" value="{{$clients[$i]["telefone"]}}">
                                          </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                          </div>
                                        </form>

                                      </div>
                        
                                    </div>
                                  </div>
                                </div>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delUserModal{{$clients[$i]["id"]}}">Apagar</button>
                                <div class="modal fade" id="delUserModal{{$clients[$i]["id"]}}" tabindex="-1" role="dialog" aria-labelledby="delUserModalLabel{{$clients[$i]["id"]}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="delUserModalLabel{{$clients[$i]["id"]}}" style="color: #000">Apagar Cliente</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body" style="color: #000">
                                          Tem certeza que deseja apagar {{ $clients[$i]["firstname"] .  ' ' . $clients[$i]["lastname"] }} ?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                          <form action="{{ route('client.destroy', $clients[$i]["id"]) }}" method="post">
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

<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#newClientModal" data-whatever="newClientModal">Cadastrar novo cliente</button>
<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClientModalLabel">Preencha os campos!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('client.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="firstname" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Insira o primeiro nome">
          </div>

          <div class="form-group">
            <label for="lastname" class="col-form-label">Sobrenome:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Insira o sobrenome">
          </div>

          <div class="form-group" style="width: 230px">
            <label for="complement" class="col-form-label">Complemento:</label>
            {{-- <input type="text" class="form-control" id="complement" name="complement" placeholder="Insira o Complemento"> --}}
            <textarea class="form-control" id="complement" name="complement" placeholder="Insira um complemento"></textarea>
          </div>

          <div class="form-group">
            <label for="cpf" class="col-form-label">CPF/CNPJ:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Insira o CPF/CNPJ">
          </div>

          <div class="form-group">
            <label for="address" class="col-form-label">Endereço:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Insira o Endereço">
          </div>

          <div class="form-group">
            <label for="telefone" class="col-form-label">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Insira o nº de telefone">
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