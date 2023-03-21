<x-header :bootstrap="$bootstrap"/>
<x-navbar :navbar="$navbar"/>

{{-- <div class="buttons">
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
</div> --}}

<div class="budget-container">
    <form action="" class="budget-form">
        <div class="form-group" style="min-width: 230px;">
            <label for="client" class="col-form-label">Escolha o cliente:</label>

            <select class="form-control" id="client" name="client">
                <?php echo "<option value=''>"; ?>
                <?php if(isset($clients)): ?>
                    <?php
                        foreach ($clients as $client) {
                            if($qclient == $client["id"]){
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

            <button type="submit" class="btn btn-primary">Escolher</button>
        </div>
    </form>

<div class="button">
  <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#newService" data-whatever="newService">Criar novo orçamento</button>
</div>

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

        <form action="{{ route('budget.post') }}" method="POST">
          {{ csrf_field() }}

            <div class="form-group service-item">
                <label class="col-form-label">Serviços:</label>

                @foreach ($services  as $service)
                    <input type="checkbox" class="check" id={{ $service["id"] }} name="serviceList[]" value="{{ $service["id"] }}">
                    <label for="{{ $service["id"] }}">{{ $service["name"] }}</label>
                @endforeach
            </div>

          <div class="form-group" style="min-width: 230px">
            <label for="description" class="col-form-label" >Anotação:</label>
            <textarea class="form-control" id="description" name="notes" placeholder="Insira uma anotação"></textarea>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Criar orçamento</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>


</div>




<x-footer />
