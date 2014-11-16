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

    public function index()
    {
        $this->title = 'Tags';
        $this->tags = Tag::findAll();
        $this->render('tags/index.php');
    }
    
    public function add()
    {
        $this->title = 'New tag';
        if (isset($_POST['new_tag_name']))
        {
            $this->new_tag_name = $this->safeText($_POST['new_tag_name']);
            if(Tag::addTag($this->new_tag_name))
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
                if (Tag::findTagById($tag_id)) {
                    $success = Tag::updateTagById($tag_id, $tag_name);
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
            $this->current_tag = Tag::findTagById($id);
            if (!$this->current_tag) {
                return $this->index();
            }
            $this->render('tags/edit.php');
        }
    }
    public function deleteTag($id=0)
    {
        $id = $this->safeText($id);
        if ($id === 0 || !Tag::findTagById($id))
        {
            $this->raiseAlert("Tag not found!");
        }
        else
        {
            if (Tag::deleteTagById($id)) {
                $this->raiseInfo("Deleted target tag.");
            } else {
                $this->raiseAlert("Failed when delete tag.");
            }
        }
        return $this->index();
    }

}

