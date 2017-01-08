<?php
namespace app\models;
use app\core\Model;


class Ads extends Model
{
    public $id;
    public $name;
    public $description;
    public $category_id;
    public $price;
    public $create_at;
    public $update_at;
    public $category_name;

    public function __construct($item) {
        $this->id = isset($item['id']) ? $item['id']:  0;
        $this->name = $item['name'];
        $this->description = $item['description'];
        $this->category_id = $item['category_id'];
        $this->price = $item['price'];
        $this->create_at = $item['create_at'];
        $this->update_at = $item['update_at'];
        $this->category_name = isset($item['category_name']) ? $item['category_name'] : "";
    }

    public static function findAll() {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM ads");
        $stmt->execute();
        return self::getObject($stmt->fetchAll());
    }

    public static function findOne($id) {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT * FROM ads WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return new Ads($stmt->fetch());
    }

    public static function getObject($fetch) {
        $list = [];
        foreach($fetch as $item) {
            $list[] = new Ads($item);
        }
        return $list;
    }

    public static function getSeatch($q) {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT a.*, c.name AS category_name, c.parent_id, c.id AS cid, c.end_branch
                                FROM ads AS a 
                                LEFT JOIN category AS c
                                ON a.category_id=c.id
                            WHERE a.name LIKE :q OR a.description LIKE :q OR c.name LIKE :q");
        $stmt->execute(['q' => '%'.$q.'%']);
        return self::getObject($stmt->fetchAll());
    }

    public static function findChild($category_id) {
        $db = self::getInstance();
        $stmt = $db->prepare("SELECT a.*, c.name AS category_name, c.parent_id, c.id AS cid, c.end_branch
                                FROM ads AS a 
                                RIGHT JOIN category AS c
                                ON a.category_id=c.id");
        $stmt->execute();
        $row = $stmt->fetchAll();

        return self::getChild($row, $category_id, []);
    }

    public static function getChild($row, $parent_id, $list) {
        foreach ($row as $item) {
            if($item['cid'] == $parent_id) {
                if ($item['end_branch'] == 1 && $item['category_id'] != null) {
                    $list[] = new Ads($item);
                }
            }
            if($item['parent_id'] == $parent_id) {
                if($item['end_branch'] == 1 && $item['category_id'] != null) {
                    $list[] = new Ads($item);
                } else {
                    return self::getChild($row, $item['cid'], $list);
                }
            }
        }
        return $list;
    }

    public function save() {
        $sql = "INSERT INTO `ads` (`name`, `description`, `category_id`, `price`, `create_at`, `update_at`) 
                  VALUES (:name, :description, :category_id, :price, :create_at, :update_at)";
        $db = self::getInstance();
        $stmt = $db->prepare($sql);
        $inserted = $stmt->execute([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);
    }
}