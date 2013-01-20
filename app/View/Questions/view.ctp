<?php
if ($question) {
    $this->CreateQuestions->details($question, true);
    ?>


    <div class="questions form marco cleanTop50">
        <h1><?php echo __('Do you think this question has already been answered?') ?></h1>
        <?php
        echo $this->Form->create('Answer', array('url' => '/answers/add'));

        echo $this->Form->input('question_id', array(
            'type' => 'hidden',
            'value' => $question['Question']['id']
        ));

        echo $this->Form->input('confirm', array(
            'type' => 'hidden',
            'value' => '0'
        ));

        echo $this->Form->input('comment', array(
            'type' => 'text',
            'label' => __('Comment:'),
            'class' => 'required',
            'div' => array('class' => 'input required')
        ));

        echo $this->Form->input('url', array(
            'type' => 'text',
            'label' => __('Url:'),
            'class' => 'required',
            'div' => array('class' => 'input required')
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

        echo $this->Form->input(__('Post anwser'), array(
            'type' => 'submit',
            'label' => false,
        ));

        echo $this->Form->end();

        echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'width' => '400'));
        ?>
    </div>
    <?php $this->start('scripts_footer') ?>
    <script>
        FB.Event.subscribe('auth.statusChange', function(response) {
            FB.api('/me', function(response) {
                $( '#AnswerName' ).val( response.name );
                $( '#AnswerEmail' ).val( response.email );
                $( '#AnswerConfirm' ).val( 1 );
            });
        },true);
    </script>
    <?php $this->end() ?>
    <?php
} else {
    $this->CreateQuestions->form();
}
?>
