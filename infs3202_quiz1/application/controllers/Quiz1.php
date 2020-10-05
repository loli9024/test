<?php

/**
 *	Quiz 01, INFS3202/7202, semester 1, 2020 
 *	Student ID: <You Student ID>
 *	Prac Session: <Your Prac Session>	
 */
class Quiz1 extends CI_Controller {

    public function index() {
        $this->load->view('style_sheet');
        $this->load->view('start_quiz');
    }

    /**
     * Load a basic static webpage, including header.php, body.php, and footer.php.
     */
    public function task_a() {
        // START WRITING YOUR CODE HERE

        $this->load->view('style_sheet');
        $this->load->view('header');
        $this->load->view('body');
        $this->load->view('footer');

		// END
    }

    /**
     * Load the required page content in the following two scenarios.
     *
     * Subtask 1. Load only one required page by simply appending the page number to the URL for
	 * task B (i.e., http://localhost/infs3202_quiz1/quiz1/task_b). For example, you will be able to
	 * load the page content of /views/1.php via http://localhost/infs3202_quiz1/quiz1/task_b/1.
	 *
	 * Subtask 2.
	 * Display the hidden text if "true" is provided following the required page number, e.g.,
	 * http://localhost/infs3202_quiz1/quiz1/task_b/1/true. Refer to Figure 4.
	 * Otherwise, the hidden text is invisible by default.
	 *
	 * The hidden text is set as "This is the content to be displayed."
	 *
	 **/
    public function task_b($page_num = NULL, $hidden = False) {
         //Write your code here
        $this->load->view('style_sheet');
        $this->load->view('b_input');
        if($page_num != null){
            if($hidden != null && $hidden == "true"){
                $data['hidden_text'] = 'This is the content to be displayed.';
                $this->load->view($page_num,$data);
            }else{
                $this->load->view($page_num);
            }
        }


        //END

    }
       
        

		

}

?>
