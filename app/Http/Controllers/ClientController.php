<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    /**
     *
     * @var ClientRepository
     */
    private $repository;
    
    public function __construct(ClientRepository $repository, ClientService $service)
    {
      $this->repository = $repository; 
      $this->service = $service;
    }
    
    public function index()
            
    {
        try{
            return $this->repository->all();
        } catch (\Exception $e) {
             return ['error'=> 'Ocorreu um erro ao listar os clientes.'];
        }
    } 
    /**
     * 
     * @param int $id
     * @return \Illuminate\Http\Request;
     */
    public function show($id){
        try{
            return $this->repository->find($id);
        } catch (QueryException $e) {
            return ['error'=>true, 'Cliente não encontrado']; 
        }
         catch(\Exception $e){
         return ['error'=> 'Ocorreu um erro ao exibir o cliente'];        
        }
    }
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        try {
             return $this->service->create($request->all());
        } catch (QueryException $e) {
            
          return [
              'error'=>true,
              'message'=> 'Erro ao cadastrar o cliente, aluns campos são necessários',
              'messages'=> $error->getMessages(),
          ];
        }
        catch(\Exception $e){
            return ['error'=> 'Ocorreu um erro ao cadastrar o cliente.'];
        }
    } 
    
    /**
     * 
     * @param type $id
     */
    
    
    public function destroy($id)
    {
        try {
           $this->repository->find($id)->delete(); 
            return [
                'success'=>true,
                'message'=>"Cliente deletado com sucesso"
            ];
        } catch (QueryException $e) {
            return $this->errorBag('Cliente não pode ser apagado pois existe um ou mais projetos cinculados a ele.');
        }
    }
    
   
}
