<?php 
require_once('Database.php');

class Book {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function uploadBook($userId, $title, $author, $categoryId, $summary, $coverImage, $pdfFile){
        $errors = [];

        if(empty($title)){
            $errors['title'] = "A cím megadása kötelező.";
        }

        if(empty($author)){
            $errors['author'] = "A szerző megadása kötelező";
        }

        $coverFileName = null;
        if($coverImage && $coverImage['error'] === UPLOAD_ERR_OK){
            $imageResult = $this->handleImageUpload($coverImage);
            if($imageResult['success']){
                $coverFileName = $imageResult['filename'];
            } else {
                $errors['cover'] = $imageResult['error'];
            }
        }

        $pdfFileName = null;
        if($pdfFile && $pdfFile['error'] === UPLOAD_ERR_OK){
            $pdfResult = $this->handlePdfUpload($pdfFile);
            if($pdfResult['success']){
                $pdfFileName = $pdfResult['filename'];
            } else {
                $errors['pdf'] = $pdfResult['error'];
            }
        }

        if(!empty($errors)){
            if($coverFileName) @unlink(UPLOAD_PATH_COVERS . $coverFileName);
            if($pdfFileName) @unlink(UPLOAD_PATH_BOOKS . $pdfFileName);
            return ['succes' => false, 'errors' => $errors];
        }

        $sql = 'INSERT INTO books (user_id, title, author, category_id, summary, cover_image, pdf_file)
            VALUES (?,?,?,?,?,?,?
        ';

        $result = $this->db->execute($sql, [
            $userId, $title, $author, $categoryId, $summary, $coverFileName, $pdfFileName
        ]);

        if($result){
            return ['success' => true, 'book_id' => $this->db->lastInsertId()];
        }

        return ['success' => false, 'errors' => ['general' => 'Hiba történt a feltöltés során.']];
    }


    private function handleImageUpload($file){
        if($file['size'] > UPLOAD_MAX_SIZE) {
            return ['success' => false, 'error' => 'A fájl mérete túl nagy.'];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if(!in_array($mimeType, ALLOWED_IMAGE_TYPES)){
            return ['success' => false, 'error' => 'Csak JPGM PNG képek engedéllyezetek!'];
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('cover_', true) . '.' . $extension;
        $destination = UPLOAD_PATH_COVERS . $filename;

        if(move_uploaded_file($file['tmp_name'], $destination)){
            return ['success' => true, 'filename' => $filename];
        }

        return ['success' => false, 'errors' => "Nem sikerült feltölteni a képet."];
    }

    private function handlePdfUpload($file){
        if($file['size'] > UPLOAD_MAX_SIZE){
            return ['success' => false, 'error' => 'A fájl mérete túl nagy.'];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if(!in_array($mimeType, ALLOWED_IMAGE_TYPES)){
            return ['success'=> false, 'error'=> 'Csak PDF fájlok engedélyezetek!'];
        }

        $filename = uniqid('book_', true) . '.pdf';
        $destination = UPLOAD_PATH_BOOKS . $filename;

        if(move_uploaded_file($file['tmp_name'], $destination)){
            return ['success'=> true,'filename'=> $filename];
        }

        return ['success' => false, 'error' => 'Nem sikerült feltölteni a PDF fájlt.'];
    }

    public function getBookByUser($userId){
        $sql = "SELECT b.*, c.name as category_name, u.username
        FROM books b
        LEFT JOIN categories c on b.category_id = c.id
        LEFT JOIN users u ON b.user_id = u.id
        WHERE b.user.id = ?
        ORDER BY b.created_at DESC
        ";
        return $this->db->query($sql, [$userId]);
    }

    public function getAllBooks($limit = 50, $offset = 0){
        $sql = "SELECT b.*, c.name as category_name, u.username
            FROM books b
            LEFT JOIN categories c ON b.category_id = c.id
            LEFT JOIN users u ON b.user_id = u.id
            ORDER BY b.created_at DESC 
            LIMIT ? OFFSET ?
        ";

        return $this->db->query($sql, [$limit, $offset]);
    }

    public function getCategories(){
        return $this->db->query("SELECT * FROM categories ORDER BY name");
    }

    public function deleteBook($bookId, $userId){
        $book = $this->db->queryOne("SELECT * FROM books WHERE id = ? AND user_id = ?", [$bookId, $userId]);

        if(!$book){
            return ["success" => false, 'error' => "Nincs jogosultságod törölni ezt a könyvet!"];
        }

        if($book['cover_image']) @unlink(UPLOAD_PATH_COVERS . $book['cover_image']);
        if($book['pdf_file']) @unlink(UPLOAD_PATH_BOOKS . $book['pdf_file']);

        $sql = "DELETE FRON books WHERE id = ? AND user_id = ?";
        $result = $this->db->execute($sql, [$bookId, $userId]);

        if($result){
            return ["success"=> true];
        }

        return ["success" => false, 'error' => "Hiba történt a törlés során."];
    }
}

?>