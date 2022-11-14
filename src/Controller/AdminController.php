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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $CarriersTable = $this->fetchTable("Carriers");
        $carrier = $CarriersTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('carrier'));
    }

    /**
     * carriers method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function carriers()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $CarriersTable = $this->fetchTable("Carriers");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $carriers = $this->paginate($CarriersTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('carriers'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $CountriesTable = $this->fetchTable("Countries");
        $country = $CountriesTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('country'));
    }

    /**
     * countries method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function countries()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $CountriesTable = $this->fetchTable("Countries");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $countries = $this->paginate($CountriesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('countries'));
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
     * @param string|null $type log type (activity,debug,error)
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function logs($type = null)
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $PermissionsTable = $this->fetchTable("ResourcesRoles");
        $permission = $PermissionsTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('permission'));
    }

    /**
     * permissions method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function permissions()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $PermissionsTable = $this->fetchTable("ResourcesRoles");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $permissions = $this->paginate($PermissionsTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('permissions'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $ResourcesTable = $this->fetchTable("Resources");
        $resource = $ResourcesTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('resource'));
    }

    /**
     * resources method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resources()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $ResourcesTable = $this->fetchTable("Resources");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $resources = $this->paginate($ResourcesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('resources'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $RolesTable = $this->fetchTable("Roles");
        $role = $RolesTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('role'));
    }

    /**
     * roles method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function roles()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $RolesTable = $this->fetchTable("Roles");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $roles = $this->paginate($RolesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('roles'));
    }

    /**
     * sessions method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function sessions($id = null)
    {
        $_session = $this->request->getSession();
        
        if (!$_session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $SessionsTable = $this->fetchTable("Sessions");
        $session = $id ? $SessionsTable->find()->where(['id' => $id])->first() : null;
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $sessions = $this->paginate($SessionsTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('sessions', 'session'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $SoundsTable = $this->fetchTable("Sounds");
        $sound = $SoundsTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('sound'));
    }

    /**
     * sounds method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function sounds()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $SoundsTable = $this->fetchTable("Sounds");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $sounds = $this->paginate($SoundsTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('sounds'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $StatesTable = $this->fetchTable("States");
        $state = $StatesTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('state'));
    }

    /**
     * states method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function states()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }

        $StatesTable = $this->fetchTable("States");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $states = $this->paginate($StatesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('states'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $UsersTable = $this->fetchTable("Users");
        $user = $UsersTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('user'));
    }

    /**
     * users method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function users()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $UsersTable = $this->fetchTable("Users");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $users = $this->paginate($UsersTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('users'));
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
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $ZonesTable = $this->fetchTable("Zones");
        $zone = $ZonesTable->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        }

        $this->set(compact('zone'));
    }

    /**
     * zones method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function zones()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
        
        $ZonesTable = $this->fetchTable("Zones");
        $this->paginate = [
            'maxLimit' => 512,
            'limit'    => 32,
        ];
        $zones = $this->paginate($ZonesTable);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            
        } 

        $this->set(compact('zones'));
    }
}
