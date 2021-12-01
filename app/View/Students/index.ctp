
<h1 class="text-center">Danh sách sinh viên</h1>
<?= $this->Html->link('Add Student', array('controller'=>'students','action'=>'add')) ?>
<form action="" method="GET">
	<label class="form-inline justify-content-end">Tìm kiếm: <input type="search" name="search" class="form-control" value="">
		<button class="btn btn-danger">Tìm</button>
	</label>

</form>
<table class="table table-hover">
	<thead>
	<tr>
		<th>#</th>
		<th>Mã SV</th>
		<th>Tên</th>
		<th>Ngày Sinh</th>
		<th>Giới Tính</th>
		<th></th>
		<th></th>
	</tr>
	</thead>
	<tbody>

	<?php $i = 0;
	foreach($students as $student){
		$i++;?>
		<tr>
			<td><?= $i; ?></td>
			<td><?= $student['Student']['id']; ?></td>
			<td><?= $student['Student']['name']; ?></td>
			<td><?= $this->App->DateValid($student['Student']['birthday']); ?></td>
			<td><?= $student['genders']['gender']; ?></td>
			<td><?= $this->Html->link('Edit', array('controller'=>'students','action'=>'edit',$student['Student']['id']))?></td>
			<td><?= $this->Html->link('Delete', array('controller'=>'students','action'=>'delete',$student['Student']['id']),array())?></td>
		</tr>
	<?php } ;?>

	</tbody>
</table>
<div>
	<span>Số lượng: <?= $i; ?></span>
</div>
<div class="text-right">
	<?php
	echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
	echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
	echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
	echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
	?>
</div>

