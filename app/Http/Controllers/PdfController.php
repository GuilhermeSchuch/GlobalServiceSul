<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function index($id){
        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname, c.address, c.cpf, c.telefone FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
        }
        else{
            $data = [];
        }


        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.description, s.price FROM service s JOIN budget_has_service b ON s.id = b.id_service WHERE b.id_budget = 2");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $services = $stmt->fetchAll();
        }
        else{
            $services = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT SUM(s.price) as total FROM service s JOIN budget_has_service b ON s.id = b.id_service WHERE b.id_budget = 2");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $totalPrice = $stmt->fetch();
        }
        else{
            $totalPrice = [];
        }

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT b.notes FROM budget b WHERE b.id = 2");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $notes = $stmt->fetch();
        }
        else{
            $notes = [];
        }

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf', ["data"=>$data, "services"=>$services, "totalPrice"=>$totalPrice, "notes"=>$notes])->stream('pdf.pdf');
    }
}
