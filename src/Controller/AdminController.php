<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Admin Controller
 */
class AdminController extends AppController
{
    /**
     * carrier method
     *
     * @param string|null $id Carrier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function carrier($id = null)
    {

    }

    /**
     * carriers method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function carriers()
    {

    }

    /**
     * country method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function country($id = null)
    {

    }

    /**
     * countries method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function countries()
    {

    }
    
    /**
     * dashboard
     * 
     * ...
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function dashboard()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 
    }

    /**
     * image method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function image($id = null)
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $ImagesTable = $this->fetchTable("Images");
        $image = $this->Images->get($id, ['contain' => ['Users']]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('image'));
    }

    /**
     * images method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function images()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $ImagesTable = $this->fetchTable("Images");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
            'contain'  => [ 'Users' ],
        ];
        $images = $this->paginate($ImagesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('images'));
    }

    /**
     * logs method
     *
     * @param string|null $type log type (debug,error)
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function logs($type = null)
    {

    }

    /**
     * permission method
     *
     * @param string|null $id Permission id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function permission($id = null)
    {

    }

    /**
     * permissions method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function permissions()
    {

    }

    /**
     * resource method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function resource($id = null)
    {

    }

    /**
     * resources method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resources()
    {

    }

    /**
     * role method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function role($id = null) 
    {

    }

    /**
     * roles method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function roles()
    {

    }

    /**
     * sessions method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function sessions($id = null)
    {

    }

    /**
     * sound method
     *
     * @param string|null $id Sound id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sound($id = null)
    {

    }

    /**
     * sounds method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function sounds()
    {

    }

    /**
     * state method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function state($id = null)
    {

    }

    /**
     * states method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function states()
    {

    }

    /**
     * user method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function user($id = null)
    {

    }

    /**
     * users method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function users()
    {

    }

    /**
     * zone method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function zone($id = null)
    {

    }

    /**
     * zones method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function zones()
    {

    }
}
