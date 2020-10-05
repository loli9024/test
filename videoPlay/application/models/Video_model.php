<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Video_model extends CI_Model
{
 
 public function getAllVideos() {

        $this->db->order_by("uploadDate", "ASC");
        $query = $this->db->get("video");
        return $query->result();
     
}
public function getVideosLiked($username){
    

    $query = $this->db->query("SELECT v.* FROM video v, likes l WHERE v.id=l.videoId and l.username= '".$username."'");
    return $query->result();

}
public function getNotification($username){
    

    $query = $this->db->query("SELECT n.* FROM notification n WHERE n.user_to= '".$username."' and n.status=0");
    return $query->result();

}

public function updateNotification($username) {

    $this->db->query("UPDATE notification SET status=1  WHERE user_to='".$username."'");

}
public function getVideosHistory($username){
    

    $query = $this->db->query("SELECT v.*, h.date FROM video v, history h WHERE v.id=h.videoId and h.username= '".$username."' order by h.date desc");
    return $query->result();

}
public function getVideosSubscription($username){
    

    $query = $this->db->query("SELECT v.* FROM video v, subscribers s WHERE s.userTo=v.uploadedBy and s.userFrom= '".$username."' order by v.uploadDate asc");
    return $query->result();

}
public function getVideosNotID($id){
    

    $query = $this->db->query("SELECT * FROM video WHERE id <> ".$id);
    return $query->result();

}

function fetch_category() {

    $this->db->order_by("name", "ASC");
    $query = $this->db->get("category");
    return $query->result();
 
}



 public function insert_video($data) {

    $this->db->insert('video', $data);
    
    return $this->db->insert_id();
    
}
public function insert_history($data) {

    $this->db->insert('history', $data);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
     else {
    return false;
    }
}
public function playVideo($videoId){

        $this->incrementViews($videoId);
        $video=$this->getVideo($videoId);
        $likes=$this->getLikes($videoId);
        $dislikes=$this->getDislikes($videoId);
        
        $data['filePath'] = $video->filePath;
        $data['title'] = $video->title;
        $data['views'] = $video->views;
        $data['likes'] = $likes->count;
        $data['dislikes'] = $dislikes->count;

        return $data;

}
public function userLike($username,$videoId){

    
        $wasLikedBy=$this->wasLikedBy($username,$videoId);
        $wasDislikedBy=$this->wasDislikedBy($username,$videoId);
        $data['wasLikedBy'] = $wasLikedBy;
        $data['wasDislikedBy'] = $wasDislikedBy;
    

    return $data;

}
public function getVideo($id){
    

    $query = $this->db->query("SELECT * FROM video WHERE id = ".$id);
    return $query->row();

}

public function getVideoByUser($user){
    

    $query = $this->db->query("SELECT * FROM video WHERE uploadedBy = '".$user."'");
    return $query->result();

}

public function searchVideos($search){
    
     $query = $this->db->query("SELECT * FROM video WHERE title LIKE CONCAT('%', '".$search
    ."','%') OR uploadedBy LIKE CONCAT('%', '".$search."', '%') ORDER BY views DESC");
    

    return $query->result();

}


public function getLikes($videoId) {
    
    $query = $this->db->query("SELECT count(*) as 'count' FROM likes WHERE videoId =". $videoId);

    return $query->row();
}

public function getDislikes($videoId) {
    
    $query = $this->db->query("SELECT count(*) as 'count' FROM dislikes WHERE videoId =". $videoId);

    return $query->row();
}

public function incrementViews($id) {

    $this->db->query("UPDATE video SET views=views+1 WHERE id=".$id);

}

public function wasLikedBy($username,$videoId) {
    $query = $this->db->query("SELECT * FROM likes WHERE username= '".$username."' AND videoId=".$videoId);
    
    return $query->num_rows() > 0;
}

public function wasDislikedBy($username,$videoId) {
    $query = $this->db->query("SELECT * FROM dislikes WHERE username= '".$username."' AND videoId=".$videoId);
    
    return $query->num_rows() > 0;
}

public function like($username,$videoId) {
    
    if($this->wasLikedBy($username,$videoId)) {
        // User has already liked
      $this->db->query("DELETE FROM likes WHERE username= '".$username."' AND videoId=".$videoId);

      $result = array(
        "likes" => -1,
        "dislikes" => 0
    );
    return  json_encode($result);
       
    }
    else {
        $this->db->query("DELETE FROM dislikes WHERE username= '".$username."' AND videoId=".$videoId);
        $count = $this->db->affected_rows();
        $this->db->query("INSERT INTO likes(username, videoId) VALUES('".$username."', ".$videoId.")");
        

        $result = array(
            "likes" => 1,
            "dislikes" => 0 - $count
        );
    return  json_encode($result);
    }
}


public function dislike($username,$videoId) {
    
    if($this->wasDislikedBy($username,$videoId)) {
        // User has already liked
      $this->db->query("DELETE FROM dislikes WHERE username= '".$username."' AND videoId=".$videoId);

      $result = array(
        "likes" => 0,
        "dislikes" => -1
    );
    return  json_encode($result);
       
    }
    else {
        $this->db->query("DELETE FROM likes WHERE username= '".$username."' AND videoId=".$videoId);
        $count = $this->db->affected_rows();
        
        $this->db->query("INSERT INTO dislikes(username, videoId) VALUES('".$username."', ".$videoId.")");
        

        $result = array(
            "likes" => 0 - $count,
            "dislikes" => 1
        );
    return  json_encode($result);
    }
}


public function getComments($videoId) {
    $query = $this->db->query("SELECT * FROM comment WHERE videoId=".$videoId." AND responseTo=0 ORDER BY datePosted DESC");
    

    return $query->result();
}

public function insert_comment($postedBy,$videoId,$responseTo,$body){

    $query=$this->db->query("INSERT INTO comment(postedBy, videoId, responseTo, body)
                            VALUES('".$postedBy."', ".$videoId.", ".$responseTo.", '".$body."')");
   
   return $this->db->insert_id();

}

public function wasCommentLikedBy($username,$commentId) {
    $query = $this->db->query("SELECT * FROM likes WHERE username='".$username."' AND commentId=".$commentId);

    return $query->num_rows() > 0;
}
public function wasCommentDislikedBy($username,$commentId) {
    $query = $this->db->query("SELECT * FROM dislikes WHERE username='".$username."' AND commentId=".$commentId);

    return $query->num_rows() > 0;
}
public function numCommentLiked($commentId) {
    $query = $this->db->query("SELECT * FROM likes WHERE commentId=".$commentId);

    return $query->num_rows() ;
}
public function numCommentDisliked($commentId) {
    $query = $this->db->query("SELECT * FROM dislikes WHERE commentId=".$commentId);

    return $query->num_rows() ;
}

public function likeComment($username,$commentId) {
    
    if($this->wasCommentLikedBy($username,$commentId)) {
        // User has already liked
      $this->db->query("DELETE FROM likes WHERE username= '".$username."' AND commentId=".$commentId);
      $count = $this->db->affected_rows();
      
    return  -$count;
       
    }
    else {
        $this->db->query("DELETE FROM dislikes WHERE username= '".$username."' AND commentId=".$commentId);
        $this->db->query("INSERT INTO likes(username, commentId) VALUES('".$username."', ".$commentId.")");
        

        
    return  1;
    }
}
public function dislikeComment($username,$commentId) {
    
    if($this->wasCommentDislikedBy($username,$commentId)) {
        // User has already liked
      $this->db->query("DELETE FROM dislikes WHERE username= '".$username."' AND commentId=".$commentId);
      $count = $this->db->affected_rows();
      
    return  -$count;
       
    }
    else {
        $this->db->query("DELETE FROM likes WHERE username= '".$username."' AND commentId=".$commentId);
        $this->db->query("INSERT INTO dislikes(username, commentId) VALUES('".$username."', ".$commentId.")");
        

        
    return  1;
    }
}
 
/**
* get chart data
*/
function get_chart_data_for_views($username, $start_date, $end_date) {
    $sql = 'SELECT count(1) total_visits, DATE(h.date) day_date
        FROM history h,video v
        WHERE DATE(h.date) >= ' . $this->db->escape($start_date) . ' 
        AND DATE(h.date) <= ' . $this->db->escape($end_date) . ' 
        AND h.videoId=v.id AND v.uploadedBy ="'.$username.'"  
        GROUP BY DATE(date) ORDER BY DATE(date) DESC';
    
    $query = $this->db->query($sql);
    
    if ($query->num_rows() > 0) {
        $data = array();
        
        foreach ($query->result_array() as $key => $value) {
            $data[$key]['label'] = $value['day_date'];
            $data[$key]['value'] = $value['total_visits'];
        }
        
        return $data;
    }
    return NULL;
}


function fetch_data($query)
 {
  $this->db->like('title', $query);
  $query = $this->db->get('video');
  if($query->num_rows() > 0)
  {
   foreach($query->result_array() as $row)
   {
    $output[] = array(
     'title'  => $row["title"]
    );
   }
   echo json_encode($output);
  }
 }

}




?>