<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watch extends CI_Controller {

    private $isLogged, $userLogged , $userTo;
    public function __construct()
    {
            parent::__construct();
            $this->load->helper(array('form', 'url','download'));
            $this->load->model('video_model');
            $this->load->model('user_model');
            $this->load->library('session');
            
    }
    

    function index(){
        $userLogged=$this->session->userdata('username')?$this->session->userdata('username'):'';
        $param=$this->input->get('id');
        $videoId=$param;
        $this->video_model->incrementViews($param);
        $video=$this->video_model->getVideo($param);
        $likes=$this->video_model->getLikes($param);
        $dislikes=$this->video_model->getDislikes($param);
        $userTo=$video->uploadedBy;
        $data['filePath'] = $video->filePath;
        $data['title'] = $video->title;
        $data['views'] = $video->views;
        $data['uploadDate'] = $video->uploadDate;
        $data['uploadedBy'] = $userTo;
        $data['userTo'] = $userTo;
        $data['userLogged'] = $userLogged;
        $data['views'] = $video->views;

        $userOwner=$this->user_model->getUserByUsername($video->uploadedBy);
        $picture= $userOwner->profilePic ;
        $data['picture'] = $picture;
       
        if($this->user_model->isSubscribedTo($userTo,$userLogged)){
            $data['textButton'] = 'SUBSCRIBED';
            $data['styleButton'] = 'unsubscribe button';

        }else{
            $data['textButton'] = 'SUBSCRIBE';
            $data['styleButton'] = 'subscribe button';
            


        }
        if($this->video_model->wasDislikedBy($userLogged,$videoId) ){
            $data['dislikeImage'] =  base_url('assets/images/dislike-active.png');
        }else{
            $data['dislikeImage'] = base_url('assets/images/dislike.png');
        }

        if($this->video_model->wasLikedBy($userLogged,$videoId) ){
            $data['likeImage'] =  base_url('assets/images/like-active.png');
        }else{
            $data['likeImage'] = base_url('assets/images/like.png');
        }

        $data['likes'] = $likes->count;
        $data['dislikes'] = $dislikes->count;

        $data['videoId'] = $param;
        
        $comments=$this->video_model->getComments($param);
        $data['totalComments']=sizeof($comments);
        //$this->session->set_flashdata('message',$data);
        if($this->session->userdata('username')){
            $subscriptions=$this->user_model->getSubscriptions($this->session->userdata('username'));
            $this->session->set_userdata('subscriptions',$subscriptions);
            $notification=$this->video_model->getNotification($this->session->userdata('username'));
            $this->session->set_userdata('notification',$notification);$history = array(
                'username' => $this->session->userdata('username'),
                'videoId' =>  $param
             );
            $this->video_model->insert_history($history);
            $data['userLogged']=$this->session->userdata('username');
            $this->load->view('templates/headerLogged',$data);
        }
		else{
			$this->load->view('templates/header');
		}
        $this->load->view('player',$data);

        
        foreach ($comments as $comment){
            $commentId=$comment->id;
            $com['commentLikes'] =$this->video_model->numCommentLiked($commentId) ;
            $com['commentDislikes'] =$this->video_model->numCommentDisliked($commentId) ;
            $com['postedBy'] =$comment->postedBy;
            $com['datePosted'] =$comment->datePosted;
            $com['body'] =$comment->body;
            $com['videoId'] =$videoId;
            $com['userLogged'] =$userLogged;
            $com['commentId'] =$comment->id;
            $userCom=$this->user_model->getUserByUsername($comment->postedBy);
            $com['commentPic'] =$userCom->profilePic;
            $com['pic'] =base_url($this->session->userdata('picture'));

            if($this->video_model->wasCommentDislikedBy($userLogged,$commentId) ){
                $com['commentDislikeImage'] =  base_url('assets/images/dislike-active.png');
            }else{
                $com['commentDislikeImage'] = base_url('assets/images/dislike.png');
            }
    
            if($this->video_model->wasCommentLikedBy($userLogged,$commentId) ){
                $com['commentLikeImage'] =  base_url('assets/images/like-active.png');
            }else{
                $com['commentLikeImage'] = base_url('assets/images/like.png');
            }
            $this->load->view('comment',$com);
        } 

        $videos=$this->video_model->getVideosNotID($videoId);
        $this->load->view('templates/headerSuggestion');
		
		foreach ($videos as $video){
            $this->load->view('search',$video);
        } 
        $this->load->view('templates/footerGridVideo.php');

       // $this->load->view('suggestion',$data);
        //$this->load->view('videoInfo',$data);
            
        $this->load->view('templates/footer');
    }
    public function watchNotification(){
        $param=$this->input->get('id');
        $this->video_model->updateNotification($this->session->userdata('username'));
        redirect(base_url('watch?id='.$param));

    }

    public function likes(){

        
            $videoId = $_POST["videoId"];
            $userLogged = $_POST["userLogged"];
            $data=$this->video_model->like($userLogged,$videoId);
    
            echo $data;
        
       
    }
    public function dislikes(){

        $videoId = $_POST["videoId"];
        $userLogged = $_POST["userLogged"];
        $data=$this->video_model->dislike($userLogged,$videoId);

        echo $data;
    }
    public function subscribe(){
        $userTo = $_POST["userTo"];
        $userLogged = $_POST["userLogged"];
        $data=$this->user_model->subscribe($userTo,$userLogged) ;
        echo $data;
    }
    public function postComment(){

        $postedBy = $_POST["postedBy"];
        $body = $_POST["commentText"];
        $videoId = $_POST["videoId"];
        $responseTo=0;
        $data=$this->video_model->insert_comment($postedBy,$videoId,$responseTo,$body) ;
        echo $data;
    }
    public function likeComment(){

        
        $commentId = $_POST["commentId"];
        $userLogged = $_POST["userLogged"];
        $data=$this->video_model->likeComment($userLogged,$commentId) ;

        echo $data;
    }
    public function dislikeComment(){

        
        $commentId = $_POST["commentId"];
        $userLogged = $_POST["userLogged"];
        $data=$this->video_model->dislikeComment($userLogged,$commentId) ;

        echo $data;
    }

    public function download(){
        $this->load->helper('download');
        $filePath=$_POST["filePath"];
        $ret=force_download( FCPATH.'/'.$filePath, NULL);
        var_dump($ret);
        
    }
    
    
}
