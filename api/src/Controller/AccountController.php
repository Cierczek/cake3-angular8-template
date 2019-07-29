<?php

namespace App\Controller;

use Cake\I18n\Date;
use RestApi\Controller\ApiController;
use RestApi\Utility\JwtToken;
use App\Controller\AppController;

class AccountController extends ApiController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }

    public function addUser()
    {
        $response = ['message' => __('Request must be post'), 'status' => 'failed'];

        if ($this->request->is('post')) {

            $user = $this->Users->newEntity($this->getRequest()->getData());
            $user->birth = new Date($user->birth);

            if ($this->Users->save($user)) {
                $payload = ['email' => $user->email, 'name' => $user->name];
                $response = ['message' => __('The user has been saved.'), 'token' => JwtToken::generateToken($payload), 'status' => 'success'];
            } else {
                $errorMsg = AppController::getErrorsMessages($user);
                $response = ['message' => $errorMsg, 'status' => 'failed'];
            }
        }

        $this->apiResponse = $response;
    }

    public function login()
    {
        $response = ['message' => __('Request must be post'), 'status' => 'failed'];

        if ($this->request->is('post')) {

            $entity = $this->Users->newEntity($this->getRequest()->getData());
            $user = $this->Users->find()
                ->where([
                    'username' => $entity->username,
                    'password' => md5($entity->password)
                ])
                ->first();
            
            if (empty($user)) {
                $response = ['message' => 'Invalid username or password.', 'status' => 'failed'];
            } else {
                $payload = ['email' => $user->email, 'name' => $user->name];
                $response = ['message' => __('Logged in successfully.'), 'token' => JwtToken::generateToken($payload), 'data' => $user, 'status' => 'success'];
            }


        }
        $this->apiResponse = $response;
    }
}