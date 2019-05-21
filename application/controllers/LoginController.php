<?php
class LoginController extends CI_Controller
{
	public function index()
	{
		echo 'on index page of login';
	}
	public function loginPage()
	{
		$this->load->view('LoginView');
	}
	public function saveManufacture()
	{
	    $m_name = $_POST['manufacturer_name_id'];

	    $this->load->model('CarModel');
	    
		$ins_data = array( 
        'M_NAME' =>  $m_name
    	);

		$result = $this->CarModel->save_manufacture($ins_data);

		if($result)
		{
			$this->load->view('LoginView');	

		}


	}
	public function saveModel()
	{
		$ins_data_car = array(
				'MODEL_NAME' => trim($_POST['model_name_id']),
				'MANUFACTURE_ID' => trim($_POST['select_manufact']),
				'COLOR' => trim($_POST['model_color_id']),
				'MODEL_REG' => trim($_POST['model_reg_id']),
				'NOTE' => trim($_POST['model_note_id']),
				'YEAR' => trim($_POST['select_manufact_year'])
		);

		$this->load->model('CarModel');
		$result = $this->CarModel->save_car_model($ins_data_car);
		if($result)
		{
			$this->load->view('CarView');
		}
		
	}
	public function checkDuplicateManufactureName()
	{
		$this->load->model('CarModel');
	    $result = $this->CarModel->toCheckDuplicateName($_POST['m_name']);
	    echo $result;

	}
	public function getManufacturer()
	{
		$this->load->model('CarModel');
	    $result = $this->CarModel->getManufactData();
	    echo json_encode($result);
	    
	}
	public function multipleUploadImage()
	{
		sleep(3);
		if($_FILES["files"]["name"] != "")
		{
				$output = "";
				$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$this->load->library('upload',$config);
				//$this->upload->initializer($config);
				if(count($_FILES["files"]["name"]) > 2)
				{
					$output = '<div class="col-sm-6 col-md-5 col-lg-4 has-error"> <label>Image is not more than two</label></div>';
					echo $output;
				}
				else
				{	
				for($count = 0;$count<count($_FILES["files"]["name"]);$count++)
				{
					$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
					$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
					$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
					$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
					$_FILES["file"]["size"] = $_FILES["files"]["size"][$count]; 

					if($this->upload->do_upload('file'))
					{
						$data = $this->upload->data();
						$output .= '<div class="col-sm-6 col-md-5 col-lg-4"> <img src="'.base_url().'/upload/'.$data['file_name'].'" style="width: 200px;"><input type="hidden" name="'.$data['file_name'].'" value="'.$data['file_name'].'"></div>';
				    
					}
				}

				echo $output;
			}	
		}

	}
	public function showList()
	{

		$this->load->view('CarListView');
	}
	public function showNextModel()
	{
		$this->load->view('CarView');
	}
	public function getCarListData()
	{
		$this->load->model('CarModel');
		$data = $this->CarModel->toGetCarData();
		$output = '';
		$count = 0;
		$output.='
		<div class="table-responsive">
		<table class="table table-bordered">
		<tr>
		<th width="15%">Sr.No</th>
		<th width="15%">Model Name</th>
		<th width="15%">Manufacture Name</th>
		<th width="15%">Action</th>
		</tr>';
       for($i=0;$i<count($data);$i++)
       {
       	   $count = $count + 1;
       	   $output.='<tr>
			<td>'.$count.'</td>
			<td>'.$data[$i]['NAME'].'</td>
			<td>'.$data[$i]['MANUFACT_NAME'].'</td>
			<td><input type="button" id="'.$data[$i]['ID'].'"  name="'.$data[$i]['ID'].'" class="btn btn-primary remove-item" data-color="'.$data[$i]['COLOR'].'" data-reg="'.$data[$i]['MODEL_REG'].'" data-year="'.$data[$i]['YEAR'].'" data-note="'.$data[$i]['NOTE'].'" value="Action"/></td>
			</tr>';
       }
       $output .='
		</table>
		</div>';
       if($count <= 0)
		{
			$output = '<h4 align="center">Data is Empty</h4>';
		}
        echo $output;
		
	}
	public function load()
	{
		echo $this->getCarListData();
	}
	public function removeItem()
	{
		$this->load->model('CarModel');

		$del_id = trim($_POST['row_id']);
		$data = array(
						'FLAG'=>'0');

		$data_output = $this->CarModel->updateCarEntry($del_id,$data);
		if($data_output)
		{
           echo 1;
		}
        else
        {
           echo 0;
        }
	}
}

?>