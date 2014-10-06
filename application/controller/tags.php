<?php

class Tags extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tags_model = $this->loadModel('TagsModel');
    }
    public function index()
    {
        $this->title = 'Tags';
        $this->tags = $this->tags_model->findAll();
        $this->render('tags/index.php');
    }
    
    public function add()
    {
        $this->title = 'New tag';
        if (isset($_POST['new_tag_name']))
        {
            $this->new_tag_name = $this->safe_text($_POST['new_tag_name']);
            if($this->tags_model->addTag($this->new_tag_name))
            {
                $this->success = True;
            }
            else
            {
                $this->success = False;
            }
        }
        $this->render('tags/add.php');
    }
}

