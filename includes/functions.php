<?php
class TravelAppFunctions 
{
    private $db;

    public function __construct() 
    {
        $dbPath = '.\database\travel_app.db';
        $this->db = new SQLite3($dbPath);
    }

    public function register($username, $email, $password) 
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function login($username, $password) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $username);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        if ($user && password_verify($password, $user['password'])) 
        {
            return $user;
        }
        return false;
    }

    public function isUserLoggedIn() 
    {
        if (isset($_SESSION['user_id'])) 
        {
            return true;
        } 
        return false;
    }
    
    public function getUserId($username) 
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bindValue(1, $username);
        $result = $stmt->execute();
        $user_id = $result->fetchArray(SQLITE3_NUM);
        return $user_id[0];
    }

    public function getUser($user_id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindValue(1, $user_id);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function editUser($user_id, $username, $email, $password) 
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(4, $user_id);
        return $stmt->execute();
    }

    public function deleteUserTrips($user_id) 
    {
        $stmt = $this->db->prepare("DELETE FROM trips WHERE user_id = ?");
        $stmt->bindValue(1, $user_id);
        return $stmt->execute();
    }

    public function deleteUser($user_id) 
    {
        $this->deleteUserTrips($user_id);
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindValue(1, $user_id);
        return $stmt->execute();
    }

    public function createTrip($user_id, $title, $description, $start_date, $end_date, $place) 
    {
        $stmt = $this->db->prepare("INSERT INTO trips (user_id, title, description, start_date, end_date, place) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $user_id);
        $stmt->bindValue(2, $title);
        $stmt->bindValue(3, $description);
        $stmt->bindValue(4, $start_date);
        $stmt->bindValue(5, $end_date);
        $stmt->bindValue(6, $place);
        return $stmt->execute();
    }

    public function getUserTrips($user_id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM trips WHERE user_id = ?");
        $stmt->bindValue(1, $user_id);
        $result = $stmt->execute();
        
        $trips = [];
        while ($trip = $result->fetchArray(SQLITE3_ASSOC)) {
            $trips[] = $trip;
        }
        return $trips;
    }
    
    public function deleteTrip($trip_id) 
    {
        $stmt = $this->db->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->bindValue(1, $trip_id);
        return $stmt->execute();
    }

    public function updateTrip($trip_id, $title, $description, $start_date, $end_date, $place) 
    {
        $stmt = $this->db->prepare("UPDATE trips SET title = ?, description = ?, start_date = ?, end_date = ?, place = ? WHERE id = ?");
        $stmt->bindValue(1, $title);
        $stmt->bindValue(2, $description);
        $stmt->bindValue(3, $start_date);
        $stmt->bindValue(4, $end_date);
        $stmt->bindValue(5, $place);
        $stmt->bindValue(6, $trip_id);
        return $stmt->execute();
    }
}