<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(){
        $navbar = "budget";
        $bootstrap = "true";

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT client.firstname, client.lastname, client.id FROM client");
        $result = $stmt->execute();

        $qclient = url()->full();

        if(strpos($qclient, "?client=") !== false){
            $qclient = explode("?client=", $qclient);
            $qclient = $qclient[1];
        }

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
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE c.id = '$qclient' ORDER BY s.creationDate");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        return view("budget", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "clients"=>$clients, "qclient"=>$qclient, "services"=>$services]);
    }

    public function store(Request $request){
        $serviceList[] = $request->input('serviceList');
        $notes = $request->input('notes');


        $navbar = "budget";
        $bootstrap = "true";

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO budget (notes) VALUES ('$notes')");
        $result = $stmt->execute();

        $list = $serviceList[0];

        for($i = 0; $i < count($list); $i++){
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("INSERT INTO budget_has_service (id_budget, id_service) VALUES ((SELECT b.id FROM budget b ORDER BY b.id DESC LIMIT 1), (SELECT s.id FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = $list[$i]))");
            $result = $stmt->execute();
        }

        return view("home", ["navbar"=>$navbar, "bootstrap"=>$bootstrap, "list"=>$list]);
    }

    public function destroy($id){
        try{
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("DELETE FROM budget_has_service WHERE budget_has_service.id_budget = '$id'");
            $result = $stmt->execute();

            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("DELETE FROM budget WHERE budget.id = '$id'");
            $result = $stmt->execute();

            return redirect('service');

        }
        catch(\Throwable $th){
            return redirect('service')->with("error", "Impossível deletar borda relacionada à um pedido!");

        }
    }
}
