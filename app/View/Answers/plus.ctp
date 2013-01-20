<div class="questions form marco cleanTop50">
    <h1><?php echo __('I agree, this is the correct answer') ?></h1>
    <?php
    echo $this->Form->create('Vote', array('url' => '/plus/' . $answer['id']));

    echo $this->Form->input('name', array(
        'type' => 'text',
        'label' => __('Your name:'),
        'class' => 'required',
        'maxlength' => 100,
        'div' => array('class' => 'input required')
    ));

    echo $this->Form->input('confirm', array(
        'type' => 'hidden',
        'value' => '0'
    ));

    echo $this->Form->input('email', array(
        'type' => 'text',
        'label' => __('Your email:'),
        'class' => 'required',
        'maxlength' => 100,
        'div' => array('class' => 'input required')
    ));

    echo $this->Form->input(__('Vote YES'), array(
        'type' => 'submit',
        'label' => false,
    ));

    echo $this->Form->end();
    echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'width' => '400'));
    ?>
</div>
<?php $this->start('scripts_footer'); ?>

<script>
    FB.Event.subscribe('auth.statusChange', function(response) {
        FB.api('/me', function(response) {
            $( '#VoteName' ).val( response.name );
            $( '#VoteEmail' ).val( response.email );
            $( '#VoteConfirm' ).val( 1 );
        });
    },true);
</script>

<?php
$this->end();
?>
<div class="cleanButtom50"></div>
<?php
$this->CreateQuestions->details($question);
?>
<div class="marco form cleanTop50">
    <h1><?php echo __('Answer') ?></h1>
    <table cellpadding="0" cellspacing="0" class="tAnswer">
        <tr>
            <td><div class="vote"><div class="num"><?php echo $answer['vote_plus']; ?></div><div class="text"><?php echo $this->Html->link(__('Yes'), '/plus/' . $answer['id']) ?></div></div></td>
            <td><div class="vote vote_no"><div class="num"><?php echo $answer['vote_minus']; ?></div><div class="text"><?php echo $this->Html->link(__('No'), '/minus/' . $answer['id']) ?></div></div></td>
            <td width="100%">
                <div class="answer">
                    <?php echo $answer['comment']; ?>
                </div>
                <div class="url">
                    <?php echo $this->Html->link($answer['url'], $answer['url'], array('target' => '_blank')); ?>
                </div>
                <div class="meta">
                    [<?php echo $answer['created']; ?>]

                </div>
            </td>
            <td><div class="report"><?php echo $this->Html->link(__('Report'), '/answers/report/' . $answer['id']) ?></div></td>
        </tr>

    </table>
</div>