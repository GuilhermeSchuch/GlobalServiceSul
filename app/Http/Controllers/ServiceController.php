<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
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
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.description, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }
        

        return view("service", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "services"=>$services, "clients"=>$clients]);
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
        $creationDate = $request->input('creationDate');
        $endingDate = date('Y') . '/01/01';
        $client = $request->input('client');

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO service (name, description, creationDate, endingDate, id_client) VALUES ('$name', '$description', '$creationDate', '$endingDate', '$client')");
        $result = $stmt->execute();

        return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }

    public function update(Request $request, $id){
        $name = $request->input('name');
        $description = $request->input('description');
        $endingDate = $request->input('endingDate');
        $client = $request->input('client');

        $pdo = \DB::connection()->getPdo();

        $stmt = $pdo->prepare("UPDATE `service` SET 
        `name` = '$name', 
        `description` = '$description', 
        `endingDate` = '$endingDate', 
        `id_client` = '$client' 
        WHERE `service`.`id` = '$id'");

        $result = $stmt->execute();

        return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }
}
