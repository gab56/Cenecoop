
<div class="estudiantes form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Registro Estudiante:<br>Crear una cuenta'); ?></legend>
        <?php 
        
		echo $this->Form->input('username', array('type' => 'text','label' => 'Correo'));
		echo $this->Form->input('password', array('type' => 'password', 'label' => 'Contraseña'));
		echo $this->Form->input('repassword', array('type' => 'password', 'label' => 'Confirmar Contraseña', 'required'=>'true', 'allowEmpty' => 'false'));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Registrarse')); ?>
</div>