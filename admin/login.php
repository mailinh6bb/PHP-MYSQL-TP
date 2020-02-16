<?php 
require_once __DIR__.'/autoload/autoload.php';
$error = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'email' => postInput('email'),
		'password' => md5(postInput('password')),
	];
	// bắt lỗi input
	if (postInput('email') == '') {
		$error['email'] = 'Vui lòng nhập email!';
	}
	if (postInput('password') == '') {
		$error['password'] = 'Vui lòng nhập mật khẩu!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
		$email = $data['email'];
		$password = $data['password'];
		$sql = "SELECT * FROM user WHERE email = '$email'  AND password = '$password'";
		$issetUser = $db -> fetchsql($sql);
		if ($issetUser != NULL) {
			foreach ($issetUser as $value) {
				if ($value['email']) {
					$_SESSION['name'] = $value['name'];
					$_SESSION['name_id'] = $value['id'];
					header("location:".base_url()."/admin/");
					exit();
				}
				else {
					$_SESSION['error'] = 'Đăng Nhập Không Thành Công';
				}
			}
			
		}
		else {
			$_SESSION['error'] = 'Tài khoản hoặc mật khẩu của bạn không đúng!';
		}
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Đăng nhập hệ thống</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/admin/css/login.css">		
	<style type="text/css">
		.required
		{
			color:red;
			font-size:11px;
			padding-top:7px;
		}
	</style>
	<meta name='' content=''>
</head>
<body>	

	<div class="table_div">
		<form name="frmlogin" method="POST">			
			<table>				
				<tr>
					<td colspan="2" class="title">Đăng nhập hệ thống</td>
				</tr>
				<tr>
					<td><strong>Tài khoản</strong></td>
					<td><input type="text" name="email" value="" placeholder="email">
					</td>
				</tr>
				<tr>
					<td><strong>Mật khẩu</strong></td>
					<td><input type="password" name="password" value="" placeholder="mật khẩu">	

					</td>
				</tr>
				<tr><td colspan="2"><input type="submit" name="submit" value="Đăng nhập"></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>