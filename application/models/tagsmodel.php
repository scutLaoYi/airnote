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
}


