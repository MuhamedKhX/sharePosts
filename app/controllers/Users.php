<?php

class Users extends Controller
{
    /**
     * @var mixed
     */
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //SANITIZE
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //process form
            $data_err = [
                'email_err' => '',
                'name_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load form
            $data = [
                'email' => trim($_POST['email']),
                'name' => trim($_POST['name']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'data_err' => $data_err
            ];

            //Validate email
            if(empty($data['email']))
            {
                $data_err['email_err'] = 'Please enter email';
            } else if ($this->userModel->findUserByEmail($data['email']))
            {
                $data_err['email_err'] = 'email already taken';
            }

            //Validate name
            if(empty($data['name']))
            {
                $data_err['name_err'] = 'Please enter name';
            }

            //Validate password
            if(empty($data['password']))
            {
                $data_err['password_err'] = 'Please enter password';
            } else if(strlen($data['password'] < 6))
            {
                $data_err['password_err'] = 'Password must at least 6 characters';
            }

            if(empty($data['confirm_password']))
            {
                $data_err['confirm_password_err'] = 'Please confirm password';
            } else if($data['password'] != $data['confirm_password'])
            {
                $data_err['password_err'] = 'Password not match';
            }

            //set data errors in data
            $data['data_err'] = $data_err;
            //make sure there is no error

            if(empty($data_err['name_err']) && empty($data_err['email_err']) && empty($data_err['password_err']) && empty($data_err['confirm_password_err']))
            {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data))
                {
                    flash('register success', 'You are Singed up you can sing in now');
                    redirect('users/login');
                }
                else
                {
                    die("something went wrong");
                }
            }
            else
            {
                $this->view('users/register', $data);
            }
        }
        else
        {

            $data_err = [
                'email_err' => '',
                'name_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load form
            $data = [
                'email' => null,
                'name' => '',
                'password' => null,
                'confirm_password' => null,
                'data_err' => $data_err
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //process form
            $data_err = [
                'email_err' => '',
                'password_err' => '',
            ];

            //Load form
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'data_err' => $data_err
            ];

            if(empty($data['email']))
            {
                $data_err['email_err'] = 'Please enter Email';
            }

            //Validate password
            if(empty($data['password']))
            {
                $data_err['password_err'] = 'Please enter password';
            }

            if($this->userModel->findUserByEmail($data['email']))
            {
                //user found
            } else
            {
                $data_err['email_err'] = 'email no found';
            }

            $data['data_err'] = $data_err;

            if(empty($data_err['email_err']) && empty($data_err['password_err']))
            {
                $signedInUser = $this->userModel->login($data['email'], $data['password']);
                if($signedInUser)
                {
                    $this->createUserSession($signedInUser);
                } else
                {
                    $data_err['password_err'] = 'password incorrect';
                    $data['data_err'] = $data_err;
                    $this->view('users/login', $data);
                }
            }
            else
            {
                $this->view('users/login', $data);
            }
        }
        else
        {

            $data_err = [
                'email_err' => '',
                'password_err' => '',
            ];

            //Load form
            $data = [
                'email' => null,
                'password' => null,
                'data_err' => $data_err
            ];

            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        redirect('/pages/Home');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('/users/login');
    }





}
