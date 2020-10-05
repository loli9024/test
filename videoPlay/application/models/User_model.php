<?php

Class User_model extends CI_Model {


 public function getUserByUsername($username){

    $query = $this->db->query("SELECT * FROM user WHERE username = '".$username."'");
    return $query->row();

 }   
// Insert registration data in database
public function registration_insert($data) {

        // Query to check whether username already exist or not
        $condition = "username =" . "'" . $data['username'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

        // Query to insert data in database
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0) {
        return true;
        }
        } else {
        return false;
        }
}

public function editProfile($username,$firstName,$lastName, $email) {

    $this->db->query("UPDATE user SET firstName='".$firstName."', lastName='".$lastName."', email='".$email."'  WHERE username='".$username."'");

}
public function activeUser($username) {

    $this->db->query("UPDATE user SET status=1  WHERE username='".$username."'");

}

public function changePassword($username,$password) {

    $this->db->query("UPDATE user SET password='".$password."' WHERE username='".$username."'");

}

public function updateProfilePic($username,$profilePic){

    $this->db->query("UPDATE user SET profilePic='".$profilePic."' WHERE username='".$username."'");


}

// Read data using username and password
public function login($data) {

        $pw = hash("sha512", $data['password'] );
        log_message('debug', 'Login '.$pw); 

        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $pw . "' AND status=1";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
}


// Read data from database to show data in admin page
    public function read_user_information($username) {

            $condition = "user_name =" . "'" . $username . "'";
            $this->db->select('*');
            $this->db->from('user_login');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        }
    public function viewsByUser($user) {
        $query = $this->db->query("SELECT sum(views) as views FROM video WHERE uploadedBy= '".$user."'");
        
        return $query->row();
    }
  
    public function isSubscribedTo($userTo,$userFrom) {
    $query = $this->db->query("SELECT * FROM subscribers WHERE userTo= '".$userTo."' AND userFrom= '".$userFrom."'");

    return $query->num_rows() > 0;
    }


    public function getSubscriberCount($userTo) {
    $query = $this->db->query("SELECT * FROM subscribers WHERE userTo='".$userTo."'");

    return $query->num_rows();
    }
    public function getSubscriptions($userFrom) {
        $query = $this->db->query("SELECT * FROM subscribers WHERE userFrom='".$userFrom."'");
    
        return $query->result();
    }
    public function getSubscribers($userTo) {
        $query = $this->db->query("SELECT * FROM subscribers WHERE userTo='".$userTo."'");
    
        return $query->result();
    }
    public function insert_notification($notification) {

        $this->db->insert('notification', $notification);
        if ($this->db->affected_rows() > 0) {
        return true;
        }
         else {
        return false;
        }
    }

     

    public function subscribe($userTo,$userFrom) {

    if($this->isSubscribedTo($userTo,$userFrom)) {
        // User has already liked
        $this->db->query("DELETE FROM subscribers WHERE userTo='".$userTo."' AND userFrom='".$userFrom."'");
        
        $result = array(
        "subscribe" => 0
    );
       
    }
    else {
        $this->db->query("INSERT INTO subscribers(userTo, userFrom) VALUES('".$userTo."','".$userFrom."')");
        

        $result = array(
            "subscribe" => 1
        );

    }
    return  1;
    }

}

?>