<?php
namespace models;

use engine\Model;

class Category extends Model
{
    private static $tree;

    protected static $table = 'category';

    public $id;
    public $parent_id;
    public $name;

    /**
     * Return api attributes
     *
     * @return array
     */
    public function fields()
    {
        return ['id', 'parent_id', 'name'];
    }


    /**
     * Find identificators of all subcategories
     *
     * @param int $rootID
     * @param $categories
     * @return array
     */
    private static function findSubIds($rootID = 0, $categories)
    {
        $arrIdChildCats = [];
        foreach($categories as $value) {
            if($value['parent_id'] == $rootID) {
                $arrIdChildCats[] = $value['id'];
            }
        }
        $result = [];
        foreach($arrIdChildCats as $value) {
            $result[] = $value;
            $result = array_merge(
                $result,
                self::findSubIds($value, $categories)
            );
        }
        return $result;
    }


    /**
     * @return array
     */
    public function getSubIds()
    {
        return self::findSubIds($this->id, self::findAllAsArray());
    }


}