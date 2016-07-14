<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProjectController extends Controller
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
    
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
      $this->repository = $repository; 
      $this->service = $service;
    }
    
    /**
     * 
     * @return Response
     */
    
    public function index()
            
    {
      
            return $this->repository->all();
        
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
            return ['error'=>true, 'Projecto não encontrado']; 
        }
         catch(\Exception $e){
         return ['error'=> 'Ocorreu um erro ao exibir o Projeto'];        
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
              'message'=> 'Erro ao cadastrar o projeto, aluns campos são necessários',
              
          ];
        }
        catch(\Exception $e){
            return ['error'=> 'Ocorreu um erro ao cadastrar o Projeto.'];
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
                'message'=>"Projeto deletado com sucesso"
            ];
        } catch (QueryException $e) {
            return $this->errorBag('Projeto não pode ser apagado pois existe um ou mais projetos vinculados a ele.');
        }
    }
    
       public function update(Request $request, $id)
         {
          
              return $this->service->update($request->all(), $id);
          
         }
       
}
