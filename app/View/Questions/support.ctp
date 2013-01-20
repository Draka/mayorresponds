<?php
if ($question) {
    ?>


    <div class="questions form marco">
        <h1><?php echo __('I want to support this question for the mayor responds') ?></h1>
        <?php
        echo $this->Form->create('Support', array('url' => '/questions/support/' . $question['Question']['id']));

        echo $this->Form->input('confirm', array(
            'type' => 'hidden',
            'value' => '0'
        ));

        echo $this->Form->input('name', array(
            'type' => 'text',
            'label' => __('Your name:'),
            'class' => 'required',
            'maxlength' => 100,
            'div' => array('class' => 'input required')
        ));

        echo $this->Form->input('email', array(
            'type' => 'text',
            'label' => __('Your email:'),
            'class' => 'required',
            'maxlength' => 100,
            'div' => array('class' => 'input required'),
            'after' => '<div class="never">' . __('your name and email will never be shown.') . '</div>'
        ));

        echo $this->Form->input(__('I support'), array(
            'type' => 'submit',
            'label' => false,
        ));

        echo $this->Form->end();

        echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'width' => '400'));
        ?>
        <?php $this->start('scripts_footer') ?>
        <script>
            FB.Event.subscribe('auth.statusChange', function(response) {
                FB.api('/me', function(response) {
                    $( '#SupportName' ).val( response.name );
                    $( '#SupportEmail' ).val( response.email );
                    $( '#SupportConfirm' ).val( 1 );
                });
            },true);
        </script>
        <?php $this->end() ?>

    </div>
    <div class="cleanButtom50"></div>
    <?php
    $this->CreateQuestions->details($question, true);
} else {
    $this->CreateQuestions->form();
}
?>
