<?php
include('Infusionsoft/infusionsoft.php');
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$email = $_GET['email'] ? $_GET['email'] : $_POST['email'];

function Get_TagID($tagName)
	{
		$tagId = Infusionsoft_DataService::query(new Infusionsoft_ContactGroup(),
		array('GroupName' => $tagName));
		foreach($tagId as $tag)
		{
		$tagId = $tag->Id;
		}
		return $tagId;	
	}

	if(@$id != '')
	{		
		$tagId = Get_TagID($_GET['tag']);
		$contactID = $id;
		$groupID = $tagId; 
		$app = Infusionsoft_ContactService::addToGroup($contactID, $groupID);
		echo 'Tag has been added successfully to your contact';

	}

	if(@$email != '')
	{
		$contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), array('Email' => $email));
		$contact = array_shift($contacts);
		$contactID =  $contact->Id;
		$tagId = Get_TagID($_GET['tag']);
		Infusionsoft_ContactService::addToGroup($contactID, $tagId);
		echo 'Tag has been added successfully to your contact';
	}


?>
