<?php

class Products extends FlashMessage
{

    /**
     * Products Class for displaying products.
     *
     * @author Ishaq Jound
     **/

    /**
     * Properties
     *
     **/
    private $db;
    private $product_table = "products";

    private $id;
    private $name;
    private $description;
    private $price;
    private $created_at;
    private $updated_at;
    private $category_id;

    private $images = [];
    private $img_id;

    private $stock;
    private $stock_id;

    private $searchedProducts = [];

    /**
     * Sets $db to a database connection upon class instantiation
     *
     * @param object $db
     *
     * @return void
     * @author Ishaq Jound
     **/
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create()
    {
        $product = [
            $this->name = htmlspecialchars(strip_tags($this->name)),
            $this->description = htmlspecialchars($this->description),
            $this->created_at,
            $this->price = htmlspecialchars(strip_tags($this->price)),
            $this->category_id = htmlspecialchars(strip_tags($this->category_id))
        ];

        //PRODUCT
        $sql = "INSERT INTO 
                  {$this->product_table} 
                  (name,description,created_at,price,category_id)
                VALUES(?,?,?,?,?)";

        $this->db->insert($sql, $product);

        //GET LAST INSERTED ID
        $product_id = $this->db->lastInsertId();

        //INSERT STOCK
        $sql = "INSERT INTO 
                  stock (product_id, stock) 
                VALUES(?,?)";

        $stock = htmlspecialchars(strip_tags($this->stock));
        $this->db->insert($sql, [$product_id, $stock]);

        //INSERT IMAGES
        $sql = "INSERT INTO 
                  images (image, product_id) 
                VALUES(?,?)";
        foreach ($this->images as $image) {

            $this->db->insert($sql, [$image, $product_id]);
        }
    }

    public function update()
    {

        $product = [
            $this->name = htmlspecialchars(strip_tags($this->name)),
            $this->description = htmlspecialchars($this->description),
            $this->updated_at,
            $this->price = htmlspecialchars(strip_tags($this->price)),
            $this->category_id = htmlspecialchars(strip_tags($this->category_id)),
            $this->id
        ];

        // Product
        $sql = "UPDATE
                  {$this->product_table} 
                SET
                  name=?, description=?, updated = ?, price = ?, category_id = ?
                WHERE 
                  id = ?";

        $this->db->update($sql, $product);

        // product stock
        $sql = "UPDATE 
                    stock
                SET
                  stock = ?
                WHERE
                  product_id = ?
                ";

        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->db->update($sql, [$this->stock, $this->id]);

        //Product images
        $sql = "UPDATE
                      images
                    SET
                      image = ?
                    WHERE
                      id = ?
                    ";

        foreach ($this->images as $id => $image) {

            if (!empty($image)) {
                $this->db->update($sql, [$image, $this->img_id[$id]]);
            }
        }
    }

    /**
     * Show all products.
     *
     * @return $result returns an array containing all of the result set rows
     * @author Ishaq Jound
     **/
    public function showAllProducts($category_id = null, $from_record_num = null, $records_per_page = null)
    {
        $catId = htmlspecialchars(strip_tags($category_id));
        $query = "SELECT 
                    id,name,description,price,created_at,category_id 
                  FROM 
                    {$this->product_table} 
                  ORDER 
                    BY id DESC
                  LIMIT 
                    {$from_record_num}, {$records_per_page}";

        if (!is_null($category_id)) {
            $query = "SELECT 
                        id,name,description,price,created_at,category_id 
                      FROM  
                        {$this->product_table}
                      WHERE 
                        category_id = ?
                      ORDER 
                        BY id DESC
                      LIMIT 
                        {$from_record_num}, {$records_per_page}";
        }

        $result = $this->db->query($query, [$catId]);
        return $result;
    }

    public function getProduct()
    {
        $sql = "SELECT 
                  name,description,price,created_at,category_id
                FROM 
                  {$this->product_table}
                WHERE 
                  id =?";

        // PRODUCT INFO
        $product = $this->db->fetch($sql, [$this->id]);
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->created_at = $product->created_at;

        // PRODUCT IMAGES
        $sql = "SELECT 
                  i.id,i.image 
                FROM 
                  {$this->product_table} p
                INNER JOIN 
                  images i 
                ON 
                  p.id = i.product_id 
                WHERE p.id = ?";

        $images = $this->db->query($sql, [$this->id]);
        foreach ($images as $image) {
            $this->images[] = $image;
        }
    }


    public function productRowCount($category_id = null)
    {
        $catId = htmlspecialchars(strip_tags($category_id));
        $query = "SELECT 
                    id 
                  FROM 
                    {$this->product_table}";

        if (!is_null($category_id)) {
            $query = "SELECT 
                        id 
                      FROM 
                        {$this->product_table}
                      WHERE
                        category_id = ?
                    ";
        }

        $result = $this->db->rowCount($query, [$catId]);
        return $result;
    }

    public function searchProduct()
    {
        $sql = "SELECT 
                  p.id, p.name, p.description, p.price, p.created_at, c.cat_name, c.id AS cat_id
                FROM 
                  {$this->product_table} p
                INNER JOIN 
                  categories c
                ON
                  p.category_id = c.id
                WHERE 
                  p.name LIKE ?";

        $product = $this->db->query($sql, ["%" . $this->name . "%"]);


        if (!is_null($product)) {
            foreach ($product as $item) {
                $this->searchedProducts[] = [
                    "id" => $item->id,
                    "name" => $item->name,
                    "description" => $item->description,
                    "price" => $item->price,
                    "cat_name" => $item->cat_name,
                    "category_id" => $item->cat_id,
                    "created_at" => $item->created_at];
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getSearchedProducts()
    {
        return $this->searchedProducts;
    }

    public function getTimestamp()
    {
        date_default_timezone_set('Europe/Stockholm');
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function stock()
    {
        $sql = "SELECT 
                  id,stock
                FROM 
                  stock
                WHERE 
                  product_id =?";

        $stock = $this->db->fetch($sql, [$this->id]);
        $this->setStock($stock->stock);
        $this->setStockId($stock->id);
    }

    public function fetchImage()
    {
        $sql = "SELECT 
                  image,id
                FROM 
                  images
                WHERE 
                  product_id =?";

        $result = $this->db->fetch($sql, [$this->id]);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $image
     */
    public function setImages($image)
    {
        $this->images = $image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return mixed
     */
    public function getStockId()
    {
        return $this->stock_id;
    }

    /**
     * @param mixed $stock_id
     */
    public function setStockId($stock_id)
    {
        $this->stock_id = $stock_id;
    }


    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @param mixed $img_id
     */
    public function setImgId($img_id)
    {
        $this->img_id = $img_id;
    }


} // END class