<?php

//echo $this->Facebook->login(array('perms' => 'email,publish_stream'));
$this->CreateQuestions->form();

$this->CreateQuestions->listAll($questions);

$this->start( 'scripts_footer' );

?>

<script>
    FB.Event.subscribe('auth.statusChange', function(response) {
        console.log( 'We are logging' );
        FB.api('/me', function(response) {
            $( '#QuestionName' ).val( response.name );
            $( '#QuestionEmail' ).val( response.email );
            $( '#QuestionDisplayForm input[type="submit"]' ).show();
            console.log('Good to see you, ' + response.name + '.', response );
        });
    },true);
</script>

<?php
$this->end();
