<?php 
class database{
	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "testing";
	var $koneksi;

	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}


	function register($username,$password,$name)
	{	
		$insert = mysqli_query($this->koneksi,"insert into tb_user values ('','$username','$password','$name')");
		return $insert;
	}

	function login($username,$password,$remember)
	{
		$query = mysqli_query($this->koneksi,"select * from tb_user where username='$username'");
		if(mysqli_num_rows($query) == 0){
			echo '<div class="alert alert-danger">Upss...!!! Username tidak ditemukan.</div>';
		}
		else {
			$data_user = $query->fetch_array();
			if(password_verify($password,$data_user['password']))
			{
				
				if($remember)
				{
					setcookie('username', $username, time() + (60 * 60 * 24 * 5), '/');
					setcookie('name', $data_user['name'], time() + (60 * 60 * 24 * 5), '/');
				}
				$_SESSION['username'] = $username;
				$_SESSION['name'] = $data_user['name'];
				$_SESSION['is_login'] = TRUE;
				return TRUE;
			}
			else {
				echo '<div class="alert alert-danger">Upss...!!! Password salah.</div>';
			}
		}
		
	}

	function relogin($username)
	{
		$query = mysqli_query($this->koneksi,"select * from tb_user where username='$username'");
		$data_user = $query->fetch_array();
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $data_user['name'];
		$_SESSION['is_login'] = TRUE;
	}
} 


?>