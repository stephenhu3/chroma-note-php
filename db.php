<?php
class NoteDB
{
    /*
     * db connection config vars
     */
    /**
     * Holds database user name
     *
     * @var string
     */
    const USER_EXAMPLE = "phpadmin";
    /**
     * Holds database password
     *
     * @var string
     */
    const PASS_EXAMPLE = "php";
    /**
     * Holds MySQL database source name
     *
     * @var string
     */
    const MYSQL_DSN_EXAMPLE = "mysql:host=MBP13.local;port=3307;dbname=chromanote";
    /**
     * Holds instance of the class itself
     *
     * @var noteDB
     */
    private static $instance = null;
    /**
     * Holds instances of the PDO base class
     *
     * @var PDO
     */
    private $con = null;
    
    /**
     * Get instance of the class itself
     *
     * @return noteDB
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    /*
     * The clone and wakeup methods prevents external instantiation of copies of
     * the Singleton class, thus eliminating the possibility of duplicate objects.
     */
    
    /**
     *  Clones object
     *
     * @throws RuntimeException always
     */
    public function __clone()
    {
        throw new RuntimeException("Clone of singelton object is not allowed.", 101);
    }
    
    /**
     * Reconstructs any resources that the object may have.
     *
     * @throws RuntimeException always
     */
    public function __wakeup()
    {
        throw new RuntimeException('Deserializing is not allowed.', 101);
    }
    
    /**
     * Class constructor method
     *
     * @throws RuntimeException if cannot establish connection with database
     */
    private function __construct()
    {
        /*
         * To avoid showing database connection details PDO constructor
         * is wrapped in try/catch block and new Exception is thrown
         */
        $USER_PROD = getenv("USER_PROD");
        $PASS_PROD = getenv("PASS_PROD");
        $MYSQL_DSN_PROD = getenv("MYSQL_DSN_PROD");

        try {
            $this->con = new PDO($MYSQL_DSN_PROD, $USER_PROD, $PASS_PROD, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
        }
        catch (Exception $e) {
            throw new RuntimeException("Failed to initiate connection to database. Shutting down!", 1010);
            exit;
        }
    }
    
    /**
     * Gets user identifier of the user having given name
     *
     * @param string $name
     * @return integer
     */
    public function get_user_id_by_name($name)
    {
        $query = "";
        $stid  = null;
        $row   = array();
        
        $query = "
            SELECT id ID
            FROM users
            WHERE name = :user_bv
            ";
        $stid  = $this->con->prepare($query);
        $stid->bindParam(":user_bv", $name, PDO::PARAM_STR);
        $stid->execute();
        
        //Because name is a unique value I only expect one row
        $row = $stid->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return (int) $row['ID'];
        } else {
            return 0;
        }
    }
    
    /**
     * Gets user's notes for the user having given name
     *
     * @param string $name
     * @return ArrayIterator
     */
    public function get_notes_by_user_name($name)
    {
        $query  = "";
        $stid   = null;
        $row    = array();
        $result = null;
        
        $query = "
            SELECT w.id ID, w.content CONTENT,
            w.date_created DATE_CREATED, wr.id WRID
            FROM notes w RIGHT OUTER JOIN users wr
            ON wr.id = w.user_id
            WHERE wr.name = :user_bv
            ";
        
        $stid = $this->con->prepare($query);
        $stid->bindParam(":user_bv", $name, PDO::PARAM_STR);
        $stid->execute();
        
        $result = new ArrayIterator();
        while ($row = $stid->fetch(PDO::FETCH_ASSOC)) {
            $result->append($row);
        }
        $result->rewind();
        
        return $result;
    }
    
    /**
     * Gets PDOstatement having executed query
     *
     * @param integer $user_id
     * @return PDOStatement
     */
    public function get_notes_by_user_id($user_id)
    {
        $query = "";
        $stid  = null;
        
        $query = "
            SELECT id ID, content CONTENT, date_created DATE_CREATED
            FROM notes
            WHERE user_id =  :id_bv
            ";
        $stid  = $this->con->prepare($query);
        $stid->bindParam(":id_bv", $user_id, PDO::PARAM_INT);
        $stid->execute();
        
        return $stid;
    }
    
    /**
     * Stores user record
     *
     * @param string $name
     * @param string $password
     */
    public function create_user($name, $password)
    {
        $query = "";
        $stid  = null;
        
        $query = "
            INSERT INTO users (name, password)
            VALUES (:name_bv, :password_bv)
            ";
        
        $stid = $this->con->prepare($query);
        $stid->bindParam(":name_bv", $name, PDO::PARAM_STR);
        $stid->bindParam(":password_bv", $password, PDO::PARAM_STR);
        $stid->execute();
    }
    
    /**
     *
     * @param string $name
     * @param string $password
     * @return boolean
     */
    public function verify_user_credentials($name, $password)
    {
        $query = "";
        $stid  = null;
        $row   = array();
        
        $query = "
            SELECT 1
            from users
            where name = :name_bv
            and password = :password_bv
       ";
        $stid  = $this->con->prepare($query);
        $stid->bindParam(":name_bv", $name, PDO::PARAM_STR);
        $stid->bindParam(":password_bv", $password, PDO::PARAM_STR);
        $stid->execute();
        
        //Because name is a unique value I only expect one row
        $row = $stid->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Stores note record
     *
     * @param integer $user_id
     * @param string $content
     * @param string $date_created
     */
    function insert_note($user_id, $content, $date_created)
    {
        $query = "";
        $stid  = null;
        
        $query = "
            INSERT INTO notes (user_id, content, date_created)
            VALUES (
                :user_id_bv,
                :content_bv,
                :date_created_bv
                )
            ";
        
        $stid = $this->con->prepare($query);
        $stid->bindParam(":user_id_bv", $user_id, PDO::PARAM_INT);
        $stid->bindParam(':content_bv', $content, PDO::PARAM_STR);
        $stid->bindParam(':date_created_bv', $date_created, PDO::PARAM_STR);
        $stid->execute();
    }
    
    /**
     * Converts date string to timestamp
     *
     * @param string $date
     * @return string
     */
    function format_date_for_sql($date)
    {
        if ($date == "") {
            return null;
        } else {
            $dateTime = new DateTime($date, new DateTimeZone("UTC"));
            return $dateTime->format("Y-n-j H:i:s e");
        }
    }
    
    public function update_note($id, $content, $date_created)
    {
        $query = "";
        $stid  = null;
        
        var_dump($date, $id);
        
        $query = "
            UPDATE notes
            SET content = :content_bv,
            date_created = :date_created_bv
            WHERE id = :note_id_bv
            ";
        $stid  = $this->con->prepare($query);
        $stid->bindParam(":note_id_bv", $id, PDO::PARAM_INT);
        $stid->bindParam(':content_bv', $content, PDO::PARAM_STR);
        $stid->bindParam(':date_created_bv', $date, PDO::PARAM_STR);
        $result = $stid->execute();
    }
    
    /**
     * Gets note record with given #id
     *
     * @param integer $id
     * @return array
     */
    public function get_note_by_note_id($id)
    {
        $query = "";
        $stid  = null;
        $row   = array();
        
        $query = "
            SELECT id ID, content CONTENT, date_created DATE_CREATED
            FROM notes
            WHERE id = :note_id_bv
            ";
        $stid  = $this->con->prepare($query);
        $stid->bindValue(":note_id_bv", (int) $id, PDO::PARAM_INT);
        $stid->execute();
        
        //Because name is a unique value I only expect one row
        $row = $stid->fetch(PDO::FETCH_ASSOC);
        
        $stid = null;
        
        return $row;
    }
    
    public function delete_note($id)
    {
        $query = "";
        $stid  = null;
        
        $query = "
            DELETE FROM notes
            WHERE id = :note_id_bv
            ";
        
        $stid = $this->con->prepare($query);
        $stid->bindValue(":note_id_bv", (int) $id, PDO::PARAM_INT);
        $stid->execute();
    }
}
?>