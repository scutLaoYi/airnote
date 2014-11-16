<?php

class NotesController extends Controller
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
    }

    public function index($current_tag=0)
    {
        $this->title="Notes";
        if ($current_tag > 0) {
            $this->notes = Note::findByTagId($current_tag);
        }
        else{
            $this->notes = Note::findAll();
        }
        $this->tags = Tag::findAll();
        $this->current_tag = $current_tag;
        $this->render('notes/index.php');
    }

    public function add()
    {
        $this->title = 'Notes';
        $this->tags = Tag::findAll();
        if (isset($_POST['title']))
        {
            $title = $this->safeText($_POST['title']);
            $content = $this->safeText($_POST['content']);
            $tag_id = intval($_POST['tag_id']);
            if(Note::add($title, $content, $tag_id))
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
        $this->tags = Tag::findAll();
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
                if (Note::findById($id)) {
                    $success = Note::updateById($id, $title, $content, $tag_id);
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
        $this->current_note = Note::findById($id);
        if (!$this->current_note) {
            return $this->index();
        }
        $this->render('notes/edit.php');
    }
    public function delete($id=0)
    {
        $id = intval($id);
        if ($id === 0 || !Note::findById($id))
        {
            $this->raiseAlert("Note not found!");
        }
        else
        {
            if (Note::deleteById($id)) {
                $this->raiseInfo("Deleted note success.");
            } else {
                $this->raiseAlert("Failed when delete note.");
            }
        }
        return $this->index();
    }

}
