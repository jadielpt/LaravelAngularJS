<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Description of ClientService
 *
 * @author Jadiel Cordeiro Filho
 */
class ClientService {
    
    protected $repository;
    /**
     * 
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    
    public function __construct(ClientRepository $repository,ClientValidator $validator)
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
               'message'=> 'Erro ao cadastrar o cliente, aluns campos são necessários'
               
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
               'message'=>'Erro ao atualizar Cliente'
           ];
        }
    }
}
