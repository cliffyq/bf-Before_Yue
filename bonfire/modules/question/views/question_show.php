

<p>question</p>
<?=  $question['question'] ?>
</br>
<?php  foreach  ($question['answer'] as $k=>$a): ?>
<input type='radio' name='question1'
	value=<?= $k ?>>
<?= $a?>
<?php  endforeach?>



