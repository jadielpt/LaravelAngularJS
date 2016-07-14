<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * Description of ClientService
 *
 * @author Jadiel Cordeiro Filho
 */
class ProjectService {
    
    protected $repository;
    /**
     * 
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    
    public function __construct(ProjectRepository $repository,ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function create(array $data)
    {
        try {
           $this->validator->with($data)->passesOrFail();
           return $this->repository->create($data);
        } catch (ValidatorException $e) {
           return [
               'error'=>true,
               'message'=> 'Erro ao cadastrar o projeto, aluns campos são necessários'
               
           ];
        }
    }
    
    public function update(array $data, $id)
    {
        try {
           $this->validator->with($data)->passesOrFail();
           return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
           return [
               'error'=>true,
               'message'=>'Erro ao atualizar Projeto'
           ];
        }
    }
}
