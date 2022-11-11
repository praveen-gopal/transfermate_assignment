<?php

class WritetoDB_Controller
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
	
	public function getAuthorsListByKey($key)
    {
        
		$Query = "SELECT a.name as AuthorName, b.name as BookName FROM authors as a INNER JOIN books as b ON b.author_id = a.id WHERE a.name LIKE '%$key%'";
        $result = $this->conn->query($Query);
        
		$authorsArray = [];
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$authorsArray[] = $row;
			}
			return $authorsArray; 
        } else {
            return $authorsArray;
        }
    }
	
	
	public function getAuthersList()
    {
        
		$authorsQuery = "SELECT id, name FROM authors";
        $result = $this->conn->query($authorsQuery);
        
		$authorsArray = [];
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$authorsArray[] = $row['name'];
			}
            return $authorsArray; 
        } else {
            return $authorsArray;
        }
    }
	
	public function getBooksList()
    {
        
		$booksQuery = "SELECT * FROM books";
        $result = $this->conn->query($booksQuery);
        
		if($result->num_rows > 0){
            return $result; 
        } else {
            return false;
        }
    }
	
	public function checkAutherName($name)
    {
        
		$query = "SELECT * FROM authors WHERE name = '$name'";
        $result = $this->conn->query($query);
        
		if($result->num_rows > 0){
            return true; 
        } else {
            return false;
        }
    }
	
	public function checkAutherWithBook($book, $author)
    {
        
		$query = "SELECT * FROM books as b INNER JOIN authors as a ON a.id = b.author_id WHERE b.name = '$book' AND a.name = '$author' ";
        $result = $this->conn->query($query);
        
		if($result->num_rows > 0){
            return true; 
        } else {
            return false;
        }
    }
	
	public function getAuthorID($name)
    {
        
		$query = "SELECT id FROM authors WHERE name = '$name'";
        $result = $this->conn->query($query);
        
		if($result->num_rows > 0){
            return $result->fetch_row(); 
        } else {
            return false;
        }
    }
	
	public function insert($inputData)
    {
		if(!empty($inputData)) {
		
			$already_exists_authorAndBook = [];
			
			foreach($inputData as $value) {
				
				$author = trim($value['author']);
				$book = trim($value['name']);
				
				if(!empty($author) & !empty($book)) {
					
					$is_exists_author = $this->checkAutherName($author);
					$is_exists_authorAndBook = $this->checkAutherWithBook($book, $author);
					
					if(!$is_exists_author) {
						$authorQuery = "INSERT INTO authors (name) VALUES ('$author')";
						if ($this->conn->query($authorQuery) === TRUE) {
							$author_last_id = $this->conn->insert_id;
							if($author_last_id) {
								$bookQuery = "INSERT INTO books (name, author_id) VALUES ('$book', '$author_last_id')";
								if ($this->conn->query($bookQuery) === TRUE) {
									$book_last_id = $this->conn->insert_id;
								}
							}
						}
					} else if ($is_exists_author && !$is_exists_authorAndBook){
						$authorID = $this->getAuthorID($author);
						$bookQuery = "INSERT INTO books (name, author_id) VALUES ('$book', '$authorID[0]')";
						if ($this->conn->query($bookQuery) === TRUE) {
							$book_last_id = $this->conn->insert_id;
						}
					} else {
						$already_exists_authorAndBook[] = array("AuthorName"=>$author,"BookName"=>$book);
					}
				}
			}
			
			return $already_exists_authorAndBook;
		} else {
			return false;
		}
	}		
}
?>