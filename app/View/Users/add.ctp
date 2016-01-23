<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Adicionar Usuário'); ?></legend>
        <?php echo $this->Form->input('username',array(
        		'label'=>'Usuário'
        	));
        echo $this->Form->input('password',array(
        		'label'=>'Senha'
        ));
        echo $this->Form->input('role', array(
        	'label'=>'Tipo de Usuário',
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>