<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<br/><br/><br/>
<?php echo $this->session->flashdata('msg'); ?>
<?php echo form_open('signup/form_submit'); ?>
<div class="container">
	<div class="row">
        <div class="col-md-4 col-md-offset-4">
        	<div class="form-group">
	            <h2>Signup Form</h2>
				<h5>Name</h5>
				<input id="name" type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" size="50" />
				<?php if (form_error('name')) {?>
					<div class="alert alert-danger"><?php echo form_error('name'); ?></div>
				<?php }?>
			</div>
			<div class="form-group">
			<h5>Password</h5>
			<input id="pswd" type="text" class="form-control" name="password" value="<?php echo set_value('password'); ?>" size="50" />
			<?php if (form_error('password')) {?>
				<div class="alert alert-danger"><?php echo form_error('password'); ?></div>
			<?php }?>
			</div>
			<div class="form-group">
				<h5>Confirm Password</h5>
				<input id="pswdconf" type="text" class="form-control" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />
				<?php if (form_error('passconf')) {?>
					<div class="alert alert-danger"><?php echo form_error('passconf'); ?></div>
				<?php }?>
			</div>
			<div class="form-group">
				<h5>Email Address</h5>
				<input id="email_id" type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" size="50" />
				<?php if (form_error('email')) {?>
					<div class="alert alert-danger"><?php echo form_error('email'); ?></div>
				<?php }?>
			</div>
			<div class="form-group">
				<h5>Email Address</h5>
				<input id="ip" type="hidden" class="form-control" name="ip" value='<?php echo $_SERVER['REMOTE_ADDR']?>' size="50" />				
			</div>
			<div><input type="submit" class="btn btn-default" value="Submit" /></div>
		</div>
	</div>
</div>
</body>
</html>