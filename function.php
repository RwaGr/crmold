<?php

class pdv_var {
 //USER VARS
	private $id;
	private $name;
	private $lastname;
    private $email;
    private $rol;
    private $pass;
    private $result;
    private $key;
	private $last_log;
	private $user_img;
	private $cargo;
	private $rut;
	private $department;
	private $phone;
	private $description;
	private $sex;
	private $fec_nac;
	private $commission;
	private $totalcommission;
	
	/*message */
	private $msgid;
	private $msgfrom;
	private $msgto;
	private $msgsubject;
	private $msgcontent;
	private $msgstatus;
	private $msgdate;
	private $msgresult;
	private $msgfromuser;
	private $msgimguser;
	private $msglastname;
	private $msglocation;
	private $rowcount;
	private $touser;
	private $fromuser;

	//companies
	private $companyname;
	private $industry;
	private $currency;
	private $rf;
	private $quant;
	private $notes;
	private $responsable;
	private $address;
	private $companyimg;
	private $website;
	private $companyidvar;
	private $addeddate;
	

	//CONTACTS
	private $namecontact;
	private $lastnamecontact;
	private $sexcontact;
	private $emailcontact;
	private $phonecontact;
	private $birthdaycontact;
	private $notescontact;
	private $companycontact;
	private $chargecontact;
	private $imgcontact;
	private $addedby;
	private $assignto;
	private $added_date;
	private $contactid;



	//PRODUCTS
	private $productname;
	private $productid;
	private $productstatus;
	private $productquantity;
	private $producthas_quant;
	private $critical_quant;
	private $productprice;
	private $productunit;
	private $productdescription;
	private $productimg;
	private $productassignto;
	private $productcategory;
	
	//SOCIAL 
	private $contactemail;
	private $social_name;
	private $social_content;
	private $contact_id_var;
	private $social_id;

	//CATEGORIES
	private $catid;
	private $catid1;	
	private $catname;
	private $catdescrip;
	private $cattype;
	private $catparent;


	//meta
	private $metaid;
	private $metatitle;
	private $metavalue;
	private $metatype;


	//prospects
	private $contact_prospect;
	private $responsable_prospectname;
	private $responsable_prospectlastname;
	private $status_prospect;
	private $creation_date_prospect;
	private $has_tasks_prospect;
	private $prospectid;
	private $prospectnotes;
	private $priceafterdis;
	private $totalprice;
	private $has_cuotes;
	private $lastmod_date;

	//tasks
	private $taskname;
	private $taskdescrip;
	private $taskdate;
	private $tasklimitdate;
	private $tasktype;
	private $taskasocprospect;
	private $taskid;
	private $isprivate;
	private $customtask;
	private $priority;
	private $taskasocuser;
					

	//pp2
	private $pp2_productid;
	private $pp2_discount;
	private $pp2_quantity;
	private $pp2_priceafter;
	private $pp2id;
	private $currentprice;

	//pp3
	private $pp3_productid;
	private $pp3_discount;
	private $pp3_quantity;
	private $pp3_priceafter;
	private $pp3id;
	private $priceofthecuote;


	//cuotes
	private $totalcuote;
	private $cuotesid;
	private $cuotedate;
	private $prospect;
	private $cuotename;
	private $cuotelastname;
	private $succeeded;

	//sales
	private $salesid;
	private $salesprospectid;
	private $salescuoteid;
	private $salesdate;

	//guests
	private $id_user;
	private $guestsid;
	private $id_task;
	private $invitationdate;




	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}


class consulta
{
	private $pdo;

	public function __CONSTRUCT()
	{
       require 'config.php';
    
		try
		{
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);          
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function select() {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pdv_users WHERE id <> ".$_GET['activeuser']."");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new pdv_var();

				$alm->__SET('id', $r->id);
				$alm->__SET('name', $r->pdv_name);
				$alm->__SET('lastname', $r->pdv_lastname);
                $alm->__SET('email', $r->pdv_email);
                
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
	
	


	public function selectall() {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pdv_users");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new pdv_var();

				$alm->__SET('id', $r->id);
				$alm->__SET('name', $r->pdv_name);
				$alm->__SET('lastname', $r->pdv_lastname);
                $alm->__SET('email', $r->pdv_email);
				$alm->__SET('fec_nac', $r->fec_nac);
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
    

	public function getcompanies() {
		try
		{
			$result = array();

			if (isset($_GET['idcompany'])){
				
	$stm = $this->pdo->prepare("SELECT * FROM pdv_companies WHERE id='".$_GET['idcompany']."'");		
				
				} else {
				
	$stm = $this->pdo->prepare("SELECT * FROM pdv_companies");	
				
				}
		//	$stm = $this->pdo->prepare("SELECT * FROM pdv_companies");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm1 = new pdv_var();

				$alm1->__SET('id', $r->id);
				$alm1->__SET('name', $r->name);
				$alm1->__SET('industry', $r->industry);
				$alm1->__SET('currency', $r->currency);
				$alm1->__SET('rf', $r->rf);
				$alm1->__SET('quant', $r->quant_employ);
				$alm1->__SET('notes', $r->notes);
				$alm1->__SET('responsable', $r->responsable);
				$alm1->__SET('address', $r->address);
				$alm1->__SET('addedby', $r->addedby);
				$alm1->__SET('companyimg', $r->companyimg);
				$alm1->__SET('addeddate', $r->addeddate);
				$alm1->__SET('website', $r->website);
				
				$result[] = $alm1;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
    


public function getdata($id) //from email to check users
	{
		try {
        $stm = $this->pdo->prepare("SELECT * FROM pdv_users WHERE pdv_email = ?");
            $stm->execute(array($id));  
            $row_count = $stm->rowCount();
if($row_count > 0){

            $r = $stm->fetch(PDO::FETCH_OBJ);
			$alm = new pdv_var();

            $alm->__SET('id', $r->id);
            $alm->__SET('name', $r->pdv_name);
            $alm->__SET('lastname', $r->pdv_lastname);
            $alm->__SET('email', $r->pdv_email);
            $alm->__SET('rol', $r->pdv_rol);
            $alm->__SET('pass', $r->pdv_password);
			$alm->__SET('result', "OK");
			$alm->__SET('department', $r->department);
			$alm->__SET('phone', $r->pdv_phone);
			$alm->__SET('commission', $r->commission);

            return $alm;           
  } else {

$alm = new pdv_var();
$alm->__SET('result', "NO");
return $alm;

     } 

		} catch (Exception $e) {
			die($e->getMessage());
		}
    }
    


public function getdatabyid($id) { //get data by id from header to get the full info 
		try {
		
        $stm = $this->pdo->prepare("SELECT * FROM pdv_users WHERE id = ?");
            $stm->execute(array($id));  
            $row_count = $stm->rowCount();

if($row_count > 0){

            $r = $stm->fetch(PDO::FETCH_OBJ);        
			$alm = new pdv_var();
            $alm->__SET('id', $r->id);
            $alm->__SET('name', $r->pdv_name);
            $alm->__SET('lastname', $r->pdv_lastname);
            $alm->__SET('email', $r->pdv_email);
            $alm->__SET('rol', $r->pdv_rol);
            $alm->__SET('pass', $r->pdv_password);
			$alm->__SET('key', $r->key_sec);
			$alm->__SET('user_img', $r->user_img);
			$alm->__SET('cargo', $r->user_cargo);
			$alm->__SET('rut', $r->user_rut);
			$alm->__SET('department', $r->department);
			$alm->__SET('phone', $r->pdv_phone);
			$alm->__SET('sex', $r->pdv_sex);
			$alm->__SET('description', $r->pdv_description);
			$alm->__SET('fec_nac', $r->fec_nac);
			$alm->__SET('commission', $r->commission);


            return $alm;
            
  } else {

$alm = new pdv_var();
$alm->__SET('result', "NO");
return $alm;

     } 

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}






/* Cambio imagen de perfil */
	public function changeimg(pdv_var $data)
	{
		try 
		{
			$sql = "UPDATE pdv_users SET 
					user_img = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)->execute(
				array(
					$data->__GET('user_img'), 
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
    }




	public function update(pdv_var $data)
	{
		try 
		{
			$sql = "UPDATE pdv_users SET 
						pdv_name          = ?, 
						pdv_lastname        = ?,
						user_rut        = ?,
						department      =?,
						user_cargo        = ?,
						pdv_rol        = ?,
						pdv_email            = ?, 
						pdv_phone        = ?,						
						pdv_sex        = ?,
						pdv_description        = ?,
						fec_nac		   = ?
		
				    WHERE id = ?";

			$this->pdo->prepare($sql)->execute(
				array(
					$data->__GET('name'), 
					$data->__GET('lastname'), 
					$data->__GET('rut'),				
					$data->__GET('department'),
					$data->__GET('cargo'), 
					$data->__GET('rol'), 
					$data->__GET('email'),
					$data->__GET('phone'),
					$data->__GET('sex'),
					$data->__GET('description'),
					$data->__GET('fec_nac'),
					$data->__GET('id')

					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
    }
    


	public function login (pdv_var $data)
	{
		try 
		{
			$sql = "UPDATE pdv_users SET 						
						key_sec = ?,
                        last_log = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)->execute(
				array(
                    $data->__GET('key'),
                    $data->__GET('last_log'),
                    $data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function logout (pdv_var $data)
	{
		try 
		{
			$sql = "UPDATE pdv_users SET 						
						key_sec = ?          
				    WHERE id = ?";

			$this->pdo->prepare($sql)->execute(
				array(
                    $data->__GET('key'),
                    $data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


/*update the status of the selected message */


public function updatemsgstatustobyid($id) {
	try
	{
		$result = array();

		$idselected = $_GET['selectedid'];

//update read message
		$sql1 = "UPDATE pdv_msg SET 
		status = '1'
		WHERE to_user = '".$id."' and from_user = '".$idselected."'";

$this->pdo->prepare($sql1)->execute();
}
catch(Exception $e)
{
	die($e->getMessage());
}

}



public function deletemsg($id) {
	try
	{
		$result = array();

		$idselected = $_GET['activeuser'];

//trash
		$sql144 = "UPDATE pdv_msg SET 
		fromuser = 'trash'
		WHERE to_user = '".$id."' and from_user = '".$idselected."' and fromuser<>'1'";

$this->pdo->prepare($sql144)->execute();




$sql126 = "UPDATE pdv_msg SET 
fromuser = 'trash'
WHERE to_user = '".$idselected."' and from_user = '".$id."' and fromuser<>'1'";

$this->pdo->prepare($sql126)->execute();


//for only one part

$sql1 = "UPDATE pdv_msg SET 
fromuser = '".$idselected."'
WHERE to_user = '".$id."' and from_user = '".$idselected."' and fromuser='1'";

$this->pdo->prepare($sql1)->execute();




$sql12 = "UPDATE pdv_msg SET 
fromuser = '".$idselected."'
WHERE to_user = '".$idselected."' and from_user = '".$id."' and fromuser='1'";

$this->pdo->prepare($sql12)->execute();


}
catch(Exception $e)
{
	die($e->getMessage());
}


}



/* get the selected message */
	public function getonemsgbyid($id) {
		try
		{
			$result = array();

			$idselected = $_GET['selectedid'];

// GET THE INFO OF THE MESSAGE

	$stm = $this->pdo->prepare("SELECT * FROM pdv_users INNER JOIN pdv_msg ON pdv_msg.from_user = pdv_users.id WHERE pdv_msg.to_user IN ('".$id."', '".$idselected."') and pdv_msg.from_user IN ('".$id."','".$idselected."') and (pdv_msg.fromuser <> '".$_GET['activeuser']."' and pdv_msg.fromuser <> 'trash')   ORDER BY pdv_msg.id");
	


		/*	SELECT * FROM pdv_users INNER JOIN pdv_msg ON pdv_msg.from_user = pdv_users.id WHERE pdv_msg.to_user IN ('5','7') and pdv_msg.from_user IN ('5','7') ORDER BY pdv_msg.id*/
			
			$stm->execute(array($id));  

			

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new pdv_var();

				$alm->__SET('msgid', $r->id);
				$alm->__SET('msgfrom', $r->from_user);
				$alm->__SET('msgto', $r->to_user);
				$alm->__SET('msgsubject', $r->subject);
				$alm->__SET('msgcontent', $r->content);
				$alm->__SET('msgstatus', $r->status);
				$alm->__SET('msgdate', $r->date);
				$alm->__SET('msgfromuser', $r->pdv_name);
				$alm->__SET('msglastname', $r->pdv_lastname);
				$alm->__SET('msgimguser', $r->user_img);
				$alm->__SET('fromuser', $r->fromuser);
				$alm->__SET('touser', $r->touser);



				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}



    }



/*Get messages count */
public function getmsgscount($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM pdv_users INNER JOIN pdv_msg ON pdv_msg.from_user = pdv_users.id WHERE pdv_msg.to_user = ? and pdv_msg.location='received' and pdv_msg.status='2' and pdv_msg.fromuser <> 'trash'  GROUP BY pdv_msg.from_user");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$alm1 = new pdv_var();
			$alm1->__SET('rowcount', $row_count);
		
            return $alm1;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/*Get SENT messages */
public function getmsgsent($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM pdv_msg INNER JOIN pdv_users ON pdv_users.id = pdv_msg.to_user WHERE pdv_msg.id IN (SELECT MAX(pdv_msg.id) from pdv_msg WHERE pdv_msg.from_user = ? GROUP BY pdv_msg.to_user) and (pdv_msg.fromuser <> '".$_GET['activeuser']."' and pdv_msg.fromuser <> 'trash')   ORDER BY pdv_msg.id DESC");
		$stm->execute(array($id));  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$alm = new pdv_var();

			$alm->__SET('msgid', $r->id);
			$alm->__SET('msgfrom', $r->from_user);
			$alm->__SET('msgto', $r->to_user);
			$alm->__SET('msgsubject', $r->subject);
			$alm->__SET('msgcontent', $r->content);
			$alm->__SET('msgstatus', $r->status);
			$alm->__SET('msgdate', $r->date);
			$alm->__SET('msgfromuser', $r->pdv_name);
			$alm->__SET('msglastname', $r->pdv_lastname);
			$alm->__SET('msgimguser', $r->user_img);
			$alm->__SET('fromuser', $r->fromuser);
			
			$result[] = $alm;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}




/*Get received messages */
	public function getmsgbyid($id) {
		try
		{
			$result = array();

			
			$stm = $this->pdo->prepare("SELECT * FROM pdv_msg INNER JOIN pdv_users ON pdv_users.id = pdv_msg.from_user WHERE pdv_msg.id IN (SELECT MAX(pdv_msg.id) from pdv_msg WHERE (pdv_msg.to_user = ?) GROUP BY pdv_msg.from_user) and (pdv_msg.fromuser <> '".$_GET['activeuser']."' and pdv_msg.fromuser <> 'trash')   ORDER BY pdv_msg.id DESC");
			
			
			
			$stm->execute(array($id));  

			

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new pdv_var();

				$alm->__SET('msgid', $r->id);
				$alm->__SET('msgfrom', $r->from_user);
				$alm->__SET('msgto', $r->to_user);
				$alm->__SET('msgsubject', $r->subject);
				$alm->__SET('msgcontent', $r->content);
				$alm->__SET('msgstatus', $r->status);
				$alm->__SET('msgdate', $r->date);
				$alm->__SET('msgfromuser', $r->pdv_name);
				$alm->__SET('msglastname', $r->pdv_lastname);
				$alm->__SET('msgimguser', $r->user_img);
				$alm->__SET('fromuser', $r->fromuser);
				$alm->__SET('touser', $r->touser);
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }



/*Get trashed messages */
public function getmsgbyidtrash($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM pdv_msg INNER JOIN pdv_users ON pdv_users.id = pdv_msg.from_user WHERE pdv_msg.id IN (SELECT MAX(pdv_msg.id) from pdv_msg WHERE pdv_msg.to_user = ? and pdv_msg.fromuser ='0' GROUP BY pdv_msg.from_user)  ORDER BY pdv_msg.id DESC");
		$stm->execute(array($id));  

		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$alm = new pdv_var();

			$alm->__SET('msgid', $r->id);
			$alm->__SET('msgfrom', $r->from_user);
			$alm->__SET('msgto', $r->to_user);
			$alm->__SET('msgsubject', $r->subject);
			$alm->__SET('msgcontent', $r->content);
			$alm->__SET('msgstatus', $r->status);
			$alm->__SET('msgdate', $r->date);
			$alm->__SET('msgfromuser', $r->pdv_name);
			$alm->__SET('msglastname', $r->pdv_lastname);
			$alm->__SET('msgimguser', $r->user_img);

			$result[] = $alm;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}




	/* send new message */
	public function sendmsgfromchat(pdv_var $data)
	{

		try 
		{
		$sql = "INSERT INTO pdv_msg (from_user, to_user, subject, content, status, location, fromuser, touser) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('msgfromuser'), 
                $data->__GET('msgto'), 
                $data->__GET('msgsubject'),
				$data->__GET('msgcontent'),
				$data->__GET('msgstatus'), 
				$data->__GET('msglocation'),
				$data->__GET('fromuser'), 
                $data->__GET('touser')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}




	/* ADD NEW COMPANY */
	public function addcompany(pdv_var $data)
	{

		try 
		{
		$sql = "INSERT INTO pdv_companies (name, industry, currency, rf, quant_employ, notes, responsable, address, addedby, addeddate, companyimg, website ) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('name'), 
                $data->__GET('industry'), 
                $data->__GET('currency'),
				$data->__GET('rf'),
				$data->__GET('quant'), 
				$data->__GET('notes'), 
				$data->__GET('responsable'),
				$data->__GET('address'),
				$data->__GET('addedby'),
				$data->__GET('addeddate'),
				$data->__GET('companyimg'),
				$data->__GET('website')
				
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

/*ADD CONTACT*/
	public function addcontact(pdv_var $data)
	{

		try 
		{
		$sql = "INSERT INTO pdv_contact (name, lastname, sex, email, phone, birthday, notes, company, cargo, imgcontact, addedby, added_date) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('namecontact'), 
                $data->__GET('lastnamecontact'), 
                $data->__GET('sexcontact'),
				$data->__GET('emailcontact'),
				$data->__GET('phonecontact'), 
				$data->__GET('birthdaycontact'),
				$data->__GET('notescontact'),
				$data->__GET('companycontact'), 
				$data->__GET('chargecontact'),
				$data->__GET('imgcontact'),
				$data->__GET('addedby'),
				$data->__GET('added_date')
				
				

				)
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}



/*Get contacts list and data */
public function getcontacts() {
	try
	{
		$result = array();

if (isset($_GET['idcontact'])){
		$stm = $this->pdo->prepare("SELECT pdv_contact.`id`, pdv_contact.`name`, pdv_contact.`lastname`, pdv_contact.`sex`, pdv_contact.`email`, pdv_contact.`phone`, pdv_contact.`birthday`, pdv_contact.`notes`, pdv_contact.`company`, pdv_contact.`cargo`, pdv_contact.`imgcontact`, pdv_contact.`addedby`, pdv_contact.`assignto`, pdv_companies.name as namecompany, pdv_companies.responsable FROM pdv_contact INNER JOIN pdv_companies ON pdv_companies.id=pdv_contact.company WHERE pdv_contact.id='".$_GET['idcontact']."' ORDER BY pdv_contact.id");
} else {
$stm = $this->pdo->prepare("SELECT pdv_contact.`id`, pdv_contact.`name`, pdv_contact.`lastname`, pdv_contact.`sex`, pdv_contact.`email`, pdv_contact.`phone`, pdv_contact.`birthday`, pdv_contact.`notes`, pdv_contact.`company`, pdv_contact.`cargo`, pdv_contact.`imgcontact`, pdv_contact.`addedby`, pdv_contact.`assignto`, pdv_companies.name as namecompany, pdv_companies.responsable FROM pdv_contact INNER JOIN pdv_companies ON pdv_companies.id=pdv_contact.company ORDER BY pdv_contact.id");
}
		$stm->execute(array());  
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$alm_contact = new pdv_var();

			$alm_contact->__SET('id', $r->id);
			$alm_contact->__SET('namecontact', $r->name);
			$alm_contact->__SET('lastnamecontact', $r->lastname);
			$alm_contact->__SET('sexcontact', $r->sex);
			$alm_contact->__SET('emailcontact', $r->email);
			$alm_contact->__SET('phonecontact', $r->phone);
			$alm_contact->__SET('birthdaycontact', $r->birthday);
			$alm_contact->__SET('notescontact', $r->notes);
			$alm_contact->__SET('companycontact', $r->namecompany);
			$alm_contact->__SET('chargecontact', $r->cargo);
			$alm_contact->__SET('imgcontact', $r->imgcontact);
			$alm_contact->__SET('addedby', $r->addedby);
			$alm_contact->__SET('assignto', $r->assignto);
			$alm_contact->__SET('responsable', $r->responsable);

			$result[] = $alm_contact;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}




//get social for every users
public function getsocial($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM pdv_social WHERE contact_id = ?");
		$stm->execute(array($id));  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rsn)
		{
			$almsn = new pdv_var();

			$almsn->__SET('contact_id_var', $rsn->contact_id);
			$almsn->__SET('social_content', $rsn->social_content);
			$almsn->__SET('social_name', $rsn->social_name);
			$almsn->__SET('social_id', $rsn->id);
		
			$result[] = $almsn;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/* ADD social */
public function addsocial(pdv_var $datas)
{

	try 
	{
	$sql1 = "INSERT INTO pdv_social (social_content, social_name, contact_id, contact_company ) 
			VALUES (?, ?, ?, ?)";

	$this->pdo->prepare($sql1)
		 ->execute(
		array(
		/*	$datas->__GET('contactemail'), */
			$datas->__GET('social_content'), 
			$datas->__GET('social_name'),
			$datas->__GET('contact_id_var'),
			$datas->__GET('companycontact')

			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/*Delete social*/
	public function deletesocial($id)	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM pdv_social WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


/*Update social*/
public function updatesocial(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_social SET 
				social_content = ?,
				contact_company = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('social_content'), 
				$data->__GET('companycontact'),
				$data->__GET('id')
				
				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}
	


/*Get companies count */
public function getcompaniescount($id) {
	try
	{
		$result = array();


		$stm = $this->pdo->prepare("SELECT * FROM pdv_companies WHERE name = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almrc = new pdv_var();
			$almrc->__SET('rowcount', $row_count);
		
            return $almrc;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/*Get contact name */
public function getusername($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT pdv_name, pdv_lastname FROM pdv_users WHERE id = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almname = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rname){
			
			$almname->__SET('name', $rname->pdv_name);
			$almname->__SET('lastname', $rname->pdv_lastname);
			

	}
			$almname->__SET('rowcount', $row_count);
		
            return $almname;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}



/*Get contacts count */
public function getcontactscount($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_contact WHERE email = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almrcc = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rrcc){
			
			$almrcc->__SET('id', $rrcc->id);

	}
			$almrcc->__SET('rowcount', $row_count);
		
            return $almrcc;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/*Get contacts count */
public function checkrut($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id, name FROM pdv_companies WHERE rf = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almrf = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rrf){
			
				$almrf->__SET('id', $rrf->id);
				$almrf->__SET('name', $rrf->name);
				

	}
				$almrf->__SET('rowcount', $row_count);
		
            return $almrf;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/*Get company id */
public function getcompanyid($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_companies WHERE name = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almcomp = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcomp){
			
				$almcomp->__SET('id', $rcomp->id);

	}
	$almcomp->__SET('rowcount', $row_count);
		
            return $almcomp;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}



/* delete a contact */
public function deletecontact($id)	{
	try 
	{

		$stm1 = $this->pdo->prepare("DELETE FROM pdv_social WHERE contact_id = ? ");			          
		
		$stm1->execute(array($id));

		$stm = $this->pdo->prepare("DELETE FROM pdv_contact WHERE id = ? ");			          

		$stm->execute(array($id));


	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* Update a contact*/
public function updatecontact(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_contact SET 
				name = ?,
				lastname = ?,
				sex = ?,
				email = ?,
				phone = ?,
				birthday = ?,
				notes = ?,
				company = ?,
				cargo = ?,
				imgcontact = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('namecontact'), 
				$data->__GET('lastnamecontact'), 
				$data->__GET('sexcontact'), 
				$data->__GET('emailcontact'), 
				$data->__GET('phonecontact'), 
				$data->__GET('birthdaycontact'), 
				$data->__GET('notescontact'), 
				$data->__GET('companycontact'), 
				$data->__GET('chargecontact'), 
				$data->__GET('imgcontact'), 
				$data->__GET('id')
			
				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/*Delete a company and employees from that company*/
public function deletecompany($id)	{
	try 
	{
		

		$stmcontacts = $this->pdo
		->prepare("DELETE FROM pdv_contact WHERE company = ?");			          

		$stmcontacts->execute(array($id));	

		$stmsocial = $this->pdo
		->prepare("DELETE FROM pdv_social WHERE contact_company = ?");			          

		$stmsocial->execute(array($id));	

		$stm123 = $this->pdo
		->prepare("DELETE FROM pdv_companies WHERE id = ?");			          

$stm123->execute(array($id));

	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/* Update a company*/
public function updatecompany(pdv_var $data)
{
	try 
	{
		
				$sql = "UPDATE pdv_companies SET 
				name = ?,
				industry = ?,
				rf = ?,
				quant_employ = ?,
				notes = ?,
				responsable = ?,
				address = ?,
				companyimg = ?,
				website = ?
				WHERE id = ? ";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('companyname'), 
				$data->__GET('industry'), 
				$data->__GET('rf'), 
				$data->__GET('quant'), 
				$data->__GET('notes'), 
				$data->__GET('responsable'), 
				$data->__GET('address'), 
				$data->__GET('companyimg'), 
				$data->__GET('website'), 
				$data->__GET('companyidvar')


				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/*Get product by catid */

public function getproductbycatid() {
	try
	{
		$result = array();


			
$stm = $this->pdo->prepare("SELECT pdv_products.id, pdv_products.status, pdv_products.name, pdv_products.quantity, pdv_products.has_quant, pdv_products.price, pdv_products.unit, pdv_products.description, pdv_categories.name as 'category', pdv_products.product_img, pdv_products.assignto, pdv_products.critical_quant FROM pdv_products INNER JOIN pdv_categories ON pdv_categories.id = pdv_products.category WHERE pdv_categories.id = '".$_GET['idcategory']."'");	
			

		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rproduct)
		{
			$almproduct = new pdv_var();


			$almproduct->__SET('productname', $rproduct->name);
			$almproduct->__SET('productid', $rproduct->id);
			$almproduct->__SET('productstatus', $rproduct->status);
			$almproduct->__SET('productquantity', $rproduct->quantity);
			$almproduct->__SET('producthas_quant', $rproduct->has_quant);
			$almproduct->__SET('productprice', $rproduct->price);
			$almproduct->__SET('productunit', $rproduct->unit);
			$almproduct->__SET('productdescription', $rproduct->description);
			$almproduct->__SET('productimg', $rproduct->product_img);
			$almproduct->__SET('productassignto', $rproduct->assignto);
			$almproduct->__SET('productcategory', $rproduct->category);
			$almproduct->__SET('critical_quant', $rproduct->critical_quant);

			$result[] = $almproduct;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

/*get products*/
public function getproducts() {
	try
	{
		$result = array();

		if (isset($_GET['idproduct'])){
			
$stm = $this->pdo->prepare("SELECT pdv_products.id, pdv_products.status, pdv_products.name, pdv_products.quantity, pdv_products.has_quant, pdv_products.price, pdv_products.unit, pdv_products.description, pdv_categories.name as 'category', pdv_products.product_img, pdv_products.assignto, pdv_products.critical_quant FROM pdv_products INNER JOIN pdv_categories ON pdv_categories.id = pdv_products.category  WHERE pdv_products.id='".$_GET['idproduct']."' order by pdv_categories.id ");		
			
			} else {
			
$stm = $this->pdo->prepare("SELECT pdv_products.id, pdv_products.status, pdv_products.name, pdv_products.quantity, pdv_products.has_quant, pdv_products.price, pdv_products.unit, pdv_products.description, pdv_categories.name as 'category', pdv_products.product_img, pdv_products.assignto, pdv_products.critical_quant FROM pdv_products INNER JOIN pdv_categories ON pdv_categories.id = pdv_products.category order by pdv_categories.id");	
			
			}
	//	$stm = $this->pdo->prepare("SELECT * FROM pdv_companies");
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rproduct)
		{
			$almproduct = new pdv_var();


			$almproduct->__SET('productname', $rproduct->name);
			$almproduct->__SET('productid', $rproduct->id);
			$almproduct->__SET('productstatus', $rproduct->status);
			$almproduct->__SET('productquantity', $rproduct->quantity);
			$almproduct->__SET('producthas_quant', $rproduct->has_quant);
			$almproduct->__SET('productprice', $rproduct->price);
			$almproduct->__SET('productunit', $rproduct->unit);
			$almproduct->__SET('productdescription', $rproduct->description);
			$almproduct->__SET('productimg', $rproduct->product_img);
			$almproduct->__SET('productassignto', $rproduct->assignto);
			$almproduct->__SET('productcategory', $rproduct->category);
			$almproduct->__SET('critical_quant', $rproduct->critical_quant);
			
			
			$result[] = $almproduct;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/* Update a product*/
public function updateproduct(pdv_var $data)
{
	try 
	{

		$sql = "UPDATE pdv_products SET 
				name = ?,
				status = ?,
				quantity = ?,
				has_quant = ?,
				price = ?,
				unit = ?,
				description = ?,
				product_img = ?,
				assignto = ?,
				category = ?,
				critical_quant = ?
				WHERE id = ?";


		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('productname'), 
				$data->__GET('productstatus'), 
				$data->__GET('productquantity'), 
				$data->__GET('producthas_quant'), 
				$data->__GET('productprice'), 
				$data->__GET('productunit'), 
				$data->__GET('productdescription'), 
				$data->__GET('productimg'), 
				$data->__GET('productassignto'), 
				$data->__GET('productcategory'), 		
				$data->__GET('critical_quant'),				
				$data->__GET('id')
			
		)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/* delete a contact */
public function deleteproduct($id)	{
	try 
	{

		$stm = $this->pdo->prepare("DELETE FROM pdv_products WHERE id = ? ");			          

		$stm->execute(array($id));


	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/*ADD product*/
public function addproduct(pdv_var $data)
{

	try 
	{
	$sql = "INSERT INTO pdv_products (name, status, quantity, has_quant, price, unit, description, product_img, assignto, category, critical_quant) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('productname'), 
			$data->__GET('productstatus'), 
			$data->__GET('productquantity'), 
			$data->__GET('producthas_quant'), 
			$data->__GET('productprice'), 
			$data->__GET('productunit'), 
			$data->__GET('productdescription'), 
			$data->__GET('productimg'), 
			$data->__GET('productassignto'),
			$data->__GET('productcategory'),
			$data->__GET('critical_quant')
			

			)
		);

	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}





/*ADD category*/
public function addcategory(pdv_var $data)
{

	try 
	{
	$sql = "INSERT INTO pdv_categories (name, description, type, parent) 
			VALUES (?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('catname'), 
			$data->__GET('catdescrip'), 
			$data->__GET('cattype'), 
			$data->__GET('catparent')
			
			)
		);

	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* update products to 0 categories */
public function productcatto0(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_products SET 
				category = ?
				WHERE category = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('productcategory'), 
				$data->__GET('catid')
				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/*Get category by id */
public function getcatbyid($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM pdv_categories WHERE id = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$alm = new pdv_var();

			$alm->__SET('catid', $r->id);
			$alm->__SET('catname', $r->name);
			$alm->__SET('catdescrip', $r->description);
			$alm->__SET('cattype', $r->type);
			$alm->__SET('catparent', $r->parent);
		
		

			$result[] = $alm;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}





/*Delete a category*/
public function deletecategory($id)	{
	try 
	{
			$stm123 = $this->pdo
		->prepare("DELETE FROM pdv_categories WHERE id = ?");			          

$stm123->execute(array($id));

	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/* update categories */
public function updatecategory(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_categories SET 
				name = ?,
				description = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('catname'), 
				$data->__GET('catdescrip'), 
				$data->__GET('catid')
				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/*Get categories in use */
public function getcategoriesinuse() {
	try
	{
		$result = array();

	$stm = $this->pdo->prepare("SELECT pdv_categories.id, pdv_categories.name, pdv_categories.description, pdv_categories.type, pdv_categories.parent FROM `pdv_categories` INNER JOIN pdv_products ON pdv_categories.id = pdv_products.category group by pdv_categories.name ORDER BY pdv_categories.id ASC");
	
	$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcat)
		{
			$almcat = new pdv_var();


			$almcat->__SET('catid', $rcat->id);
			$almcat->__SET('catname', $rcat->name);
			$almcat->__SET('catdescrip', $rcat->description);
			$almcat->__SET('cattype', $rcat->type);
			$almcat->__SET('catparent', $rcat->parent);
		
			

			$result[] = $almcat;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}




/*Get categories */
public function getcategories() {
	try
	{
		$result = array();

if (isset($_GET['idcategory'])){

		$stm = $this->pdo->prepare("SELECT * FROM pdv_categories WHERE id='".$_GET['idcategory']."'");
		
} else {

	$stm = $this->pdo->prepare("SELECT * FROM pdv_categories");
	
}
		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcat)
		{
			$almcat = new pdv_var();


			$almcat->__SET('catid', $rcat->id);
			$almcat->__SET('catname', $rcat->name);
			$almcat->__SET('catdescrip', $rcat->description);
			$almcat->__SET('cattype', $rcat->type);
			$almcat->__SET('catparent', $rcat->parent);
		
			

			$result[] = $almcat;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}


/*update the totalprice of the prospect*/
public function updatefinalpriceinprospect (pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 						
					total = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('totalprice'),
				$data->__GET('prospectid')
				)
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/*Get product price*/
  
public function getproductprice($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT price, has_quant, quantity FROM pdv_products  WHERE id = ?");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects1)
		{
			$almprospects1 = new pdv_var();
			$almprospects1->__SET('productprice', $rprospects1->price);
			$almprospects1->__SET('productquantity', $rprospects1->quantity);
			$almprospects1->__SET('producthas_quant', $rprospects1->has_quant);

			$result[] = $almprospects1;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

/*check if the prospect already has the product*/

public function checkpp2oftheprospect($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_pp2 WHERE idproduct='".$id."' and prospect='".$_GET['prospectid']."' ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almprospect9 = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospect9){
			
			$almprospect9->__SET('pp2id', $rprospect9->id);

	}
			$almprospect9->__SET('rowcount', $row_count);
		
            return $almprospect9;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}




/*Get prospects, pp2 and tasks stars below*/
  
public function getpp2fromprospect($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT pdv_pp2.id as 'pp2id', pdv_pp2.discount, pdv_pp2.quantity as 'wantedquant', pdv_pp2.priceafterdis, pdv_products.name, pdv_products.has_quant, pdv_products.quantity as 'whatsavailable', pdv_products.price, pdv_products.product_img, pdv_categories.name as 'catname', pdv_products.critical_quant, pdv_products.id as 'productidorig', pdv_pp2.currentprice  FROM pdv_pp2 INNER JOIN pdv_products ON pdv_pp2.idproduct = pdv_products.id INNER JOIN pdv_categories ON pdv_categories.id = pdv_products.category WHERE pdv_pp2.prospect = ?");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects3)
		{
			$almprospects3 = new pdv_var();

			$almprospects3->__SET('pp2_productid', $rprospects3->pp2id);
			$almprospects3->__SET('pp2_discount', $rprospects3->discount);
			$almprospects3->__SET('pp2_quantity', $rprospects3->wantedquant);
			$almprospects3->__SET('pp2_priceafter', $rprospects3->priceafterdis); 		
			$almprospects3->__SET('productname', $rprospects3->name);
			$almprospects3->__SET('producthas_quant', $rprospects3->has_quant);
			$almprospects3->__SET('productquantity', $rprospects3->whatsavailable);
			$almprospects3->__SET('productprice', $rprospects3->price);
			$almprospects3->__SET('productimg', $rprospects3->product_img);
			$almprospects3->__SET('productcategory', $rprospects3->catname);
			$almprospects3->__SET('critical_quant', $rprospects3->critical_quant);
			$almprospects3->__SET('productid', $rprospects3->productidorig);
			$almprospects3->__SET('currentprice', $rprospects3->currentprice);
			

			$result[] = $almprospects3;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}


public function gettasksfromprospect($id) {
	try
	{

	if((basename($_SERVER['PHP_SELF']) == "calendar.php"))  { //if1

		$result = array();
		$stm = $this->pdo->prepare("SELECT pdv_tasks.name as 'taskstitle', pdv_tasks.description as 'tasksdescription', pdv_tasks.addeddate as 'tasksdatecreation', pdv_tasks.limit_date as 'taskslimitdate', pdv_tasks.id as 'taskid', pdv_tasks.type, pdv_tasks.asoc_id_user, pdv_tasks.isprivate, pdv_tasks.priority, pdv_tasks.customtask, pdv_contact.name as 'namecontact', pdv_contact.lastname as 'contactlastname' FROM pdv_tasks INNER JOIN pdv_prospects ON pdv_tasks.asoc_id_client=pdv_prospects.id INNER JOIN pdv_contact ON pdv_prospects.contact = pdv_contact.id  WHERE ((pdv_tasks.isprivate='0') or (pdv_tasks.isprivate='1' and pdv_tasks.asoc_id_user = '".$_GET['activeuser']."')) and pdv_tasks.limit_date >= '".$id." 00:00:00' and pdv_tasks.limit_date <= '".$id." 23:59:59' and pdv_tasks.asoc_id_client <> ''");
		$stm->execute(array());  

		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcalendar)
		{
			$almcalendar1 = new pdv_var();

			$almcalendar1->__SET('taskname', $rcalendar->taskstitle);
			$almcalendar1->__SET('taskdescrip', $rcalendar->tasksdescription);
			$almcalendar1->__SET('taskdate', $rcalendar->tasksdatecreation);
			$almcalendar1->__SET('tasklimitdate', $rcalendar->taskslimitdate); 
			$almcalendar1->__SET('taskid', $rcalendar->taskid); 
			$almcalendar1->__SET('tasktype', $rcalendar->type);
			$almcalendar1->__SET('taskasocuser', $rcalendar->asoc_id_user);
			$almcalendar1->__SET('isprivate', $rcalendar->isprivate);
			$almcalendar1->__SET('customtask', $rcalendar->customtask); 
			$almcalendar1->__SET('priority', $rcalendar->priority); 
			$almcalendar1->__SET('namecontact', $rcalendar->namecontact); 
			$almcalendar1->__SET('lastnamecontact', $rcalendar->contactlastname); 

			$result[] = $almcalendar1;
		}

	} else { //if1

		$result = array();
		$stm = $this->pdo->prepare("SELECT pdv_tasks.name as 'taskstitle', pdv_tasks.description as 'tasksdescription', pdv_tasks.addeddate as 'tasksdatecreation', pdv_tasks.limit_date as 'taskslimitdate', pdv_tasks.id as 'taskid' FROM pdv_tasks WHERE pdv_tasks.asoc_id_client = ? ");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects2)
		{
			$almprospects2 = new pdv_var();

			$almprospects2->__SET('taskname', $rprospects2->taskstitle);
			$almprospects2->__SET('taskdescrip', $rprospects2->tasksdescription);
			$almprospects2->__SET('taskdate', $rprospects2->tasksdatecreation);
			$almprospects2->__SET('tasklimitdate', $rprospects2->taskslimitdate); 
			$almprospects2->__SET('taskid', $rprospects2->taskid); 
			$result[] = $almprospects2;
		}

	} //if1

		return $result;


	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}






/*get the tasks for the calendar*/
public function gettasksforthecalendar($id) {
	try
	{
		$result = array();
		$stm = $this->pdo->prepare("SELECT pdv_tasks.name as 'taskstitle', pdv_tasks.description as 'tasksdescription', pdv_tasks.addeddate as 'tasksdatecreation', pdv_tasks.limit_date as 'taskslimitdate', pdv_tasks.id as 'taskid', pdv_tasks.type, pdv_tasks.asoc_id_user, pdv_tasks.isprivate, pdv_tasks.priority, pdv_tasks.customtask FROM pdv_tasks  WHERE ((pdv_tasks.isprivate='0') or (pdv_tasks.isprivate='1' and pdv_tasks.asoc_id_user = '".$_GET['activeuser']."')) and pdv_tasks.limit_date >= '".$id." 00:00:00' and pdv_tasks.limit_date <= '".$id." 23:59:59' and pdv_tasks.asoc_id_client = ''");
		$stm->execute(array());  

		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcalendar)
		{
			$almcalendar = new pdv_var();

			$almcalendar->__SET('taskname', $rcalendar->taskstitle);
			$almcalendar->__SET('taskdescrip', $rcalendar->tasksdescription);
			$almcalendar->__SET('taskdate', $rcalendar->tasksdatecreation);
			$almcalendar->__SET('tasklimitdate', $rcalendar->taskslimitdate); 
			$almcalendar->__SET('taskid', $rcalendar->taskid); 
			$almcalendar->__SET('tasktype', $rcalendar->type);
			$almcalendar->__SET('taskasocuser', $rcalendar->asoc_id_user);
			$almcalendar->__SET('isprivate', $rcalendar->isprivate);
			$almcalendar->__SET('customtask', $rcalendar->customtask); 
			$almcalendar->__SET('priority', $rcalendar->priority); 

			$result[] = $almcalendar;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}





/*get the tasks in which the user is invited*/
public function getgueststasks($id) {
	try
	{
		$result = array();
		$stm = $this->pdo->prepare("SELECT pdv_tasks.name as 'taskstitle', pdv_tasks.description as 'tasksdescription', pdv_tasks.addeddate as 'tasksdatecreation', pdv_tasks.limit_date as 'taskslimitdate', pdv_tasks.id as 'taskid', pdv_tasks.type, pdv_tasks.asoc_id_user, pdv_tasks.isprivate, pdv_tasks.priority, pdv_tasks.customtask FROM pdv_tasks INNER JOIN pdv_guests ON pdv_guests.id_task = pdv_tasks.id WHERE (pdv_guests.id_user='".$_GET['activeuser']."') and pdv_tasks.limit_date >= '".$id." 00:00:00' and pdv_tasks.limit_date <= '".$id." 23:59:59'");
		$stm->execute(array());  

		$row_count = $stm->rowCount();
	
		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcalendar1)
		{
			$almcalendar1 = new pdv_var();

			$almcalendar1->__SET('taskname', $rcalendar1->taskstitle);
			$almcalendar1->__SET('taskdescrip', $rcalendar1->tasksdescription);
			$almcalendar1->__SET('taskdate', $rcalendar1->tasksdatecreation);
			$almcalendar1->__SET('tasklimitdate', $rcalendar1->taskslimitdate); 
			$almcalendar1->__SET('taskid', $rcalendar1->taskid); 
			$almcalendar1->__SET('tasktype', $rcalendar1->type);
			$almcalendar1->__SET('taskasocuser', $rcalendar1->asoc_id_user);
			$almcalendar1->__SET('isprivate', $rcalendar1->isprivate);
			$almcalendar1->__SET('customtask', $rcalendar1->customtask); 
			$almcalendar1->__SET('priority', $rcalendar1->priority); 

			$result[] = $almcalendar1;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*count the prospects denied*/
public function getprospectsdeniedcount($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_prospects WHERE status = '0' and MONTH(lastmod_date) = ?");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almcountunactive = new pdv_var();
			$almcountunactive->__SET('rowcount', $row_count);
		
            return $almcountunactive;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}

/*count the prospects aproved*/
public function getprospectsaprovedcount($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_sales WHERE MONTH(creationdate) = ?");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almcountunactive = new pdv_var();
			$almcountunactive->__SET('rowcount', $row_count);
		
            return $almcountunactive;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}





/*check if rowcount>0*/
public function getprospectsandtasks() {
	try
	{
		$result = array();
if(isset($_GET['status'])){	
if(isset($_GET['prospectid'])){		
	$stm = $this->pdo->prepare("SELECT pdv_prospects.id as 'prospectid', pdv_contact.id as 'contactid', pdv_contact.name as 'contactname', pdv_contact.lastname as 'contactlastname', pdv_contact.email as 'contactemail', pdv_contact.phone as 'contactphone', pdv_companies.name as 'companyname', pdv_contact.cargo as 'contactcargo', pdv_prospects.status as 'prospectstatus', pdv_prospects.added_date as 'creationdate', pdv_prospects.has_tasks, pdv_users.pdv_name as 'responsablename', pdv_users.pdv_lastname as 'responsablelastname', pdv_prospects.prospectnotes, pdv_contact.imgcontact,  pdv_meta.meta_title, pdv_prospects.total, pdv_prospects.has_cuotes, pdv_prospects.responsable as 'respid' FROM pdv_prospects INNER JOIN pdv_contact ON pdv_prospects.contact = pdv_contact.id INNER JOIN pdv_companies ON pdv_contact.company= pdv_companies.id INNER JOIN pdv_users ON pdv_users.id=pdv_prospects.responsable INNER JOIN pdv_meta ON pdv_meta.meta_value = pdv_prospects.status  WHERE pdv_meta.meta_type='prospects' and pdv_prospects.id = '".$_GET['prospectid']."' and pdv_prospects.status= '".$_GET['status']."'");	
} else {
$stm = $this->pdo->prepare("SELECT pdv_prospects.id as 'prospectid', pdv_contact.id as 'contactid', pdv_contact.name as 'contactname', pdv_contact.lastname as 'contactlastname', pdv_contact.email as 'contactemail', pdv_contact.phone as 'contactphone', pdv_companies.name as 'companyname', pdv_contact.cargo as 'contactcargo', pdv_prospects.status as 'prospectstatus', pdv_prospects.added_date as 'creationdate', pdv_prospects.has_tasks, pdv_users.pdv_name as 'responsablename', pdv_users.pdv_lastname as 'responsablelastname', pdv_prospects.prospectnotes, pdv_contact.imgcontact,  pdv_meta.meta_title, pdv_prospects.total, pdv_prospects.has_cuotes, pdv_prospects.responsable as 'respid' FROM pdv_prospects INNER JOIN pdv_contact ON pdv_prospects.contact = pdv_contact.id INNER JOIN pdv_companies ON pdv_contact.company= pdv_companies.id INNER JOIN pdv_users ON pdv_users.id=pdv_prospects.responsable INNER JOIN pdv_meta ON pdv_meta.meta_value = pdv_prospects.status  WHERE pdv_meta.meta_type='prospects' and pdv_prospects.status= '".$_GET['status']."'");	
}
} else {
if(isset($_GET['prospectid'])){		
		$stm = $this->pdo->prepare("SELECT pdv_prospects.id as 'prospectid', pdv_contact.id as 'contactid', pdv_contact.name as 'contactname', pdv_contact.lastname as 'contactlastname', pdv_contact.email as 'contactemail', pdv_contact.phone as 'contactphone', pdv_companies.name as 'companyname', pdv_contact.cargo as 'contactcargo', pdv_prospects.status as 'prospectstatus', pdv_prospects.added_date as 'creationdate', pdv_prospects.has_tasks, pdv_users.pdv_name as 'responsablename', pdv_users.pdv_lastname as 'responsablelastname', pdv_prospects.prospectnotes, pdv_contact.imgcontact,  pdv_meta.meta_title, pdv_prospects.total, pdv_prospects.has_cuotes, pdv_prospects.responsable as 'respid' FROM pdv_prospects INNER JOIN pdv_contact ON pdv_prospects.contact = pdv_contact.id INNER JOIN pdv_companies ON pdv_contact.company= pdv_companies.id INNER JOIN pdv_users ON pdv_users.id=pdv_prospects.responsable INNER JOIN pdv_meta ON pdv_meta.meta_value = pdv_prospects.status  WHERE pdv_meta.meta_type='prospects' and pdv_prospects.id = '".$_GET['prospectid']."'");	
} else {
	$stm = $this->pdo->prepare("SELECT pdv_prospects.id as 'prospectid', pdv_contact.id as 'contactid', pdv_contact.name as 'contactname', pdv_contact.lastname as 'contactlastname', pdv_contact.email as 'contactemail', pdv_contact.phone as 'contactphone', pdv_companies.name as 'companyname', pdv_contact.cargo as 'contactcargo', pdv_prospects.status as 'prospectstatus', pdv_prospects.added_date as 'creationdate', pdv_prospects.has_tasks, pdv_users.pdv_name as 'responsablename', pdv_users.pdv_lastname as 'responsablelastname', pdv_prospects.prospectnotes, pdv_contact.imgcontact,  pdv_meta.meta_title, pdv_prospects.total, pdv_prospects.has_cuotes, pdv_prospects.responsable as 'respid' FROM pdv_prospects INNER JOIN pdv_contact ON pdv_prospects.contact = pdv_contact.id INNER JOIN pdv_companies ON pdv_contact.company= pdv_companies.id INNER JOIN pdv_users ON pdv_users.id=pdv_prospects.responsable INNER JOIN pdv_meta ON pdv_meta.meta_value = pdv_prospects.status  WHERE pdv_meta.meta_type='prospects'");	
}
}
		$stm->execute(array());  
		$row_count = $stm->rowCount();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects1)
		{
			$almprospects1 = new pdv_var();

			$almprospects1->__SET('prospectid', $rprospects1->prospectid);
			$almprospects1->__SET('contactid', $rprospects1->contactid);
			$almprospects1->__SET('namecontact', $rprospects1->contactname);
			$almprospects1->__SET('lastnamecontact', $rprospects1->contactlastname);
			$almprospects1->__SET('emailcontact', $rprospects1->contactemail);
			$almprospects1->__SET('phonecontact', $rprospects1->contactphone);
			$almprospects1->__SET('companyname', $rprospects1->companyname);
			$almprospects1->__SET('chargecontact', $rprospects1->contactcargo);
			$almprospects1->__SET('status_prospect', $rprospects1->prospectstatus);
			$almprospects1->__SET('creation_date_prospect', $rprospects1->creationdate);
			$almprospects1->__SET('has_tasks_prospect', $rprospects1->has_tasks);
			$almprospects1->__SET('responsable_prospectname', $rprospects1->responsablename);
			$almprospects1->__SET('responsable_prospectlastname', $rprospects1->responsablelastname);
			$almprospects1->__SET('prospectnotes', $rprospects1->prospectnotes);
			$almprospects1->__SET('imgcontact', $rprospects1->imgcontact);
			$almprospects1->__SET('metatitle', $rprospects1->meta_title);
			$almprospects1->__SET('totalprice', $rprospects1->total);
			$almprospects1->__SET('has_cuotes', $rprospects1->has_cuotes);
			$almprospects1->__SET('responsable', $rprospects1->respid);
			$almprospects1->__SET('rowcount', $row_count);

			$result[] = $almprospects1;
		}
		return $result;

	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}

}


/*Get the price of the prospects that went down (0%) */
public function getpricesofprospectsdown($id) {
	try
	{
		$result = array();
		$stm = $this->pdo->prepare("SELECT total FROM pdv_prospects WHERE status = '0' and MONTH(lastmod_date) = ?");	
		$stm->execute(array($id));  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rdown)
		{
			$almdown = new pdv_var();

			$almdown->__SET('totalprice', $rdown->total);
	

			$result[] = $almdown;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*Get the price of the negociations (prospects) 75 only, and get them listed in sales */
public function getpricesofnegociations() {
	try
	{
		$result = array();
if(isset($_GET['prospectid'])){		
	$stm = $this->pdo->prepare("SELECT pdv_prospects.total, pdv_prospects.added_date, pdv_prospects.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.cargo, pdv_contact.email, pdv_contact.phone FROM pdv_prospects INNER JOIN pdv_contact ON pdv_contact.id=pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company =pdv_companies.id WHERE  pdv_prospects.status = '75' and pdv_prospects.id= '".$_GET['prospectid']."'");	
} else {
	$stm = $this->pdo->prepare("SELECT pdv_prospects.total, pdv_prospects.added_date, pdv_prospects.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.cargo, pdv_contact.email, pdv_contact.phone FROM pdv_prospects INNER JOIN pdv_contact ON pdv_contact.id=pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company =pdv_companies.id WHERE  pdv_prospects.status = '75'");	
	
}
		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects1)
		{
			$almprospects1 = new pdv_var();

			$almprospects1->__SET('totalprice', $rprospects1->total);
			$almprospects1->__SET('creation_date_prospect', $rprospects1->added_date);
			$almprospects1->__SET('prospectid', $rprospects1->id);
			$almprospects1->__SET('namecontact', $rprospects1->name);
			$almprospects1->__SET('lastnamecontact', $rprospects1->lastname);
			$almprospects1->__SET('companyname', $rprospects1->companyname);
			$almprospects1->__SET('chargecontact', $rprospects1->cargo);
			$almprospects1->__SET('emailcontact', $rprospects1->companyname);
			$almprospects1->__SET('phonecontact', $rprospects1->phone);

			$result[] = $almprospects1;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*Get the price of the negociations (prospects) 25-50-75 */
public function getpricesofnegociations1() {
	try
	{
		$result = array();

	$stm = $this->pdo->prepare("SELECT pdv_prospects.total, pdv_prospects.added_date, pdv_prospects.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.cargo, pdv_contact.email, pdv_contact.phone FROM pdv_prospects INNER JOIN pdv_contact ON pdv_contact.id=pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company =pdv_companies.id WHERE pdv_prospects.status > '24' and pdv_prospects.status < '76'");	
	

		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospects1)
		{
			$almprospects1 = new pdv_var();

			$almprospects1->__SET('totalprice', $rprospects1->total);
			$almprospects1->__SET('creation_date_prospect', $rprospects1->added_date);
			$almprospects1->__SET('prospectid', $rprospects1->id);
			$almprospects1->__SET('namecontact', $rprospects1->name);
			$almprospects1->__SET('lastnamecontact', $rprospects1->lastname);
			$almprospects1->__SET('companyname', $rprospects1->companyname);
			$almprospects1->__SET('chargecontact', $rprospects1->cargo);
			$almprospects1->__SET('emailcontact', $rprospects1->companyname);
			$almprospects1->__SET('phonecontact', $rprospects1->phone);

			$result[] = $almprospects1;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*get the commission of the user*/
public function getcommissionoftheuser() {
	
	
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT  pdv_cuotes.total, pdv_users.commission FROM pdv_prospects INNER JOIN pdv_sales ON pdv_prospects.id = pdv_sales.prospectid INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_cuotes ON pdv_cuotes.prospect = pdv_prospects.id WHERE pdv_users.id = '".$_GET['activeuser']."' and MONTH(pdv_sales.creationdate) = '".date("m", time())."' and pdv_cuotes.succeeded = '1'");	

		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcommission)
		{
			$almcommission = new pdv_var();

			$almcommission->__SET('totalcommission', $rcommission->total);
			$almcommission->__SET('commission', $rcommission->commission);

			$result[] = $almcommission;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}


/*Get sales list and data */
public function getsales() {

try{
  $result = array();
//Get the comissions
if(isset($_GET['action']) && ($_GET['action']=='commissions')){

	if(isset($_POST['initdate'])){	
	$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_prospects.responsable = '".$_GET['activeuser']."' and pdv_sales.creationdate BETWEEN '".$_POST['initdate']."' and '".$_POST['enddate']."' ORDER BY pdv_sales.creationdate DESC");	
	} else {
	$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_prospects.responsable = '".$_GET['activeuser']."' and pdv_sales.creationdate BETWEEN '".date("Y-m", time())."-01"."' and '".date("Y-m-d", time())."' ORDER BY pdv_sales.creationdate DESC");	
	}

} else { 

if(!isset($_GET['idsale'])){		
	if(isset($_GET['check'])){
		if(isset($_GET['date'])){
			$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_sales.creationdate >= '".$_GET['date']."' and pdv_prospects.responsable = '".$_GET['activeuser']."' ORDER BY pdv_sales.creationdate DESC");
		}else{
			$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_prospects.responsable = '".$_GET['activeuser']."' ORDER BY pdv_sales.creationdate DESC");	
		}
	}else{
		if(isset($_GET['date'])){
			$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_sales.creationdate >= '".$_GET['date']."' ORDER BY pdv_sales.creationdate DESC");
		}else{
			$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id ORDER BY pdv_sales.creationdate DESC");	
		}
	}
}else {
	$stm = $this->pdo->prepare("SELECT pdv_sales.id, pdv_contact.name, pdv_contact.lastname, pdv_companies.name as 'companyname', pdv_contact.email, pdv_contact.phone, pdv_contact.cargo, pdv_sales.creationdate, pdv_cuotes.id as 'asoc_cuote', pdv_cuotes.total, pdv_users.pdv_name as 'resp_name', pdv_users.pdv_lastname as 'resp_lastname', pdv_users.id as 'resp_id', pdv_contact.imgcontact, pdv_prospects.id as 'prospectid', pdv_users.commission FROM pdv_sales INNER JOIN pdv_cuotes ON pdv_cuotes.id = pdv_sales.cuoteid INNER JOIN pdv_prospects ON pdv_cuotes.prospect = pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_users ON pdv_users.id = pdv_prospects.responsable INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_sales.id='".$_GET['idsale']."' ORDER BY pdv_sales.creationdate DESC");	
}

}
		$stm->execute(array());  
		$row_count = $stm->rowCount();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rclients)
		{
			$almclients = new pdv_var();

			$almclients->__SET('salesid', $rclients->id);
			$almclients->__SET('namecontact', $rclients->name);
			$almclients->__SET('lastnamecontact', $rclients->lastname);
			$almclients->__SET('companycontact', $rclients->companyname);
			$almclients->__SET('emailcontact', $rclients->email);
			$almclients->__SET('phonecontact', $rclients->phone);
			$almclients->__SET('chargecontact', $rclients->cargo);
			$almclients->__SET('salesdate', $rclients->creationdate);
			$almclients->__SET('cuotesid', $rclients->asoc_cuote);
			$almclients->__SET('totalcuote', $rclients->total);
			$almclients->__SET('responsable_prospectname', $rclients->resp_name);
			$almclients->__SET('responsable_prospectlastname', $rclients->resp_lastname);
			$almclients->__SET('responsable', $rclients->resp_id);
			$almclients->__SET('imgcontact', $rclients->imgcontact);
			$almclients->__SET('prospectid', $rclients->prospectid);
			$almclients->__SET('commission', $rclients->commission);
			$almclients->__SET('rowcount', $row_count);
			$result[] = $almclients;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*Get the quantity of daily sales */
public function getsalesquantityoftheday() {
	
	
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT pdv_cuotes.total FROM pdv_cuotes INNER JOIN pdv_sales ON pdv_cuotes.id=pdv_sales.cuoteid WHERE creationdate = '".date("Y-m-d", time())."' ");	

		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rsales)
		{
			$almsales = new pdv_var();

			$almsales->__SET('totalcuote', $rsales->total);

			$result[] = $almsales;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}


public function getsalesquantityofthemonth($id) {
	try
	{
		$result = array();
		$stm = $this->pdo->prepare("SELECT pdv_cuotes.total FROM pdv_cuotes INNER JOIN pdv_sales ON pdv_cuotes.id=pdv_sales.cuoteid WHERE MONTH(creationdate) = ? ");	
		$stm->execute(array($id));  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rsalesmonth)
		{
			$almsalesmonth = new pdv_var();

			$almsalesmonth->__SET('totalcuote', $rsalesmonth->total);

			$result[] = $almsalesmonth;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}






/*Get status prospects from meta */
public function getstatus_prospect() {
	try
	{
		$result = array();

	$stm = $this->pdo->prepare("SELECT * FROM pdv_meta WHERE meta_type ='prospects' order by id");
	
		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rmeta)
		{
			$almmeta = new pdv_var();


			$almmeta->__SET('metaid', $rmeta->id);
			$almmeta->__SET('metatitle', $rmeta->meta_title);
			$almmeta->__SET('metavalue', $rmeta->meta_value);
			$almmeta->__SET('metatype', $rmeta->meta_type);
		
			$result[] = $almmeta;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}


/* add prospect */
public function addprospect(pdv_var $data)
{
	try 
	{
	$sql = "INSERT INTO pdv_prospects (contact,responsable,status,added_date, has_tasks, prospectnotes, lastmod_date) 
			VALUES (?, ?, ?, ?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('contact_prospect'), 
			$data->__GET('responsable_prospect'), 
			$data->__GET('status_prospect'),
			$data->__GET('creation_date_prospect'),
			$data->__GET('has_tasks_prospect'),
			$data->__GET('prospectnotes'),
			$data->__GET('lastmod_date')
			
			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* create cuote */
public function createcuote(pdv_var $data)
{
	try 
	{
	$sql = "INSERT INTO pdv_cuotes (prospect,added_date, total) 
			VALUES (?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('contact_prospect'), 
			$data->__GET('creation_date_prospect'), 
			$data->__GET('totalcuote')
			
			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


//get cuote id

/*Get prospects count */
/*I have to use a select max according to the prospect id 
SELECT max(id) FROM pdv_cuotes where prospect = ?

*/





/* create new sale */
public function createnewsale(pdv_var $data)
{
	try 
	{
//update succeded in cuotes
		$sql1 = "UPDATE pdv_cuotes SET 
		succeeded = '1'
		WHERE id = ?";

$this->pdo->prepare($sql1)->execute(
	array($data->__GET('salescuoteid')));


//create new sale
	$sql = "INSERT INTO pdv_sales (prospectid, cuoteid, creationdate) 
			VALUES (?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('salesprospectid'), 
			$data->__GET('salescuoteid'), 
			$data->__GET('salesdate')
			
			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}





/* actualizar thas_cuotes of the prospect */
public function updatehas_cuotesofprospect(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				has_cuotes = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('has_cuotes'), 
				$data->__GET('prospectid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}





/*Get prospects, pp3*/
  public function getpp3foracuote($varidbefore) {
	try
	{
		$result = array();
		if(isset($_GET['cuoteid'])){
		$stm = $this->pdo->prepare("SELECT pdv_pp3.idproduct, pdv_pp3.discount, pdv_pp3.quantity, pdv_pp3.priceafterdis, pdv_products.name, pdv_pp3.priceofthecuote FROM pdv_pp3 INNER JOIN pdv_products ON pdv_pp3.idproduct= pdv_products.id WHERE cuotesid='".$_GET['cuoteid']."'");	
		} else {
		$stm = $this->pdo->prepare("SELECT pdv_pp3.idproduct, pdv_pp3.discount, pdv_pp3.quantity, pdv_pp3.priceafterdis, pdv_products.name, pdv_pp3.priceofthecuote FROM pdv_pp3 INNER JOIN pdv_products ON pdv_pp3.idproduct= pdv_products.id WHERE cuotesid='".$varidbefore."'");	
		}

		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcuotepp3)
		{
			$almcuotepp3 = new pdv_var();

			$almcuotepp3->__SET('pp3_productid', $rcuotepp3->idproduct);
			$almcuotepp3->__SET('pp3_discount', $rcuotepp3->discount);
			$almcuotepp3->__SET('pp3_quantity', $rcuotepp3->quantity);
			$almcuotepp3->__SET('pp3_priceafter', $rcuotepp3->priceafterdis); 		
			$almcuotepp3->__SET('productname', $rcuotepp3->name);
			$almcuotepp3->__SET('priceofthecuote', $rcuotepp3->priceofthecuote);
					

			$result[] = $almcuotepp3;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*Delete cuotes*/
public function deletecuote($id)	{
	try 
	{
		$stm = $this->pdo
				  ->prepare("DELETE FROM pdv_cuotes WHERE id = ?");			          

		$stm->execute(array($id));

		$stm1 = $this->pdo
		->prepare("DELETE FROM pdv_pp3 WHERE cuotesid = ?");			          

$stm1->execute(array($id));


	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}





/*Get cuotes listed */
public function getcuotesoftheprospect() {
	try
	{
		$result = array();

if(isset($_GET['prospectid'])){
		if(isset($_GET['cuoteid'])){
		$stm = $this->pdo->prepare("SELECT pdv_cuotes.id, pdv_cuotes.prospect, pdv_cuotes.added_date, pdv_cuotes.total, pdv_contact.name, pdv_contact.lastname, pdv_contact.email, pdv_contact.phone, pdv_companies.name as 'companyname', pdv_cuotes.succeeded FROM pdv_cuotes INNER JOIN pdv_prospects ON pdv_cuotes.prospect=pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_cuotes.prospect='".$_GET['prospectid']."' and pdv_cuotes.id = '".$_GET['cuoteid']."' ORDER BY id DESC");	
		} else {
		$stm = $this->pdo->prepare("SELECT pdv_cuotes.id, pdv_cuotes.prospect, pdv_cuotes.added_date, pdv_cuotes.total, pdv_contact.name, pdv_contact.lastname, pdv_contact.email, pdv_contact.phone, pdv_companies.name as 'companyname', pdv_cuotes.succeeded FROM pdv_cuotes INNER JOIN pdv_prospects ON pdv_cuotes.prospect=pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id WHERE pdv_cuotes.prospect='".$_GET['prospectid']."' ORDER BY id DESC");	
		}
	} else {
		$stm = $this->pdo->prepare("SELECT pdv_cuotes.id, pdv_cuotes.prospect, pdv_cuotes.added_date, pdv_cuotes.total, pdv_contact.name, pdv_contact.lastname, pdv_contact.email, pdv_contact.phone, pdv_companies.name as 'companyname', pdv_cuotes.succeeded FROM pdv_cuotes INNER JOIN pdv_prospects ON pdv_cuotes.prospect=pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id ORDER BY id DESC");	
	}

		$stm->execute(array());  
		

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcuotes1)
		{
			$almcuotes1 = new pdv_var();

			$almcuotes1->__SET('cuotesid', $rcuotes1->id);
			$almcuotes1->__SET('prospect', $rcuotes1->prospect);
			$almcuotes1->__SET('cuotedate', $rcuotes1->added_date);
			$almcuotes1->__SET('totalcuote', $rcuotes1->total);
			$almcuotes1->__SET('cuotename', $rcuotes1->name);
			$almcuotes1->__SET('cuotelastname', $rcuotes1->lastname);
			$almcuotes1->__SET('emailcontact', $rcuotes1->email);
			$almcuotes1->__SET('phonecontact', $rcuotes1->phone);
			$almcuotes1->__SET('companycontact', $rcuotes1->companyname);
			$almcuotes1->__SET('succeeded', $rcuotes1->succeeded);



			$result[] = $almcuotes1;
		}

		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}



/*Get cuotesucceded by id */
public function getcuotesucceeded($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT pdv_cuotes.id, pdv_cuotes.prospect, pdv_sales.creationdate as 'added_date', pdv_cuotes.total, pdv_contact.name, pdv_contact.lastname, pdv_contact.email, pdv_contact.phone, pdv_companies.name as 'companyname', pdv_cuotes.succeeded FROM pdv_cuotes INNER JOIN pdv_prospects ON pdv_cuotes.prospect=pdv_prospects.id INNER JOIN pdv_contact ON pdv_contact.id = pdv_prospects.contact INNER JOIN pdv_companies ON pdv_contact.company = pdv_companies.id INNER JOIN pdv_sales ON pdv_sales.cuoteid=pdv_cuotes.id WHERE pdv_cuotes.prospect = ? and pdv_cuotes.succeeded = '1' ORDER BY id DESC");	
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almcuotes2 = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcuotes2){
			
				$almcuotes2->__SET('cuotesid', $rcuotes2->id);
				$almcuotes2->__SET('prospect', $rcuotes2->prospect);
				$almcuotes2->__SET('cuotedate', $rcuotes2->added_date);
				$almcuotes2->__SET('totalcuote', $rcuotes2->total);
				$almcuotes2->__SET('cuotename', $rcuotes2->name);
				$almcuotes2->__SET('cuotelastname', $rcuotes2->lastname);
				$almcuotes2->__SET('emailcontact', $rcuotes2->email);
				$almcuotes2->__SET('phonecontact', $rcuotes2->phone);
				$almcuotes2->__SET('companycontact', $rcuotes2->companyname);
				$almcuotes2->__SET('succeeded', $rcuotes2->succeeded);


	$result[] = $almcuotes2;
}

return $result;
}

	catch(Exception $e){
		die($e->getMessage());
	}
}



/*Get event id */
public function geteventid($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_tasks where asoc_id_user = '".$_GET['activeuser']."' and limit_date = ?");
		$stm->execute(array($id));  
      
			$almcuotes = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcuotes){
			
				$almcuotes->__SET('taskid', $rcuotes->id);

			}
			
		
            return $almcuotes;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}





/*Get cuotes id */
public function getcuoteid($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_cuotes where prospect = ?");
		$stm->execute(array($id));  
      
			$almcuotes = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rcuotes){
			
				$almcuotes->__SET('cuotesid', $rcuotes->id);

			}
			
		
            return $almcuotes;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/* add guests of an event */
public function addguestsfromanevent(pdv_var $data) {
	try 
	{

	$sql = "INSERT INTO pdv_guests (id_user, id_task, invitationdate) 
	VALUES (?, ?, ?)";
	
		$this->pdo->prepare($sql)
			 ->execute(
			array(
	
				$data->__GET('id_user'), 
				$data->__GET('id_task'), 
				$data->__GET('invitationdate')
			
				)
			);


	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}




/* add tasks */
public function addtasksfromprospect(pdv_var $data) {
	try 
	{

if((basename($_SERVER['PHP_SELF']) == "calendar.php"))  { 

	$sql = "INSERT INTO pdv_tasks (name, description, addeddate, limit_date, type, asoc_id_user, isprivate, customtask, priority) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
		$this->pdo->prepare($sql)
			 ->execute(
			array(
	
				$data->__GET('taskname'), 
				$data->__GET('taskdescrip'), 
				$data->__GET('taskdate'),
				$data->__GET('tasklimitdate'),
				$data->__GET('tasktype'),			
				$data->__GET('taskasocprospect'),		
				$data->__GET('isprivate'),		
				$data->__GET('customtask'),		
				$data->__GET('priority')
			
				)
			);

} else {

	$sql = "INSERT INTO pdv_tasks (name, description, addeddate, limit_date, type, asoc_id_client) 
	VALUES (?, ?, ?, ?, ?, ?)";
	
		$this->pdo->prepare($sql)
			 ->execute(
			array(
	
	
				$data->__GET('taskname'), 
				$data->__GET('taskdescrip'), 
				$data->__GET('taskdate'),
				$data->__GET('tasklimitdate'),
				$data->__GET('tasktype'),			
				$data->__GET('taskasocprospect')
				
	
				)
			);

	}

	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* actualizar task in prospect */
public function updatetaskinprospect(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				has_tasks = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('has_tasks_prospect'), 
				$data->__GET('prospectid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/* actualizar task in pdv_tasks */
public function updatetaskintasks(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_tasks SET 
				name = ?,
				description = ?,
				limit_date = ?,
				type = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('taskname'), 
				$data->__GET('taskdescrip'), 
				$data->__GET('tasklimitdate'), 
				$data->__GET('tasktype'), 
				$data->__GET('taskid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/* actualizar notas del prospecto */
public function updateprospectnotes(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				prospectnotes = ?,
				status = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('prospectnotes'), 
				$data->__GET('status_prospect'), 
				$data->__GET('prospectid')
				)

				
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* actualizar fecha de prospecto cuando se actualice algun dato */
public function updateprospectlastmoddate(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				lastmod_date = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('lastmod_date'), 
				$data->__GET('prospectid')
				)

				
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}




/* actualizar notas del prospecto */
public function updateprospectresponsable(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				responsable = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('responsable'), 
				$data->__GET('prospectid')
				)

				
			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/* actualizar pp2 del prospecto */
public function updatepp2forprospect(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_pp2 SET 
				quantity = ?,
				discount = ?, 
				priceafterdis = ?,
				currentprice = ?
				WHERE id = ?";


		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('pp2_quantity'), 
				$data->__GET('pp2_discounts'), 
				$data->__GET('pp2_priceafter'), 
				$data->__GET('currentprice'), 
				$data->__GET('pp2_productid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* actualizar total del prospecto */
public function updateprospecttotalprice(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				total = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('priceafterdis'), 
				$data->__GET('prospectid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/* actualizar status del prospecto */
public function updateprospectstatus(pdv_var $data)
{
	try 
	{
		$sql = "UPDATE pdv_prospects SET 
				status = ?
				WHERE id = ?";

		$this->pdo->prepare($sql)->execute(
			array(
				$data->__GET('status_prospect'), 
				$data->__GET('prospectid')
				)

			);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/*Delete tasks from prospects*/
public function deletepp2fromprospect($id)	{
	try 
	{
		$stm = $this->pdo
				  ->prepare("DELETE FROM pdv_pp2 WHERE id = ?");			          

		$stm->execute(array($id));
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}




/*Delete tasks from prospects*/
public function deletetaskinprospect($id)	{
	try 
	{
		$stm = $this->pdo
				  ->prepare("DELETE FROM pdv_tasks WHERE id = ?");			          

		$stm->execute(array($id));
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}


/*Get prospects count */
public function getprospectscount($id) {
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT id FROM pdv_prospects WHERE contact = '".$id."' and status BETWEEN '25' and '75'");
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almprospect = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rprospect){
			
			$almprospect->__SET('prospectid', $rprospect->id);

	}
			$almprospect->__SET('rowcount', $row_count);
		
            return $almprospect;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}


/*Get count of the prospects by status */
public function getprospectscountedbystatus($id) {
	try
	{
		$result = array();
if($id == '0'){
	$stm = $this->pdo->prepare("SELECT id FROM pdv_prospects WHERE status > '24' and status < '76'" );
} else {
		$stm = $this->pdo->prepare("SELECT id FROM pdv_prospects WHERE status = '".$id."'");
}
		$stm->execute(array($id));  
		$row_count = $stm->rowCount();
      
			$almchart = new pdv_var();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $rchart){
			
			$almchart->__SET('prospectid', $rchart->id);

	}
			$almchart->__SET('rowcount', $row_count);
		
            return $almchart;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}



/* add products from a prospect to pp2 */
public function addpp2frompros(pdv_var $data)
{
	try 
	{
	$sql = "INSERT INTO pdv_pp2 (prospect, idproduct, discount, quantity, priceafterdis, currentprice) 
			VALUES (?, ?, ?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('prospectid'), 
			$data->__GET('pp2_productid'), 
			$data->__GET('pp2_discount'),
			$data->__GET('pp2_quantity'),
			$data->__GET('priceafterdis'),
			$data->__GET('currentprice')
			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}

/* add products from a prospect to pp3 */
public function addpp3frompros(pdv_var $data)
{
	try 
	{
	$sql = "INSERT INTO pdv_pp3 (cuotesid, idproduct, discount, quantity, priceafterdis, priceofthecuote) 
			VALUES (?, ?, ?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('cuotesid'), 
			$data->__GET('pp3_productid'), 
			$data->__GET('pp3_discount'),
			$data->__GET('pp3_quantity'),
			$data->__GET('pp3_priceafter'),
			$data->__GET('priceofthecuote')


			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}



/* CURRENTLY WORKING ON AGREGAR.PHP */
public function register(pdv_var $data)
{
	try 
	{
	$sql = "INSERT INTO pdv_users (pdv_name,pdv_lastname,pdv_email,pdv_password,pdv_rol) 
			VALUES (?, ?, ?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		array(
			$data->__GET('name'), 
			$data->__GET('lastname'), 
			$data->__GET('email'),
			$data->__GET('pass'),
			$data->__GET('rol')
			)
		);
	} catch (Exception $e) 
	{
		die($e->getMessage());
	}
}




} 





