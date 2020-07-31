<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Insert_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();


    }
	public function addFromVoc(){
		
		$this->db->where('voc_category_id',$this->input->post('voc_category'));
		$query = $this->db->get('voc_category');
		$voc_category_title = $query->row()->voc_category_title;
		$data = array(
			'voc_category_id'		=>	$this->input->post('voc_category'),
			'title'	=>	$voc_category_title,
			'name'	=>	$this->input->post('voc_name'),
			'email'				=> 	$this->input->post('voc_email'),
			'detail'		=>	$this->input->post('voc_detail'),
			'public'	=>	$this->input->post('voc_public'),
            'adate'	=>	date('Y-m-d H:i:s'),
            'ip_address'	=>	get_client_ip(),
			'is_read'	=>	'n'
		);
		$this->db->insert('voc', $data);
		$insert_id = $this->db->insert_id();
		return ($this->db->affected_rows() != 1) ? "false" : "true";
	}
	
	

	public function addFromContact(){
		$data = array(
			'voc_category_id'		=>	'6',
			'title'	=>	"ติดต่อเรา - ".$this->input->post('title'),
			'name'	=>	$this->input->post('name'),
			'email'				=> 	$this->input->post('email'),
			'detail'		=>	$this->input->post('detail'),
			'public'	=>	'n',
            'adate'	=>	date('Y-m-d H:i:s'),
            'ip_address'	=>	get_client_ip(),
			'is_read'	=>	'n'
		);
		$this->db->insert('voc', $data);
		$insert_id = $this->db->insert_id();
		return ($this->db->affected_rows() != 1) ? "false" : "true";
	}
	
    
    public function auditoriumForm(){
        if(!empty($_POST['audio']) != ''){
            $audio = $_POST['audio'];
        }else{
            $audio = "no";
        }
         if(!empty($_POST['notebook']) != ''){
            $notebook = $_POST['notebook'];
        }else{
            $notebook = "no";
        }
         if(!empty($_POST['projector']) != ''){
            $projector = $_POST['projector'];
        }else{
            $projector = "no";
        }
         if(!empty($_POST['wireless_mic']) != ''){
            $wireless_mic = $_POST['wireless_mic'];
        }else{
            $wireless_mic = "no";
        }
         if(!empty($_POST['conference_mic']) != ''){
            $conference_mic = $_POST['conference_mic'];
        }else{
            $conference_mic = "no";
        }
        
		$data = array(
			'name'		=>	$this->input->post('name'),
            'person_type'		=>	$this->input->post('person_type'),
            'department'		=>	$this->input->post('department'),
            'tel'		=>	$this->input->post('tel'),
            'purpose'		=>	$this->input->post('purpose'),
            'title'		=>	$this->input->post('title'),
            'adate'		=>	$this->input->post('adate'),
            'people'		=>	$this->input->post('people'),
            'add_adate' => date('Y-m-d H:i:s'),
            'audio'		=>	$audio,
            'notebook'		=>	$notebook,
            'projector'		=>	$projector,
            'wireless_mic'		=>	$wireless_mic,
            'conference_mic'		=>	$conference_mic,
            'other_device'		=>	$this->input->post('other_device'),
            'note'		=>	$this->input->post('note'),
            'email'		=>	$this->input->post('email')

		);
		$this->db->insert('auditorium', $data);
        $insert_id = $this->db->insert_id();
        notiLineAuditorium('tl57ziCEsw4RGqeA3NgkWH57gXsvXkgl57serekrWLP',$insert_id,"มีการขอใช้ห้องประชุมจากคุณ".$this->input->post('name'));
        //notiLineAuditorium('NamoTXorD52wwNnrWneAzT9UnVcMderzk9pM2TlgrMG',$insert_id,"มีการขอใช้ห้องประชุมจากคุณ".$this->input->post('name'));
		return ($this->db->affected_rows() != 1) ? "false" : "true";
	}
	
	
	
	
}