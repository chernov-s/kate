<?php
namespace app\models;
use app\core\Model;

class Category extends Model
{

    public $id;
    public $name;
    public $parent_id;
    public $end_branch;

    public function __construct($id, $name, $parentID, $end_branch = 0) {
        $this->id      = $id;
        $this->name  = $name;
        $this->parent_id = $parentID;
        $this->end_branch = $end_branch;
    }

    /**
     * Get all
     *
     * @return array
     */
    public static function findAll() {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category");
        $stmt->execute();
        return self::getObject($stmt->fetchAll());
    }

    public static function findChild($id) {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category WHERE parent_id=:id");
        $stmt->execute(['id' => $id]);
        return self::getObject($stmt->fetchAll());
    }

    public static function findAllParent($child_id) {
        $category = self::findAll();
        return self::getParents($category, $child_id, []);
    }

    public static function getParents($category, $child_id, $list) {
        foreach ($category as $item) {
            if($item->id == $child_id) {
                $list[] = $item;
                return self::getParents($category, $item->parent_id, $list);
            }
        }
        return $list;
    }

    public static function findByPk($id) {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM category WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new Category($row['id'], $row['name'], $row['parent_id'], $row['end_branch']);
    }

    public static function getObject($fetch) {
        $list = [];
        foreach($fetch as $item) {
            $list[] = new Category($item['id'], $item['name'], $item['parent_id'], $item['end_branch']);
        }
        return $list;
    }

    public function save() {
        $sql = "INSERT INTO `category` (`name`, `parent_id`, `end_branch`) VALUES (:name, :parent_id, :end_branch)";
        $db = self::getInstance();
        $stmt = $db->prepare($sql);
        $inserted = $stmt->execute([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'end_branch' => $this->end_branch
        ]);
    }
}