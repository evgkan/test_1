<?php
namespace models;

use engine\Model;

class Product extends Model
{
    protected static $table = 'product';

    public $id;
    public $name;
    public $instock;
    public $cost;
    public $maker;

    /**
     * Return api attributes
     *
     * @return array
     */
    public function fields()
    {
        return ['id', 'name', 'instock', 'cost', 'maker'];
    }



    /**
     * @param $substr
     * @return Model[]|null
     */
    public static function findByNameSubstring($substr)
    {
        $table = static::$table;
        $rows = self::rows("SELECT * FROM $table WHERE name LIKE '%$substr%'", ['substr' => $substr]);
        $result = [];
        foreach ((array)$rows as $row) {
            $result[] = self::getFilledModel($row);
        }
        return $result;
    }


    /**
     * @param $makers string|array
     * @return Model[]|null
     */
    public static function findByMakers(array $makers)
    {
        $table = static::$table;
        $makers = '"' . implode('","', $makers) . '"';
        $rows = self::rows("SELECT * FROM $table WHERE maker IN ($makers)");
        $result = [];
        foreach ((array)$rows as $row) {
            $result[] = self::getFilledModel($row);
        }
        return $result;
    }


    /**
     * @param $ids array|string
     * @return array
     */
    public static function findByCategories($ids)
    {
        $table = static::$table;
        $ids = (array) $ids;
        $ids = implode(', ', $ids);
        $rel_rows = self::rows("SELECT product_id FROM product2category WHERE category_id IN ($ids)", ['ids' => $ids]);
        $products_ids = array_column($rel_rows, 'product_id');
        $products_ids = implode(', ', $products_ids);
        // find products
        $rows = self::rows("SELECT * FROM $table WHERE id IN ($products_ids)");
        $result = [];
        foreach ((array)$rows as $row) {
            $result[] = self::getFilledModel($row);
        }
        return $result;
    }



}