<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsersController extends Controller
{
    protected $client;

   	public function __construct(Client $client)
  	{
        $this->client = new Client();
   	}

    public function index()
    {
        $apiResponse = $this->client->get(USER_LIST_ENDPOINT);
    		if ($apiResponse->getStatusCode() == 200) { 
  	        $responseData = $apiResponse->getBody()->getContents();
  	        $response = json_decode($responseData);
  	    }
  	    $users = $response->data ?? [];   

        return view('backend.pages.users')->with('users', $users);
    }    
}
