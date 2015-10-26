Выберите статью из выподающего списка<br>
<select name="linkpunkta">
	<?php 
	$result=mysql_query("SELECT * FROM news");
	$myrow=mysql_fetch_array($result);
	do
	{
	?>
	<option value="<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[name]"; ?></option>
	<?php 
	}
	while($myrow=mysql_fetch_array($result));
	?>
</select><br>
<input name="tip" type="hidden" value="itemnews">