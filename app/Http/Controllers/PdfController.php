<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function index($id){
        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT s.id, s.name, s.status, s.description, s.creationDate, s.endingDate, s.id_client, c.firstname, c.lastname FROM service s JOIN client c ON s.id_client = c.id WHERE s.id = '$id'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
        }
        else{
            $data = [];
        }

        

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf', ["data"=>$data])->stream('pdf');
    }
}
