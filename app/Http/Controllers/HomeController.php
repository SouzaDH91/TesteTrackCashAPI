<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'titulo' => 'Home',
            'titulo_page' => 'Pedidos',
        ];

        return view('home', $data);
    }

    public function list_orders()
    {
        try
        {
            $curl = curl_init(env('URL_API').'orders');
        
            $headers = array(
            "Content-Type: application/json; charset=utf-8",
            "token: ". env('TOKEN_API')
            );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $response = curl_exec($curl);
            
            if ($response === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }

            curl_close($curl);
            
            $return = json_decode($response, true);
            return $return['data'];

        } 
        catch (\Exception $th) 
        {
            throw $th;
        }
    }

    public function store()
    {
        try 
        {
            $curl = curl_init(env('URL_API').'orders');

            $headers = array(
            "Content-Type: application/json; charset=utf-8",
            "token: ". env('TOKEN_API')
            );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));

            $response = curl_exec($curl);

            if ($response === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }

            curl_close($curl);

            $return = json_decode($response);
        } 
        catch (\Exception $th) 
        {
            throw $th;
        }
    }

    public function get_order(int $id_order)
    {
        try
        {
            $curl = curl_init(env('URL_API').'order/'. $id_order);

            $headers = array(
            "Content-Type: application/json; charset=utf-8",
            "token: ". env('TOKEN_API')
            );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);

            if ($response === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }

            curl_close($curl);

            $return = response()->json($response);
            return $return;
        } 
        catch (\Exception $th) 
        {
            throw $th;
        }
    }
}
