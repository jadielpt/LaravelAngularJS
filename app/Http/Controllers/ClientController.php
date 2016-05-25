<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Entities\Client;

use Illuminate\Http\Request;

use CodeProject\Http\Requests;

use CodeProject\Repositories\ClientRepositoryEloquent;

use CodeProject\Repositories\ClientRepository;



class ClientController extends Controller
{
    public function index(ClientRepository $repository)
            
    {
        return $repository->all();
    } 
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        return Client::create($request->all());
    } 
    /**
     * 
     * @param int $id
     * @return response
     */
    public function show($id)
    {
        return Client::find($id);
    }
    
    
    public function destroy($id)
    {
        Client::find($id)->delete();
    }
}
