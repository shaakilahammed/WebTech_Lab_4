<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>LabTask-4</title>
</head>
<body>

	<?php
		class User{
			private $name;
			private $email;
			private $date;
			private $exam;
			private $gender;
			private $bloodGroup;
		
		
			function __construct(){
				$name="";
				$email="";
				$date="";
				
				$exam="";
				$gender="";
				$bloodGroup="";
			}
			function set_name($nam){
				$this->name=$nam;
			}
			function get_name(){
				return $this->name;
			}
			
			function set_email($email){
				$this->email=$email;
			}
			function get_email(){
				return $this->email;
			}
			
			function set_date($date){
				$this->date=$date;
			}
			function get_date(){
				return $this->date;
			}
			
			function set_exam($exam){
				$this->exam=$exam;
			}
			function get_exam(){
				return $this->exam;
			}
			
			function set_gender($gender){
				$this->gender=$gender;
			}
			function get_gender(){
				return $this->gender;
			}
			
			function set_bloodGroup($bloodGroup){
				$this->bloodGroup=$bloodGroup;
			}
			function get_bloodGroup(){
				return $this->bloodGroup;
			}
			
			
		
		}
		$user=new User();
		
		$nameErr = $emailErr = $dateErr=$examErr= $genderErr=$bgErr= $monthErr = $yearErr = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["name"])){
				$nameErr = "Name is required";
			} 
			else {
				$user->set_name($_POST["name"]);
			}
			if (empty($_POST["email"])){
				$emailErr = "Email is required";
			} 
			else {
				$user->set_email($_POST["email"]);
			}
			
			if (empty($_POST["date"])){
				$dateErr = "Date is required";
			} 
			else {
				$user->set_date($_POST["date"]);
			}
			
			
			if (empty($_POST["gender"])){
				$genderErr = "Gender is required";
			} 
			else {
				$user->set_gender($_POST["gender"]);
			}
			
			if (($_POST["bloodGroup"])=="none"){
				$bgErr = "BloodGroup is required";
			} 
			else {
				$user->set_bloodGroup($_POST["bloodGroup"]);
			}
			
			if (empty($_POST["ssc"]) || empty($_POST["hsc"])){
				$examErr = "SSC and HSC are requird";
			} 
			else {
				
				$examm = $_POST["ssc"].",".$_POST["hsc"];
				$user->set_exam($examm);
				if(!empty($_POST["bsc"]))
				{
					$exam =$user->$get_exam().", ".$_POST["bsc"];
					$user->set_exam($examm);
				}
					
				
				if(!empty($_POST["msc"]))
				{
					$exam =$user->$get_exam().", ".$_POST["msc"];
					$user->set_exam($examm);
				}
			}
			
			
		}
		
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<td><b>Name :</b></td>
				<td><input type="text" name="name"/></td>
				<td><span style="color:red;">* <?php echo $nameErr;?></span></td>
			</tr>
			<tr>
				<td><b>Email :</b></td>
				<td><input type="email" name="email"/></td>
				<td><span style="color:red;">* <?php echo $emailErr;?></span></td>
			</tr>
			<tr>
				<td><b>Date of Birth :</b></td>
				<td><input type="Date" name="date"/></td>
				<td><span style="color:red;">* <?php echo $dateErr;?></span></td>
			</tr>
			<tr>
				<td><b>Gender :</b></td>
				<td>
					<input type="radio" value="Male" name="gender"/>Male
					<input type="radio" value="Female" name="gender"/>Female
					<input type="radio" value="Other" name="gender"/>Others</td>
				<td><span style="color:red;">* <?php echo $genderErr;?></span></td>
			</tr>
			<tr>
				<td><b>Degree :</b></td>
				<td>
					<input type="checkbox" name="ssc" value="SSC"/>SSC
					<input type="checkbox" name="hsc" value="HSC"/>HSC
					<input type="checkbox" name="bsc" value="BSC"/>BSC
					<input type="checkbox" name="msc" value="MSC"/>MSC
				</td>
				<td><span style="color:red;">* <?php echo $examErr;?></span></td>
			</tr>
			<tr>
				<td><b>Blood Group :</b></td>
				<td>
					<select name="bloodGroup">
						<option value="none"></option>
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
					</select>
				</td>
				<td><span style="color:red;">* <?php echo $bgErr;?></span></td>
			</tr>
			<tr>
				<td align="center" ><input type="submit" value="Submit form" name="submit" id="sform"/></td>
				
				<td align="center"><input type="submit" value="Submit xml" name="submit" id="sxml"/></td>
				<td align="center"><input type="submit" value="Submit file" name="submit" id="sfile"/></td>
				
			</tr>
			
		</table>
		
		<hr/>
		
		
		
		
		
		
		
		
		
		
	</form>
	<br><br>
	<?php
	if($user->get_name()!="" && $user->get_email()!="" && $user->get_date()!="" && $user->get_exam()!="" && $user->get_gender()!="" && $user->get_bloodGroup()!="")
		{
			if($_POST["submit"]=="Submit form")
			{
				echo "<h3> Name :". $user->get_name()."</h3>";
				echo "<h3>Email :". $user->get_email()."</h3>";
				echo "<h3>Date of Birth :". $user->get_date()."</h3>";
				echo "<h3>Gender :". $user->get_gender()."</h3>";
				echo "<h3>Degree :". $user->get_exam()."</h3>";
				echo "<h3>Blood group :". $user->get_bloodGroup()."</h3>";
				echo "<hr/>";
			}
			
			elseif($_POST["submit"]=="Submit file")
			{
				$filename=$user->get_name().".txt";
				$myfile = fopen($filename, "w") or die("Unable to open file!");
				
				$txt = "Name :".$user->get_name()."\n";
				fwrite($myfile, $txt);
				
				$txt = "Email :".$user->get_email()."\n";
				fwrite($myfile, $txt);
				
				$txt = "Date of Birth :". $user->get_date()."\n";
				fwrite($myfile, $txt);
				
				$txt = "Gender :". $user->get_gender()."\n";
				fwrite($myfile, $txt);
				
				$txt = "Degree :". $user->get_exam()."\n";
				fwrite($myfile, $txt);
				
				$txt = "Blood group :". $user->get_bloodGroup()."\n";
				fwrite($myfile, $txt);
				
				
				
				fclose($myfile);
				
				echo "<h2>"."Read From File"."</h2>";
				
				$myfile = fopen($filename, "r") or die("Unable to open file!");
				
				while(!feof($myfile)) {
					echo fgets($myfile) . "<br>";
				}
				fclose($myfile);
			
			}
		
			else
			{
				//XML file
				$dom = new DOMDocument();

				$dom->encoding = 'utf-8';

				$dom->xmlVersion = '1.0';

				$dom->formatOutput = true;

				$xml_file_name = 'users_list.xml';

					$root = $dom->createElement('users');

					$user_node = $dom->createElement('user');

					$attr_user_id = new DOMAttr('user_id', '5467');

					$user_node->setAttributeNode($attr_user_id);
					
					

					$child_node_name = $dom->createElement('name', $user->get_name());

					$user_node->appendChild($child_node_name);
					

					$child_node_email = $dom->createElement('email', $user->get_email());

					$user_node->appendChild($child_node_email);
					
					
					$child_node_dob = $dom->createElement('email', $user->get_date());

					$user_node->appendChild($child_node_dob);
					
					
					
					$child_node_gender = $dom->createElement('email', $user->get_date());

					$user_node->appendChild($child_node_gender);
					
					$child_node_degree = $dom->createElement('email', $user->get_exam());

					$user_node->appendChild($child_node_degree);
					
					$child_node_bg = $dom->createElement('email', $user->get_bloodGroup());

					$user_node->appendChild($child_node_bg);
				

					$root->appendChild($user_node);

					$dom->appendChild($root);

				$dom->save($xml_file_name);

				echo "$xml_file_name has been successfully created";
			}
			
			
		}
		
	?>
	
</body>
</html>