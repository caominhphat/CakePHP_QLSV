<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->script('bootstrap.min.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">

		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>
			<div style="text-align: right;">
				<?php  if($current_user): ?>
					Welcome <?php echo $current_user['username'];?>. <?php echo $this->Html->link("logout",array('controller'=>'users','action'=>'logout'));?>

				<?php else:?>
					<?php echo $this->Html->link("login",array('controller'=>'users','action'=>'login'));?>
				<?php endif;?>
				<br>
				<?php echo $this->Html->link('Go to User page',array('controller'=>'users','action'=>'login'))?>
				<br>
				<?php echo $this->Html->link('Go to Student List',array('controller'=>'students','action'=>'index'))?>

			</div>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>

</body>
</html>
