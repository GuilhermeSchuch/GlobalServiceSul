<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request){
        if(!\Session::get('user')){
            return redirect('auth')->with("error", "Você precisa estar logado!");
        }

        $navbar = "service";
        $bootstrap = "true";

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT client.firstname, client.lastname, client.id FROM client");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $clients = $stmt->fetchAll();
        }
        else{
            $clients = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT DISTINCT * FROM budget_has_service");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $budget = $stmt->fetchAll();
        }
        else{
            $budget = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM service_status");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $status = $stmt->fetchAll();
        }
        else{
            $status = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.price, s.qtd, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id ORDER BY s.creationDate");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        $query = $request["query"] ?? '';

        if($query != ''){
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description,  s.price, s.qtd, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = '$query'");
            $result = $stmt->execute();

            if($stmt->rowCount() > 0){
                $services = $stmt->fetchAll();
            }
            else{
                $services = [];
            }
        }

        return view("service", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "services"=>$services, "clients"=>$clients, "status"=>$status, "budget"=>$budget]);
    }

    public function showPending(){
        $navbar = "service";
        $bootstrap = "true";

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT client.firstname, client.lastname, client.id FROM client");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $clients = $stmt->fetchAll();
        }
        else{
            $clients = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM service_status");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $status = $stmt->fetchAll();
        }
        else{
            $status = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description,  s.price, s.qtd, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.status = '1' ORDER BY s.creationDate");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        $query = $request["query"] ?? '';

        if($query != ''){
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.price, s.qtd, s.description, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = '$query'");
            $result = $stmt->execute();

            if($stmt->rowCount() > 0){
                $services = $stmt->fetchAll();
            }
            else{
                $services = [];
            }
        }

        return view("service", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "services"=>$services, "clients"=>$clients, "status"=>$status]);
    }

    public function showDone(){
        $navbar = "service";
        $bootstrap = "true";

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT client.firstname, client.lastname, client.id FROM client");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $clients = $stmt->fetchAll();
        }
        else{
            $clients = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM service_status");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $status = $stmt->fetchAll();
        }
        else{
            $status = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.price, s.qtd, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.status = '2' ORDER BY s.creationDate");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        $query = $request["query"] ?? '';

        if($query != ''){
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.price, s.qtd, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = '$query'");
            $result = $stmt->execute();

            if($stmt->rowCount() > 0){
                $services = $stmt->fetchAll();
            }
            else{
                $services = [];
            }
        }

        return view("service", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "services"=>$services, "clients"=>$clients, "status"=>$status]);
    }


    public function destroy($id){
        try{
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("DELETE FROM client_has_service WHERE client_has_service.id_service = '$id'");
            $result = $stmt->execute();

            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("DELETE FROM service WHERE service.id = '$id'");
            $result = $stmt->execute();

            return redirect('service');
        }
        catch(\Throwable $th){
            return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");
        }
    }

    public function store(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $qtd = $request->input('qtd');
        $creationDate = $request->input('creationDate');
        $endingDate = date('Y') . '/01/01';
        $client = $request->input('client');

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO service (name, description, price, qtd, creationDate, endingDate, id_client) VALUES ('$name', '$description', '$price', '$qtd', '$creationDate', '$endingDate', '$client')");
        $result = $stmt->execute();

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO client_has_service (id_service, id_client) VALUES ((SELECT s.id FROM service s ORDER BY s.id DESC LIMIT 1), '$client')");
        $result = $stmt->execute();


        return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }

    public function update(Request $request, $id){
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $qtd = $request->input('qtd');
        // $endingDate = $request->input('endingDate');
        $endingDate = date('Y') . '/01/01';
        $status = $request->input('status');

        if($status == 2){
            // $endingDate = date("d/m/Y");
            $endingDate = date("Y/m/d");
        }

        $client = $request->input('client');

        $pdo = \DB::connection()->getPdo();

        $stmt = $pdo->prepare("UPDATE `service` SET
        `name` = '$name',
        `description` = '$description',
        `price` = '$price',
        `qtd` = '$qtd',
        `endingDate` = '$endingDate',
        `status` = '$status',
        `id_client` = '$client'
        WHERE `service`.`id` = '$id'");

        $result = $stmt->execute();

        return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }
}
