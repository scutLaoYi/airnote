<?php 

class NotesModel
{
    function __construct($db) {
        try {
            $this->db = $db;
        }
        catch (PDOException $e) {
            exit('Database connection failed in notes model.');
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM note";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function add($title, $content, $tag_id)
    {
        $sql = "INSERT INTO note (title, content, tag_id) value (\"$title\", \"$content\", \"$tag_id\");";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            exit('Creating new note failed!');
        }
        return False;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM note WHERE id=".$id." LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function findByTagId($tag_id)
    {
        $sql = "SELECT * FROM note WHERE tag_id=\"$tag_id\" ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function updateById($id, $title, $content, $tag_id)
    {
        $sql = "UPDATE note SET title=\"$title\", content=\"$content\", tag_id=\"$tag_id\" WHERE id=".$id.";";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        } catch (PDOException $e) {
            exit('Failed when try to update note.');
        }
    }

    public function deleteById($id)
    {
        if (!$this->findById($id)) {
            return False;
        }
        $sql = "DELETE FROM note WHERE id=".$id.";";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            exit('Failed when delete the note.');
        }
    }
}


