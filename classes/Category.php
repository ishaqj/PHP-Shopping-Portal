<?php

/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-06
 * Time: 17:00
 */
class Category extends Products
{
    private $db;
    private $categoryTable = "categories";

    private $id;
    private $name;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getCategory()
    {
        $result = $this->db->fetch("SELECT 
                                    cat_name 
                                   FROM  
                                    {$this->categoryTable} 
                                   WHERE 
                                    id = ?",
            array($this->id));

        $this->name = $result->cat_name;
    }

    public function getAllCategories()
    {
        $sql = "SELECT 
                  id,cat_name 
                FROM {$this->categoryTable}";

        $result = $this->db->query($sql);
        return $result;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}