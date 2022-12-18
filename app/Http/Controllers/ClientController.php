<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientModel;

class ClientController extends Controller
{
    public function index(){
        if(!\Session::get('user')){
            return redirect('auth')->with("error", "Você precisa estar logado!");
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM client");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $clients = $stmt->fetchAll();
        }

        $navbar = "client";
        $bootstrap = "true";

        return view('client', ["navbar"=>$navbar, "clients"=>$clients, "bootstrap"=>$bootstrap]);
    }

    public function destroy($id){
        try{
            $pdo = \DB::connection()->getPdo();
            $stmt = $pdo->prepare("DELETE FROM client WHERE client.id = '$id'");
            $result = $stmt->execute();

            return redirect('client');
        }
        catch(\Throwable $th){
            return redirect('client')->with("error", "Impossível deletar borda relacionada à um pedido!");
        }
    }

    public function update(Request $request, $id){
        // $data = $request->input();

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $cpf = $request->input('cpf');
        $address = $request->input('address');
        $telefone = $request->input('telefone');

        $pdo = \DB::connection()->getPdo();

        $stmt = $pdo->prepare("UPDATE `client` SET 
        `firstname` = '$firstname', 
        `lastname` = '$lastname', 
        `cpf` = '$cpf', 
        `address` = '$address', 
        `telefone` = '$telefone' 
        WHERE `client`.`id` = '$id'");

        $result = $stmt->execute();

        return redirect('client')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }

    public function store(Request $request){
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $cpf = $request->input('cpf');
        $address = $request->input('address');
        $telefone = $request->input('telefone');

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO client (firstname, lastname, cpf, address, telefone) VALUES ('$firstname', '$lastname', '$cpf', '$address', '$telefone')");
        $result = $stmt->execute();

        return redirect('client')->with("error", "Impossível deletar borda relacionada à um pedido!");
    }
}
