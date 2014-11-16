<?php 

class Tag extends Model
{
    public static function findAll()
    {
        $sql = "SELECT * FROM tag";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function addTag($tag_name)
    {
        $sql = "INSERT INTO tag (name) value (\"".$tag_name."\");";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            throw new Exception("Error occur when creating tag, db failed info: ".$e->getMessage());
        }
    }

    public static function findTagById($id)
    {
        $sql = "SELECT * FROM tag WHERE id=".$id." LIMIT 1";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    
    public static function updateTagById($id, $name)
    {
        $sql = "UPDATE tag SET name=\"".$name."\" WHERE id=".$id.";";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        } catch (PDOException $e) {
            throw new Exception("Error occur when updating tag $id, db failed info: ".$e->getMessage());
        }
    }

    public static function deleteTagById($id)
    {
        if (!self::findTagById($id)) {
            return False;
        }
        $sql = "DELETE FROM tag WHERE id=".$id.";";
        $query = self::getDbConnection()->prepare($sql);
        try {
            $query->execute();
            return True;
        }
        catch (PDOException $e) {
            throw new Exception("Error occur when deleting tag $id, db failed info: ".$e->getMessage());
        }
    }
}


