<?php

class Notes extends Controller
{
    public static function accessRules()
    {
       return array(
              ALLOW_FROM_ALL => array(),
              ALLOW_FROM_LOGIN => array('index','add', 'edit', 'delete'),
              );
    }

    function __construct()
    {
        parent::__construct();
        $this->notesModel = $this->loadModel('NotesModel');
        $this->tagsModel = $this->loadModel('TagsModel');
    }

    public function index($current_tag=0)
    {
        $this->title="Notes";
        if ($current_tag > 0) {
            $this->notes = $this->notesModel->findByTagId($current_tag);
        }
        else{
            $this->notes = $this->notesModel->findAll();
        }
        $this->tags = $this->tagsModel->findAll();
        $this->current_tag = $current_tag;
        $this->render('notes/index.php');
    }

    public function add()
    {
        $this->title = 'Notes';
        $this->tags = $this->tagsModel->findAll();
        if (isset($_POST['title']))
        {
            $title = $this->safeText($_POST['title']);
            $content = $this->safeText($_POST['content']);
            $tag_id = intval($_POST['tag_id']);
            if($this->notesModel->add($title, $content, $tag_id))
            {
                $this->raiseInfo("New note added.");
            }
            else
            {
                $this->raiseAlert("Fuck when adding new note.");
            }
        }
        $this->title = 'New note';
        $this->render('notes/add.php');
    }
    public function edit($id=0)
    {
        $this->title="edit note";
        $this->tags = $this->tagsModel->findAll();
        if (isset($_POST['id'])) {
            $id = $this->safeText($_POST['id']);
            $title = $this->safeText($_POST['title']);
            $content = $this->safeText($_POST['content']);
            $tag_id = intval($_POST['tag_id']);

            $success = False;
            if(strlen($title) > 0 &&
                    strlen($content) > 0 &&
                    $tag_id > 0
                    ) {
                if ($this->notesModel->findById($id)) {
                    $success = $this->notesModel->updateById($id, $title, $content, $tag_id);
                }
            }
            if (!$success) {
                $this->raiseAlert("update target note failed!");
            }
            else {
                $this->raiseInfo("Update target note success.");
            }
        }
        $id = intval($id);
        $this->current_note = $this->notesModel->findById($id);
        if (!$this->current_note) {
            return $this->index();
        }
        $this->render('notes/edit.php');
    }
    public function delete($id=0)
    {
        $id = intval($id);
        if ($id === 0 || !$this->notesModel->findById($id))
        {
            $this->raiseAlert("Note not found!");
        }
        else
        {
            if ($this->notesModel->deleteById($id)) {
                $this->raiseInfo("Deleted note success.");
            } else {
                $this->raiseAlert("Failed when delete note.");
            }
        }
        return $this->index();
    }

}
