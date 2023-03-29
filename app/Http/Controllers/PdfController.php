<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class PdfController extends Controller
{
    public function index($id){
        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.qtd, s.description, s.price, s.creationDate, s.endingDate FROM service s JOIN budget_has_service b ON b.id_service = s.id WHERE b.id_budget = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT DISTINCT c.id, c.firstname, c.lastname, c.address, c.cpf, c.telefone FROM client c JOIN service s ON c.id = s.id_client JOIN budget_has_service b ON b.id_service = s.id WHERE b.id_budget = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $client = $stmt->fetch();
        }
        else{
            $client = [];
        }


        // $pdo = \DB::connection()->getPdo();
        // $stmt = $pdo->prepare("SELECT s.id, s.description, s.price FROM service s JOIN budget_has_service b ON s.id = b.id_service WHERE b.id_budget = 2");
        // $result = $stmt->execute();

        // if($stmt->rowCount() > 0){
        //     $services = $stmt->fetchAll();
        // }
        // else{
        //     $services = [];
        // }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT SUM(s.price) as total FROM service s JOIN budget_has_service b ON s.id = b.id_service WHERE b.id_budget = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $totalPrice = $stmt->fetch();
        }
        else{
            $totalPrice = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT b.notes FROM budget b WHERE b.id = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $notes = $stmt->fetch();
        }
        else{
            $notes = [];
        }


        // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf', ["services"=>$services, "client"=>$client, "totalPrice"=>$totalPrice, "notes"=>$notes, "id"=>$id])->download('Orçamento Nº.' . $id . '.pdf');


        $pdf = PDF::loadView("pdf", ["services"=>$services, "client"=>$client, "totalPrice"=>$totalPrice, "notes"=>$notes, "id"=>$id]);
        $pdf->useSubstitutions = true;
        return $pdf->stream("Orçamento Nº." . "$id" . ".pdf", ["services"=>$services, "client"=>$client, "totalPrice"=>$totalPrice, "notes"=>$notes, "id"=>$id]);
    }
}
