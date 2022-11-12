<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\AccountActivationForm;
use App\Form\AccountAddDeviceForm;
use App\Form\AccountChangePasswordForm;
use App\Form\AccountLoginForm;
use App\Form\AccountPreferencesForm;
use App\Form\AccountProfileForm;
use App\Form\AccountRegistrationForm;
use App\Form\AccountResetPasswordForm;
use App\Form\AccountResetPasswordRequestForm;

/**
 * Account Controller
 */
class AccountController extends AppController
{
    /**
     * activate
     * 
     * When a visitor registers a new account, a secret, time-sensitive code is generated 
     * and embedded into the new user record. The same code is sent via email to the 
     * address provided by the visitor during registration. If the visitor receives that 
     * secret code and brings it to this endpoint within an hour of registration, then the
     * new user account is activated and the visitor is redirected to the login page to 
     * log in for the first time.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function activate()
    {
        $session = $this->request->getSession();
        
        if ($session->check('Auth.User'))
        {
            return $this->redirect(['action' => 'home']);
        }
        
        $form = new AccountActivationForm();
        
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            if ($form->execute($this->request->getData()))
            {
                $this->Flash->success(__('Activation successful! You may now log in.'));
                return $this->redirect(['action' => 'login']);
            } 
            else 
            {
                $session->destroy();
                $this->Flash->error(__('Account activation failed. Check the form for more details.'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * changepwd
     * 
     * This endpoint is only accessible to logged-in users. Even so, the user must first
     * provide their current password in order to change it.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function changepwd()
    {
        $session = $this->request->getSession();
        
        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to change your password.'));
            return $this->redirect(['action' => 'login']);
        }
        
        $form = new AccountChangePasswordForm();

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $data = $this->request->getData();
            $data['user_id'] = $session->read('Auth.User')->id;
            
            if ($form->execute($data))
            {
                $this->Flash->success(__('Your password was successfully changed.'));               
                return $this->redirect(['action' => 'home']);
            } 
            else 
            {
                $this->Flash->error(__('An error occurred. Check the form for more details.'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * devices
     * 
     * GET requests return the logged-in user's devices, if any. A form is also provided 
     * so that the user may add a new device. Beside each device listed, there is a control
     * allowing the user to delete the associated device from the db. Because mobile device
     * numbers are very sensitive data, libsodium is used to perform symmetric encryption 
     * on the data so that if the db is compromised, the device data will be unusable to 
     * the hacker. The user's private encryption key is stored on the filesystem, and it is 
     * used to encrypt the data and then to decrypt the data, when needed.
     *
     * @param string|int|null $id
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function devices($id = null)
    {
        $session = $this->request->getSession();

        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to access your account home page.'));
            return $this->redirect(['action' => 'login']);
        }

        $device = $id ? $this->fetchTable('Devices')->get($id) : null;
        $form = new AccountAddDeviceForm();

        if ($this->request->is(['patch', 'post', 'put', 'delete']))
        {
            if ($device) 
            {
                if ($this->fetchTable('Devices')->delete($device))
                {
                    return $this->redirect(['action' => 'devices']);
                }

                $this->Flash->error(__('The device was not deleted! Please, try again.'));
            }
            else 
            {
                $data = $this->request->getData();
                $data['user_id'] = $session->read('Auth.User')->id;
                $carrier = is_numeric($data['gateway']) ? $this->fetchTable('Carriers')->get($data['gateway']) : null;
                $data['gateway'] = $carrier && $data['number'] ? str_replace("number", $data['number'], $carrier->gateway) : null;
                
                if ($form->execute($data))
                {
                    return $this->redirect(['action' => 'devices']);
                } 
                
                $this->Flash->error(__('The device was not added! Please, try again.'));
            }
        }

        $devices = [];
        $items = $this->fetchTable('Devices')->find()->where([
            'user_id' => $session->read('Auth.User')->id
        ]);

        foreach ($items as $idx => $item)
        {
            $secretKey = $this->fetchTable('Users')->getUserKey($session->read('Auth.User')->id);
            $ciphertext = sodium_base642bin($item->data, SODIUM_BASE64_VARIANT_ORIGINAL);
            $nonce = mb_substr($ciphertext, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
            $ciphertext = mb_substr($ciphertext, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
            $json = sodium_crypto_secretbox_open($ciphertext, $nonce, $secretKey);

            if ($json === false)
            {
                $this->Flash->error(__('The encrypted device data was corrupted.'));
            }

            sodium_memzero($nonce);
            sodium_memzero($secretKey);
            sodium_memzero($ciphertext);

            $obj = json_decode($json);
            $obj->id = $item->id;
            $obj->created = $item->created;
            $obj->modified = $item->modified;
            $devices[] = $obj;
        }

        $carriers = $this->fetchTable('Carriers')->find('list')->toArray();
        $this->set(compact('form', 'devices', 'carriers'));
    }

    /**
     * home
     * 
     * Landing page for newly logged-in users.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function home()
    {
        $session = $this->request->getSession();

        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to access your account home page.'));
            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * index
     * 
     * Sitewide landing page for logged-in users
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $session = $this->request->getSession();

        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to access the members\' home page.'));
            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * login
     * 
     * Login form for registered users
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        $session = $this->request->getSession();

        if ($session->check('Auth.User'))
        {
            return $this->redirect(['action' => 'home']);
        }
        
        $form = new AccountLoginForm();
        
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            if ($form->execute($this->request->getData()))
            {
                $session->write('Auth.User', $form->getAuthenticatedUser());                
                return $this->redirect(['action' => 'home']);
            } 
            else 
            {
                $session->destroy();
                $this->Flash->error(__('Login failed. Check the form for more details.'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * logout
     * 
     * Destroys current session data and redirects user to the public home page.
     * 
     * @return \Cake\Http\Response
     */
    public function logout() 
    {
        $this->request->allowMethod(['get']);
        $session = $this->request->getSession();
        $session->destroy();
        return $this->redirect('/');
    }

    /**
     * preferences
     * 
     * Presents a form to logged-in users, allowing them to change the website visual theme as
     * well as their own timezone. Datetime values are stored in UTC format in the db, so all 
     * users can tweak the website's display rules so that those values are displayed in terms
     * of their own, preferred timezone.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function preferences()
    {
        $session = $this->request->getSession();

        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to access your account preferences.'));
            return $this->redirect(['action' => 'login']);
        }
        
        $form = new AccountPreferencesForm();

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $data = $this->request->getData();
            $authUser = $session->read('Auth.User');
            $data['user_id'] = $authUser->id;
            
            if ($form->execute($data))
            {
                $authUser->preference->theme = $data['theme'];
                $authUser->preference->timezone = $data['timezone'];
                $session->write('Auth.User', $authUser);
                return $this->redirect($this->referer());
            } 
            else 
            {
                $this->Flash->error(__('Preferences were not saved!'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * profile
     * 
     * The sparkly name plate that registered users present to one another is stored as profile 
     * data, and it includes an image avatar (GIF, JPEG, or PNG), a full name, a brief introduction 
     * field and a personal manifesto field (varchar(255) and text, respectively). When a user 
     * uploads a new avatar, the existing avatar is deleted from the db and filesystem.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function profile()
    {
        $session = $this->request->getSession();

        if (!$session->check('Auth.User'))
        {
            $this->Flash->error(__('You must be logged in to access your account preferences.'));
            return $this->redirect(['action' => 'login']);
        }
        
        $form = new AccountProfileForm();

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $data = $this->request->getData();
            $authUser = $session->read('Auth.User');
            $data['user_id'] = $authUser->id;
            
            if ($form->execute($data))
            {
                $authUser->profile = $form->getProfile();
                $session->write('Auth.User', $authUser);
                return $this->redirect($this->referer());
            } 
            else 
            {
                $this->Flash->error(__('The profile was not saved!'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * register
     * 
     * This public endpoint allows visitors to self-register an account with the application, 
     * but they will be unable to log in to the application until they have activated it, 
     * which they must do within one hour of registering the new account. Activation means 
     * that a secret code is generated and then sent to the email address provided by the 
     * user during registration. 
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function register()
    {
        $this->request->allowMethod(['get', 'post']);
        $session = $this->request->getSession();
        $form = new AccountRegistrationForm();

        if ($session->check('Auth.User'))
        {
            return $this->redirect(['action' => 'home']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            if ($form->execute($this->request->getData()))
            {
                $this->Flash->success(__('Registration successful! Now check your email inbox for your account activation code.'));
                return $this->redirect(['action' => 'activate']);
            } 
            else 
            {
                $this->Flash->error(__('One or more errors were encountered. Please check the form for more specific information.'));
            }
        }

        $this->set('form', $form);
    }

    /**
     * resetpwd
     * 
     * If a user has decided that they want to reset their password, then they will visit this
     * endpoint with their email address and the confirmation code. A new password will be 
     * generated and sent to them via email, and they will be redirected to the login page.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resetpwd()
    {
        $this->request->allowMethod(['get', 'post']);
        $session = $this->request->getSession();
        $form = new AccountResetPasswordForm();

        if ($session->check('Auth.User'))
        {
            return $this->redirect(['action' => 'changepwd']);
        } 

        if ($this->request->is('post')) 
        {
            if ($form->execute($this->request->getData()))
            {
                $this->Flash->success(__('Check your email inbox for the newly-generated password.'));
                return $this->redirect(['action' => 'login']);
            } 
            else 
            {
                $errors = $form->getErrors();
                $this->Flash->error($errors['identity']);
                return $this->redirect(['action' => 'resetpwdreq']);
            }
        }

        $this->set('form', $form);
    }

    /**
     * resetpwdreq
     * 
     * When a registered user with an activated account forgets their password, this is the 
     * endpoint they must visit to begin the password reset process. Sometimes, a user will not
     * only forget their password but also forget their username or which email they used to 
     * register the account. The visitor is presented with an input box into which they may 
     * enter either their username or email address. If a match to either is found in the db, a
     * secret code is generated and then an email is sent to the email associated with the
     * matching account. The user is advised that they, or someone pretending to be them, is 
     * trying to reset their password. If they don't want to reset the password, then they 
     * don't have to do anything and it will not be changed.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resetpwdreq()
    {
        $session = $this->request->getSession();
        $form = new AccountResetPasswordRequestForm();

        if ($session->check('Auth.User'))
        {
            return $this->redirect(['action' => 'changepwd']);
        } 

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            if ($form->execute($this->request->getData()))
            {
                $this->Flash->success(__('Check your email inbox for a confirmation code.'));
                return $this->redirect(['action' => 'resetpwd']);
            } 
            else 
            {
                $this->Flash->error(__('No matching username or email address was found.'));
            }
        }

        $this->set('form', $form);
    }
}
