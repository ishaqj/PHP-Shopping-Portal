<?php
class Cart extends Products {
	
	/**
	 * Cart Class for managing shopping cart.
	 *
	 * @author Ishaq Jound
	 **/


	/**
	 * Properties
	 *
	 **/
	private $db;
    private $product = [];
    private $qty = [];
    private $nrOfItems;

	/**
	 * Sets $db to a database connection upon class instantiation
	 *
	 * @return void
	 * @author Ishaq Jound 
	 **/
	public function __construct($db)
	{
		$this->db = $db;
        if(!isset($_SESSION['products']))
        {
            $_SESSION['products'] = array();
        }

	}

	/**
	 * Shows the current added products in the shopping cart.
	 *
	 * @return json $itemsCart items that are returned in json format.
	 * @author Ishaq Jound
	 **/
    public function initiateShoppingCart() {
        if(isset($_SESSION['products']) && !empty($_SESSION['products'])) {
            $items = $_SESSION['products'];
            $ids = array();
            foreach ($items as $id => $item) {
                $ids[] = $id;
            }

            $placeHolders = implode(',', array_fill(0, count($ids), '?'));
            $shopItems = $this->getItems($placeHolders,$ids);

            foreach ($shopItems as $i => $item) {
                if(array_key_exists($item->product_id,$_SESSION['products']))
                {
                    $this->product[] = new Products(null);
                    $this->product[$i]->setName($item->name);
					$this->product[$i]->setPrice($item->price);
                    $this->qty[$i] = $_SESSION['products'][$item->product_id];
                }
            }

            $itemsInCart = $this->itemsInShoppingCart();

            return json_encode($itemsInCart);
        }
        return false;
    }

	/**
	 * Shows the current added products in the shopping cart.
	 *
	 * @return json $itemsCart items that are returned in json format.
	 * @author Ishaq Jound
	 **/
    public function itemsInShoppingCart() {
        $items = [];
        foreach ($this->product as $i => $product) {
            $items[] = [
                "name" => $product->getName(),
                "price" => $product->getPrice(),
                "qty" => $this->qty[$i],
                "sum" => $this->productsSum()
            ];
        }
        return $items;
    }

	/**
	 * Add Item to Shopping Cart.
	 *
	 * @param int $id a id of item to be added.
	 * 
	 * @return void
	 * @author Ishaq Jound
	 **/
	public function addItem($id) {

		if(!isset($_SESSION['products'][$id]))
		{
			$_SESSION['products'][$id] = 0;
		}

		$item = $this->db->fetch("SELECT * FROM products INNER JOIN stock ON products.id = stock.product_id WHERE products.id = ?", array($id));
		
		if($item != null)
		{

		if($_SESSION['products'][$id] < $item->stock)
		{
			$_SESSION['products'][$id] += 1;

            $this->addSuccess("Du har nu lagt 1 st {$item->name} för {$item->price} kr i din varukorg.");
		}

		else {
			$this->addError("Det går inte att lägga till fler enheter. Produkten finns endast kvar i ett begränsat antal.");
		}
		
		}

		else {

			// If invalid product id, unset it from Session.
			unset($_SESSION['products'][$id]);
		}

	}

	/**
	 * Update Item Quantity
	 *
	 * @param int $id a id of item to be updated.
	 * @param int $qty quantity of item to be updated.
	 * 
	 * @return void
	 * @author Ishaq Jound
	 **/
	public function updateItem($id, $qty)
	{
		$item = $this->db->fetch("SELECT * FROM products INNER JOIN stock ON products.id = stock.product_id WHERE products.id = ?", array($id));

		// If quantity is numeric and is set to 0 or negative number, remove the item.
		if(is_numeric($qty) && $qty <= 0)
		{
			unset($_SESSION['products'][$id]);
			$this->addSuccess("Varukorgen har uppdaterats. Produkten har tagits bort.");
		}

		// If quantity is numeric and quantity is less or equal to stock, add it.
		elseif(is_numeric($qty) && $item->stock >= $qty) {

			$_SESSION['products'][$id] = (int) $qty;
			$this->addSuccess("Varukorgen har uppdaterats. Antalet har ändrats.");
		}

		// If quantity is not numeric, print error.
		elseif(!is_numeric($qty))
		{
			$this->addError("Var god och ange antalet i siffror.");
		}
		// if quantity > stock, print error.
		else {

			$this->addError("Det går inte att lägga till fler enheter. Produkten finns endast kvar i ett begränsat antal.");	
		}
	}

	/**
	 * Get items id from Session and use the ids to select the products from database using IN operator.
	 *
	 * @param string $place_holder for question mark placeholders
	 * @param array $ids containing items id
	 * 
	 * @return $result returns an array containing all of the result set rows
	 * @author Ishaq Jound
	 **/
	public function getItems($place_holder,$ids) {
		$result = $this->db->query("SELECT * FROM products INNER JOIN stock ON products.id = stock.product_id WHERE products.id IN ($place_holder)", $ids);
		return $result;
	}

	/**
	 * Remove Item from Shopping Cart.
	 *
	 * @param int $id a id of item to be removed.
	 * 
	 * @return void
	 * @author Ishaq Jound
	 **/
	public function removeItem($id) {

		if($_SESSION['products'][$id] != null) {
			unset($_SESSION['products'][$id]);
			$this->addSuccess("Varukorgen har uppdaterats. Produkten har tagits bort.");
		}

		else {

			// If invalid product id, print error msg.
			$this->addError("Produkten existerar inte. Ogiltigt produkt-ID.");
		}
	}

	/**
	 * Get the total number of items in the shopping cart.
	 *
	 * @return array_sum $nrOfItems return the sum of number of items in the cart.
	 * @author Ishaq Jound
	 **/
	public function cartItems() {
		if(isset($_SESSION['products']) && !empty($_SESSION['products']))
        {
            $this->nrOfItems = $_SESSION['products'];
            return array_sum($this->nrOfItems);
        }
        return false;
	}

    /**
     * Get the sum of the products.
     *
     * @return int $sum return the sum of the products in the cart.
     * @author Ishaq Jound
     **/
    public function productsSum() {
		$sum = 0;
        if(isset($_SESSION['products']) && !empty($_SESSION['products'])) {

            $products = $_SESSION['products'];
            $ids = [];

            foreach ($products as $productsId => $item) {
                $ids[] = $productsId;
            }

            $place_holders = implode(',', array_fill(0, count($ids), '?'));
            $shopItems = $this->getItems($place_holders,$ids);

            foreach ($shopItems as $item) {
                $sum += $_SESSION['products'][$item->product_id] * $item->price;
            }
            return $sum;
        }

        return false;
    }

	/**
	 * Empty Shopping Cart.
	 *
	 * @return void
	 * @author Ishaq Jound
	 **/
	public function destroyShoppingCart() {
		session_destroy();
	}

} // END class 