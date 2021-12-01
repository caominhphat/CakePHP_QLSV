<?php
echo $this->Form->create('Students');
foreach ($students as $student){
      echo $this->Form->input('name',array('type'=>'text','name'=>'name','value'=>$student['students']['name']));
?>
<div class="form-group">
	<label>Birthday</label>
	<input type="date" class="form-control" value="<?php echo $student['students']['birthday'] ?>" required name="birthday">
</div>
	<select name="gender" id="">
		<option value="1" <?php echo $student['genders']['id'] == 1 ? "selected" : ""?> >Nam</option>
		<option value="2" <?php echo $student['genders']['id'] == 2 ? "selected" : ""?> >Nữ</option>
	</select>
<?php
    echo $this->Form->input('Submit',array('type'=>'submit','name'=>'submit'));
    echo $this->Form->end();
}
?>
