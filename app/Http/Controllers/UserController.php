<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function index(){
        return view("login");
    }

    public function login(Request $request){
        $data = $request;
    
        $email = $data["login_email"];
        $password = $data["login_password"];

        $userData = [];
        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user.email = '$email'");
        $result = $stmt->execute();

        if($stmt->rowCount() > 0){
            $userData[] = $stmt->fetch();
        }

        if($email === $userData[0]["email"]){
            if(password_verify($password, $userData[0]["password"])){

                \Session::put('user', [
                    'name' => $userData[0]["firstname"],
                    'lastname' => $userData[0]["lastname"],
                    'email' => $userData[0]["email"],
                    'password' => $userData[0]["password"],
                    'token' => $userData[0]["token"]
                ]);

                return redirect()->route('home');
            }
            else{
                return redirect('auth')->with("error", "E-mail e senha não correspondem!");
            }
        }
        else{
            return redirect('auth')->with("error", "E-mail e senha não correspondem!");
        }
        
    }

    public function register(Request $request){
        $data = $request;

        $name = $data["name"];
        $lastname = $data["lastname"];
        $email = $data["email"];
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $token = csrf_token();

        \Session::put('user', [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'token' => $token
        ]);

        $pdo = \DB::connection()->getPdo();
        $stmt = $pdo->prepare("INSERT INTO user (firstname, lastname, email, password, token) VALUES ('$name', '$lastname', '$email', '$password', '$token')");
        $result = $stmt->execute();

        return redirect()->route('home');
    }

    public function logout(){
        \Session::flush();

        return redirect()->route('auth');
    }
}
