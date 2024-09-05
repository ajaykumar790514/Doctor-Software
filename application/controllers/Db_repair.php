<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Db_repair extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// transaction_head
		if (!$this->db->field_exists('transaction_head', 'transactions'))
		{
		    $query = "ALTER TABLE `transactions` ADD `transaction_head` INT NOT NULL DEFAULT '1' AFTER `id`";
		    if($this->db->query($query)){
		    	echo "transaction_head field created.<br>";
		    }
		}
		// transaction_head

		// screenshot
		if (!$this->db->field_exists('screenshot', 'transactions'))
		{
		    $query = "ALTER TABLE `transactions` ADD `screenshot` VARCHAR(100) NULL AFTER `payment_ref_no`";
		    if($this->db->query($query)){
		    	echo "screenshot field created.<br>";
		    }
		}
		// screenshot

		// meeting_link
		if (!$this->db->field_exists('meeting_link', 'appointments'))
		{
		    $query = "ALTER TABLE `appointments` ADD `meeting_link` VARCHAR(500) NULL AFTER `amount`";
		    if($this->db->query($query)){
		    	echo "meeting_link field created.<br>";
		    }
		}
		// meeting_link

		// face_to_face_appointment_fee
		if (!$this->db->field_exists('face_to_face_appointment_fee', 'general_master'))
		{
		    $query = "ALTER TABLE `general_master` ADD `face_to_face_appointment_fee` DECIMAL(10,2) NULL AFTER `appointment_fee`";
		    if($this->db->query($query)){
		    	echo "face_to_face_appointment_fee field created.<br>";
		    }
		}
		// face_to_face_appointment_fee

		// appointment_type
		if (!$this->db->field_exists('appointment_type', 'appointments'))
		{
		    $query = "ALTER TABLE `appointments` ADD `appointment_type` INT NOT NULL DEFAULT '1' COMMENT '1=online 2=face_to_face' AFTER `id`";
		    if($this->db->query($query)){
		    	echo "appointment_type field created.<br>";
		    }
		}
		// appointment_type


		// transaction_heads
		if (!$this->db->table_exists('transaction_heads'))
		{
		    $query = "CREATE TABLE `transaction_heads` (
					  `id` int(11) NOT NULL,
					  `name` varchar(250) NOT NULL,
					  `active` enum('1','0') NOT NULL DEFAULT '1',
					  `is_deleted` enum('DELETED','NOT_DELETED') NOT NULL DEFAULT 'NOT_DELETED',
					  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		    if($this->db->query($query)){

		    	$query = "ALTER TABLE `transaction_heads`
		    				ADD PRIMARY KEY (`id`)";
		    	$this->db->query($query);

		    	$query = "INSERT INTO `transaction_heads` (`id`, `name`, `active`, `is_deleted`, `created`, `updated`) VALUES
		    	(1, 'Appointment Fees', '1', 'NOT_DELETED', '2023-01-31 05:28:55', '2023-01-31 05:28:55'),
		    	(2, 'Medicine Fees', '1', 'NOT_DELETED', '2023-01-31 05:29:03', '2023-01-31 05:29:03')";
		    	$this->db->query($query);


		    	echo "transaction_heads table created.<br>";
		    }
		}
		// transaction_heads

		// qty_change
		if (!$this->db->field_exists('qty_change', 'shop_inventory_logs'))
		{
		    $query = "ALTER TABLE `shop_inventory_logs` ADD `qty_change` INT NOT NULL DEFAULT '0' AFTER `qty`";
		    if($this->db->query($query)){
		    	echo "qty_change field created.<br>";
		    }
		}
		// qty_change
		


		
	}

	public function get_tb($tb)
	{
		$rows = $this->db->get($tb)->result();

		echo _prx($rows);
	}
}
?>