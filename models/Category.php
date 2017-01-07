<?php
namespace app\models;
use app\core\Model;

class Category extends Model
{

    public $id;
    public $name;
    public $parentID;

    public function __construct($id, $name, $parentID) {
        $this->id      = $id;
        $this->name  = $name;
        $this->parentID  = $parentID;
    }

    /**
     * Get all
     *
     * @return array
     */
    public static function findAll()
    {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category");
        return self::getObject($stmt->fetchAll());
    }

    public static function findChild($id)
    {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category WHERE parent_id=:id");
        $stmt->execute(['id' => $id]);
        return self::getObject($stmt->fetchAll());
    }

    public static function findByPk($id)
    {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new Category($row['id'], $row['name'], $row['parent_id']);
    }

    public static function getObject($fetch) {
        $list = [];
        foreach($fetch as $item) {
            $list[] = new Category($item['id'], $item['name'], $item['parent_id']);
        }
        return $list;
    }

    public function save() {
        $sql = "INSERT INTO `category` (`name`, `parent_id`) VALUES (:name, :parent_id)";
        $db = self::getInstance();
        $stmt = $db->prepare($sql);
        $inserted = $stmt->execute(['name' => $this->name, 'parent_id' => $this->parentID]);
    }
}