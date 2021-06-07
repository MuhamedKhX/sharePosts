<?php


class Posts extends Controller
{
    private $postModel;
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }
    public function add()
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Sentazie _Post

            $data_err = [
                'title_err' => '',
                'description_err' => ''
            ];

            $data = [
              'title' => trim($_POST['title']),
              'description' => trim($_POST['description']),
              'user_id' => $_SESSION['user_id'],
              'data_err' => $data_err

            ];

            if(empty($data['title']))
            {
                $data_err['title_err'] = 'Please fill title field';
            }

            if(empty($data['description']))
            {
                $data_err['description_err'] = 'Please fill description field';
            }

            $data['data_err'] = $data_err;

            if(empty($data_err['title_err']) && empty($data_err['description_err']))
            {
                if($this->postModel->createPost($data))
                {
                    flash('post_msg', 'post successfully created');
                    redirect('/posts');
                }
            }
            else
            {
                //Load view with errors
                $this->view('posts/add', $data);
            }
        }
        else
        {

            $data_err = [
                'title_err' => '',
                'description_err' => ''
            ];

            $data = [
                'title' => '',
                'description' => '',
                'data_err' => $data_err
            ];

            $this->view('posts/add', $data);
        }

    }
    public function show($id = '')
    {

        $post = $this->postModel->getPostById($id);
        $data = [
            'post' => $post,
            'id' => $id
        ];

        $this->view('posts/show', $data);
    }

    public function edit($id)
    {
        $post = $this->postModel->getPostById($id);

        $data_err = [
            'title_err' => '',
            'description_err' => ''
        ];

        $data = [
            'title' => $post->title,
            'description' => $post->body,
            'data_err' => $data_err,
            'id' => $post->id
        ];

        //Check if this post for the owner
        if($post->user_id == $_SESSION['user_id'])
        {
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $data = [
                    'title' => $_POST['title'],
                    'description' =>  $_POST['description'],
                    'id' => $post->id,
                    'data_err' => $data_err

                ];

                //validate


                if(empty($data['title']))
                    $data_err['title_err'] = 'Please fill the title field';

                if(empty($data['description']))
                    $data_err['description_err'] = 'Please fill the description field';


                $data['data_err'] = $data_err;


                if(empty($data_err['title_err']) && empty($data_err['description_err']))
                {
                    //go to model and update this
                    if($this->postModel->editPost($data))
                    {
                        redirect('posts');
                    }
                    else
                    {
                        die("Something went wrong");
                    }
                }
                else
                {
                    $this->view('posts/edit', $data);
                }

            }
            else
            {
                $this->view('posts/edit', $data);
            }

        } else
        {
            die("whoops!");
        }


    }
}