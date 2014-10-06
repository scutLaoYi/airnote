<?php 

class TagsModel
{
    function __construct($db) {
        try {
            $this->db = $db;
        }
        catch (PDOException $e) {
            exit('Database connection failed in tags model.');
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM tag";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addTag($tag_name)
    {
        $sql = "INSERT INTO tag (name) value (\"".$tag_name."\");";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            exit('Creating new tag failed!');
        }
        return False;
    }

    public function findTagById($id)
    {
        $sql = "SELECT * FROM tag WHERE id=".$id." LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    
    public function updateTagById($id, $name)
    {
        $sql = "UPDATE tag SET name=\"".$name."\" WHERE id=".$id.";";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        } catch (PDOException $e) {
            exit('Failed when try to update tag.');
        }
    }

    public function deleteTagById($id)
    {
        if (!$this->findTagById($id)) {
            return False;
        }
        $sql = "DELETE FROM tag WHERE id=".$id.";";
        $query = $this->db->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            exit('Failed when delete the tag.');
        }
    }
}


