<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProjectNoteController extends Controller
{
    /**
     *
     * @var ClientRepository
     */
    private $repository;
    
    
    /**
     *
     * @var ClientService
     */
    private $service;
    
    /**
     * 
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
      $this->repository = $repository; 
      $this->service = $service;
    }
    
    /**
     * 
     * @return Response
     */
    
    public function index($id)
            
    {
      
            return $this->repository->findWhere(['project_id'=>$id]);
        
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
            return $this->errorBag('Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.');
        }
    }
    
       public function update(Request $request, $id)
         {
          
              return $this->service->update($request->all(), $id);
          
         }
       
}
