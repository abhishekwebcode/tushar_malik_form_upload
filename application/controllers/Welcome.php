<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_errors",0);
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
	{
		$this->load->view('welcome_message');
	}
	public function upload() {
	    $file_ext=(($_FILES["file"]["name"]));
	    $file_ext=explode(".",$file_ext);
	    $file_ext=end($file_ext);

	    $folder=FCPATH.DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$file_ext.DIRECTORY_SEPARATOR;
	    if (!is_dir($folder)) {
	        mkdir($folder,0777,true);
        }
        $name=$this->generateRandomString(10);
	    $main_file=$folder.DIRECTORY_SEPARATOR.$name.".".$file_ext;
        if (!copy($_FILES["file"]["tmp_name"],$main_file)) {
            echo json_encode(array("success"=>false,"message"=>"Cannot Upload File"));
        }
        echo $main_file;
        $inpu=$_POST;
        unset($inpu["file"]);
        $inpu["file_path"]=$main_file;
        $this->db->insert("form",$inpu);
        echo json_encode(array("success"=>true));

    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
