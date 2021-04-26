<?php
//declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Event\EventInterface;

/**
 * users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    const TOKEN_HOUR_LIVE = (HOUR * 8);

    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->Users->find('all');
        $this->set('users', $users);
        $this->viewBuilder()->setOption('serialize', ['users']);
    }

    public function login()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $privateKey = file_get_contents(CONFIG . '/jwt.key');
            $user = $result->getData();
            $expireTime = time() + self::TOKEN_HOUR_LIVE;
            $payload = [
                'iss' => 'myapp',
                'sub' => $user->id,
                'exp' => $expireTime,
            ];

            $identity = $this->Authentication->getIdentity();

            $json = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
                'user' =>  [
                    'id' => $identity->get('id'),
                    'name' => $identity->get('name'),
                    'email' => $identity->get('email'),
                    'status' => $identity->get('status'),
                    'admin' => $identity->get('admin'),
                ]
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }
        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function logout()
    {
        $this->Authentication->logout();
    }
}
