<?php
    require_once 'dbConfig.php';
    $db = new DBcon();
    
    if(!empty($_POST['bookClass'])) {
        $query = "SELECT * FROM books WHERE book_class = '" . $_POST['bookClass'] . "'";
        $results = $db->fetchData($query);   
?>
    <option value="">Select book</option>
<?php
     foreach($results as $book) {
?>
    <option value="<?php echo $book['title']; ?>"><?php echo $book['title']; ?></option>
<?php
    }
}
?>