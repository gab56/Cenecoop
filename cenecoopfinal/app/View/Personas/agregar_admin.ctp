<div class="personas form">
<?php echo $this->Form->create('Persona'); ?>
	
	<fieldset>
        <legend><?php echo __('Registro Administrador'); ?></legend>
        <?php 
		echo $this->Form->input('cedula', array('type' => 'text', 'label' => 'Cedula'));
		echo $this->Form->input('nombre', array('type' => 'text', 'label' => 'Nombre'));
		echo $this->Form->input('apellido1', array('type' => 'text', 'label' => 'Primer apellido'));
		echo $this->Form->input('apellido2', array('type' => 'text', 'label' => 'Segundo apellido'));
		echo $this->Form->input('telefono', array('type' => 'text', 'label' => 'Numero telefonico'));
		echo $this->Form->input('nacionalidad', array('type' => 'text', 'label' => 'Nacionalidad'));
		echo $this->Form->input('edad', array('type' => 'text', 'label' => 'Edad'));
        echo $this->Form->input('genero', array(
            'options' => array('m' => 'Masculino', 'f' => 'Femenino'),
			'label' => 'Genero'
        ));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Continuar')); ?>
</div>