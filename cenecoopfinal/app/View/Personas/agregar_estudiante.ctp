
<div class="personas form">
<?php echo $this->Form->create('Persona'); ?>
	
	<fieldset>
        <legend><?php echo __('Registro Estudiante'); ?></legend>
        <?php 
		
		echo $this->Form->input('cedula', array('type' => 'text', 'label' => 'Cédula'));
		echo $this->Form->input('nombre', array('type' => 'text', 'label' => 'Nombre'));
		echo $this->Form->input('apellido1', array('type' => 'text', 'label' => 'Primer apellido'));
		echo $this->Form->input('apellido2', array('type' => 'text', 'label' => 'Segundo apellido'));
		echo $this->Form->input('telefono', array('type' => 'text', 'label' => 'Número telefónico'));
		echo $this->Form->input('nacionalidad', array('type' => 'text', 'label' => 'Nacionalidad'));
		echo $this->Form->input('edad', array('type' => 'text', 'label' => 'Edad'));
        
		echo __('Fecha de nacimiento:<br><br>');
		
		echo $this->Form->year('ano', 1940, date('Y'));
		echo $this->Form->month('mes');
		echo $this->Form->day('dia');
		echo __('<br><br>');
		
		/*
		echo $this->Form->input('ano', array('label' => 'Año',
                                                    'type' => 'date',
                                                    'dateFormat' => 'Y',
                                                    'empty' => true,
                                                    'minYear' => 1940, // Año inicial
                                                    'maxYear' => date('Y'), // Año actual 
													'required'=>'true', 
													'allowEmpty' => 'false'
                                                    ));
													
		echo $this->Form->input('mes', array('label' => 'Mes',
                                                    'type' => 'date',
                                                    'dateFormat' => 'M',
                                                    'empty' => true,
													'required'=>'true', 
													'allowEmpty' => 'false'
                                                    ));
													
		echo $this->Form->input('dia', array('label' => 'Día',
                                                    'type' => 'date',
                                                    'dateFormat' => 'D',
                                                    'empty' => true,
													'required'=>'true', 
													'allowEmpty' => 'false'
                                                    ));
		*/
		
		echo $this->Form->input('fechanacimiento', array('type' => 'hidden', 'value' => '0000-00-00'));
		
		echo $this->Form->input('genero', array(
            'options' => array('m' => 'Masculino', 'f' => 'Femenino'),
			'label' => 'Género'
        ));
		
		echo $this->Form->input('rol', array('type' => 'hidden', 'value' => 'Estudiante'));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Continuar')); ?>
</div>