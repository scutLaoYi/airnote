<?php

class TagsController extends Controller
{
    public static function accessRules()
    {
       return array(
              ALLOW_FROM_ALL => array(),
              ALLOW_FROM_LOGIN => array('index', 'add', 'edit', 'deleteTag'),
              );
    }

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
            $this->new_tag_name = $this->safeText($_POST['new_tag_name']);
            if($this->tags_model->addTag($this->new_tag_name))
            {
                $this->raiseInfo("New tag added.");
            }
            else
            {
                $this->raiseAlert("Fuck when adding new tag.");
            }
        }
        $this->render('tags/add.php');
    }
    public function edit($id=0)
    {
        $this->title="edit tag";
        if (isset($_POST['tag_id'])) {
            $tag_id = $this->safeText($_POST['tag_id']);
            $tag_name = $this->safeText($_POST['tag_name']);

            $success = False;
            if(strlen($tag_name) > 0) {
                if ($this->tags_model->findTagById($tag_id)) {
                    $success = $this->tags_model->updateTagById($tag_id, $tag_name);
                }
            }
            if (!$success) {
                $this->raiseAlert("update target tag failed!");
            }
            else {
                $this->raiseInfo("Update target tag success.");
            }
            //redirection
            return $this->index();
        }
        else {
            $id = $this->safeText($id);
            $this->current_tag = $this->tags_model->findTagById($id);
            if (!$this->current_tag) {
                return $this->index();
            }
            $this->render('tags/edit.php');
        }
    }
    public function deleteTag($id=0)
    {
        $id = $this->safeText($id);
        if ($id === 0 || !$this->tags_model->findTagById($id))
        {
            $this->raiseAlert("Tag not found!");
        }
        else
        {
            if ($this->tags_model->deleteTagById($id)) {
                $this->raiseInfo("Deleted target tag.");
            } else {
                $this->raiseAlert("Failed when delete tag.");
            }
        }
        return $this->index();
    }

}

