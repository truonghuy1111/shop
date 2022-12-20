<?php
require_once 'mysql.php';
define('BASE_URL', 'http://localhost/js');

function get_category_list(){
    $sql = 'SELECT * FROM CATEGORIES';
    $pdo = get_pdo();

    $stmt = $pdo->query($sql);
    $category_list = array();

    while ($row = $stmt->fetch()) {
        $category = array(
            'id' => $row['id'],
            'name' => $row['name']
        );

        array_push($category_list, $category);
    }
    
    return json_encode($category_list);
}

/**
 * Api for product
 */
function get_product_list(){
    $sql = 'SELECT * FROM PRODUCTS';
    $pdo = get_pdo();

    $stmt = $pdo->query($sql);
    $product_list = array();

    while ($row = $stmt->fetch()) {
        $product = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'img' => $row['img'],
            'price' => $row['price'],
            'category_id' => $row['category_id']
        );

        array_push($product_list, $product);
    }
    
    return json_encode($product_list);
}

function get_product_list_by_category($category_id){
    $sql = 'SELECT * FROM PRODUCTS WHERE category_id=:category_id';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();

    $product_list = array();

    while ($row = $stmt->fetch()) {
        $product = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'img' => $row['img'],
            'price' => $row['price'],
            'category_id' => $row['category_id']
        );
        array_push($product_list, $product);
    }

    return json_encode($product_list);
}

function get_product($id){
    $sql = 'SELECT * FROM PRODUCTS WHERE id=:id';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $product = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'img' => $row['img'],
            'price' => $row['price'],
            'category_id' => $row['category_id']
        );

        return $product;
    }
    
    return null;
}
/**
 * Api for User
 */
function get_user_list(){
    $sql = 'SELECT * FROM USERS';
    $pdo = get_pdo();

    $stmt = $pdo->query($sql);
    $user_list = array();

    while ($row = $stmt->fetch()) {
        $user = array(
            'id' => $row['id'],
            'email' => $row['email'],
            'password' => $row['password'],
            'role' => $row['role'],
        );

        array_push($user_list, $user);
    }
    
    return json_encode($user_list);
}


function get_user($id){
    $sql = 'SELECT * FROM USERS WHERE id=:id';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $user = array(
            'id' => $row['id'],
            'email' => $row['email'],
            'password' => $row['password'],
            'role' => $row['role'],
        );

        return $user;
    }
    
    return null;
}
function delete_user($id){
    $sql = 'DELETE FROM USERS WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

function create_user($email,$password,$role){
    $sql = 'INSERT INTO USERS(ID,EMAIL,PASSWORD,ROLE) VALUES (NULL, :email, :password, :role)';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    return $stmt->execute();
}
function update_user($id,$email,$password,$role){
    $sql = 'UPDATE USERS SET EMAil=:email, PASSWORD=:password, ROLE=:role WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);


    return $stmt->execute();
}

/**
 * Authentication
 */
function login($email, $password){
    $sql = 'SELECT * FROM USERS WHERE email=:email AND password=:password';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $user = array(
            'id' => $row['id'],
            'email' => $row['email'],
            'password' => $row['password']
        );

        return $user;
    }
    
    return false;
}
function register($email, $password){
    $sql = 'INSERT INTO USERS (ID, EMAIL, PASSWORD) VALUES (null, :email, :password)';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    return false;
}

/**
 * Category api
 */
function delete_category($id){
    $sql = 'DELETE FROM CATEGORIES WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}
function create_category($name){
    $sql = 'INSERT INTO CATEGORIES(ID,NAME) VALUES (NULL, :name)';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);

    return $stmt->execute();
}
function get_category($id){
    $sql = 'SELECT * FROM CATEGORIES WHERE id=:id';
    $pdo = get_pdo();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $category = array(
            'id' => $row['id'],
            'name' => $row['name'],
            
        );

        return $category;
    }
    
    return null;
}
function update_category($id,$name){
    $sql = 'UPDATE  CATEGORIES SET NAME=:name WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);

    return $stmt->execute();
}
function delete_products($id){
    $sql = 'DELETE FROM PRODUCTS WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}
function create_products($name,$price,$img,$category_id){
    $sql = 'INSERT INTO PRODUCTS(ID,NAME,PRICE,CATEGORY_ID,IMG) VALUES (NULL, :name, :price, :category_id, :img)';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':img', $img);

    return $stmt->execute();
}
function update_products($id,$name,$price,$img){
    $sql = 'UPDATE PRODUCTS SET NAME=:name, PRICE=:price,IMG=:img WHERE ID=:id';
    $pdo = get_pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $img);

    return $stmt->execute();
}