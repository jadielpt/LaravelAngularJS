<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ClientRepository;




class ClientController extends Controller
{
    /**
     *
     * @var ClientRepository
     */
    private $repository;
    
    public function __construct(ClientRepository $repository)
    {
      $this->repository = $repository;  
    }
    
    public function index()
            
    {
        return $this->repository->all();
    } 
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        return $this->repository->create($request->all());
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
