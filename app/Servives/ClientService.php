<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Illuminate\Contracts\Validation\ValidationException;

/**
 * Description of ClientService
 *
 * @author Jadiel
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
           $this->validator->with($data)->passes0Fail();
           return $this->repository->create($data);
        } catch (ValidationException $e) {
           return [
               'error'=>true,
               'message'=>$e->getMessage()
           ];
        }
    }
    
    public function update(array $data, $id)
    {
        try {
           $this->validator->with($data)->passes0Fail();
           return $this->repository->update($data, $id);
        } catch (ValidationException $e) {
           return [
               'error'=>true,
               'message'=>$e->getMessage()
           ];
        }
    }
}
