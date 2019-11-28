<?php

use \Hcode\Page;
use \Hcode\Model\User;
use \Hcode\Model\Product;
use \Hcode\PageAdmin;
use \Hcode\Model;


$app->get("/admin/products", function(){

	$products = Product::listAll();

	$page = new PageAdmin();

	$page->setTpl("products", [
	   "products"=>$products
	]);
	

});

$app->get("/admin/products/create", function(){

	$products = Product::listAll();

	$page = new PageAdmin();

	$page->setTpl("products-create");
	

});

$app->post("/admin/products/create", function(){

	$product = new Product();

	$product->setData($_POST);

	$product->save();

	header("Location: /admin/products");
	exit;

});

$app->get("/admin/products/:idproduct", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$page = new PageAdmin;

	$page->setTpl("products-update", [
		'product'=>$product->getValues()
	]);

});

$app->post("/admin/products/:idproduct", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$product->setData($_POST);

	$product->save();

	$product->setPhoto($_FILES["file"]);

	header("Location: /admin/products");
	exit;

});

$app->get("/admin/products/:idproduct/delete", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$product->delete();

	header("Location: /admin/products");
	exit;

});

?>