<?php

/**
 * Category model data access and manipulation (DAM) class.
 * This version is vulnerable to SQL injection.
 *
 * @author jam
 * @version 180428
 */
class CategoryDAM extends DAM {

	// Database connection is inherited from the parent.
	function __construct() {
		parent::__construct ();
	}

	/**
	 *
	 * @param int $categoryID
	 *        	the ID of the category to be read.
	 * @return NULL|Category the resulting Category object - null if category is
	 *         not in the database.
	 */
	public function readCategory($categoryID) {
		$query = 'SELECT * FROM categories
              WHERE categoryID = :categoryID';
		$statement = $this->db->prepare ( $query );
		$statement->bindValue(':categoryID', $categoryID);
		$statement->execute ();
		$categoryDB = $statement->fetch ();
		$statement->closeCursor ();
		if ($categoryDB == null) {
			return null;
		} else {
			return new Category ( $this->mapColsToVars ( $categoryDB ) );
		}
	}

	/**
	 * Read all the category objects in the database.
	 *
	 * @return Category[] an array of Category objects.
	 */
	public function readCategories() {
		$query = 'SELECT * FROM categories
              ORDER BY categoryID';
		$statement = $this->db->prepare ( $query );
		$statement->execute ();
		$categoriesDB = $statement->fetchAll ();
		$statement->closeCursor ();

		// Build an array of Administrator objects
		$categories = array ();
		foreach ( $categoriesDB as $key => $value ) {
			$categories [$key] = new Category ( $this->mapColsToVars ( $categoriesDB [$key] ) );
		}
		return $categories;
	}

	// Translate database columnames to object instance variable names
	private function mapColsToVars($colArray) {
		$varArray = array ();
		foreach ( $colArray as $key => $value ) {
			if ($key == 'categoryID') {
				$varArray ['id'] = $value;
			} else if ($key == 'categoryName') {
				$varArray ['name'] = $value;
			}
		}
		return $varArray;
	}
}
