<div><label>First Name</label> 
	<input id = 'first_name' type = 'text'></input>
</div>

<div><label>Last Name</label> 
	<input id = 'first_name' type = 'text'></input>
</div>

<div><label>Gender</label><select>
	<option value="">Please select your gender:</option>
	<option value="0">Female</option>
	<option value="1">Male</option>
</select></div>

<div><label>Birth Month</label> <select>
	<?php for($i=1; $i<=12; $i++){
		echo "<option value='$i'>$i</option>";
		}
	?></select></div>
	
<div><label>Birth Year</label> <select>
	<?php for($i=date('Y'); $i>= date('Y')-100; $i--){
		echo "<option value='$i'>$i</option>";
		}
	?></select></div>
	
<div><label>Race</label><select>
	<option value="0">Black or African American </option>
	<option value="1">White</option>
	<option value="2">American Indian or Alaskan Native</option>
	<option value="3">Hispanic or Latino</option>
	<option value="4">Asian or Pacific Islander</option>
	<option value="5">Other</option>
	</select></div>

<div><label>Education</label><select>
	<option value="0">PhD </option>
	<option value="1">Master</option>
	<option value="2">Bachelor</option>
	<option value="3">High School</option>
	<option value="5">Other</option>
</select></div>

<div><label>Veteran</label>
	<input type="checkbox">Yes</input>
</div>

<div><label>Zipcode</label>
	<input type="text"></input>
</div>

<div><label>Industry</label><select>
	<option value="0">Sports </option>
	<option value="1">Business</option>
	<option value="2">Technology</option>
	<option value="3">Science</option>
	<option value="5">Education</option>
	<option value="6">Other</option>
</select></div>

<div><label>Occupation</label><select>
	<option value="0">Manager</option>
	<option value="1">Teacher</option>
	<option value="2">Journalist</option>
	<option value="5">Other</option>
</select></div>