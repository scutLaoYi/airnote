<?php 

class Note extends Model
{
    public static function findAll()
    {
        $sql = "SELECT * FROM note ORDER BY id DESC";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function add($title, $content, $tag_id)
    {
        if (strlen($title) == 0 || 
                strlen($content) == 0)
        {
            return False;
        }
                
        $sql = "INSERT INTO note (title, content, tag_id) value (\"$title\", \"$content\", \"$tag_id\");";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            throw new Exception("Error occur when creating note, db failed info: ".$e->getMessage());
            return False;
        }
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM note WHERE id=$id LIMIT 1";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public static function findByTagId($tag_id)
    {
        $sql = "SELECT * FROM note WHERE tag_id=\"$tag_id\" ORDER BY id DESC";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public static function updateById($id, $title, $content, $tag_id)
    {
        $sql = "UPDATE note SET title=\"$title\", content=\"$content\", tag_id=\"$tag_id\" WHERE id=".$id.";";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        } catch (PDOException $e) {
            throw new Exception("Error occur when update note $id, db failed info: ".$e->getMessage());
        }
    }

    public static function deleteById($id)
    {
        if (!self::findById($id)) {
            return False;
        }
        $sql = "DELETE FROM note WHERE id=$id;";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            throw new Exception("Error occur when delete note $id, db failed info: ".$e->getMessage());
        }
    }
}


