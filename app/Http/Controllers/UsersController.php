<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsersController extends Controller
{
    /*protected $client;

   	public function __construct(Client $client)
  	{
        $this->client = $client;
        dd($this->client);
   	}*/

    public function index()
    {
    	/*$client = new Client();
		$client = $client->request('GET', 'https://gitlab.iterato.lt/snippets/3/raw');;
dd($client);*/
		//$client = new Client();

		$client = new Client();
		$res = $client->get('https://gitlab.iterato.lt/snippets/3/raw');
		//echo $res->getStatusCode(); // 200

		if ($res->getStatusCode() == 200) { // 200 OK
	        $response_data = $res->getBody()->getContents();
	    }
	   /*$data = json_decode($response_data);
		foreach ($response_data as $key => $value) {
			//dd($data , $value);
			foreach ($value as $key => $value1) {
				dd($value1->email);
			}
		}*/

    	return view('backend.pages.users')->with('response_data', json_decode($response_data));
    }

    public function userList()
    {
    	$client = new Client();
		$res = $client->get('https://gitlab.iterato.lt/snippets/3/raw');
		//echo $res->getStatusCode(); // 200

		if ($res->getStatusCode() == 200) { // 200 OK
	        $response_data = $res->getBody()->getContents();
	    }
	    return $response_data;
		/*return response()->json([
			'status' => $res->getStatusCode(),
			'data' => $response_data
		]); 
		dd($data);*/
    }
}
