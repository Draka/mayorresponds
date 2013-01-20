<?php
App::uses('Helper', 'View');

class CreateQuestionsHelper extends AppHelper {

    public $helpers = array('Html', 'Form', 'Facebook.Facebook');

    public function listAll($questions) {
        if (count($questions)) {
            ?>
            <div class="marco right-col">
                <h1><?php echo __('Lasted questions') ?></h1>
                <?php foreach ($questions as $question): ?>
                    <table cellpadding="0" cellspacing="0" class="tQuestion">
                        <tr>
                            <td><div class="vote"><div class="num"><?php echo $question['Question']['vote_plus']; ?></div><div class="text"><?php echo $this->Html->link(__('I support'), '/questions/support/' . $question['Question']['id']) ?></div></div></td>
                            <td width="100%">

                                <?php
                                if (count($question['Answer'])) {
                                    ?>
                                    <div class="answer">
                                        <i><?php echo __('This question has one or more answers, click inside to read more.') ?></i>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="question">
                                    <?php echo $this->Html->link(sprintf( '%s\'s mayor: %s',  $question['City']['name'], $question['Question']['question']), '/questions/' . $question['Question']['id']); ?>
                                </div>
                                <div class="meta">
                                    <small>by <?php echo $question['User']['name']; ?>, from <?php echo $question['City']['country_code']; ?>. Created:  <?php echo $question['Question']['created']; ?>.</small>
                                </div>
                            </td>
                            <td><div class="report"><?php echo $this->Html->link(__('Report'), '/questions/report/' . $question['Question']['id']) ?></div></td>
                        </tr>

                    </table>
                <?php endforeach; ?>
            </div>

            <?php
        }
    }

    public function form() {
        ?>
        <div class="question-wrapper">
            <div class="questions marco">
            <h1><?php echo __('Make your Question') ?></h1>
            <?php
            echo $this->Form->create('Question', array('url' => '/questions/add'));

            echo $this->Form->input('search_city', array(
                'type' => 'text',
                'label' => __('City:'),
                'class' => 'required',
                'maxlength' => 50,
                'after' => '<div id="cleanCity" class="hide clean">[Remove]</div>',
                'div' => array('class' => 'input required')
            ));

            echo $this->Form->input('city', array(
                'type' => 'hidden',
                'value' => ''
            ));

            echo $this->Form->input('confirm', array(
                'type' => 'hidden',
                'value' => '0'
            ));

            echo $this->Form->input('question', array(
                'type' => 'textarea',
                'label' => __('Question:'),
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
                'div' => array('class' => 'input required')
            ));


            echo $this->Form->input(__('Post your question'), array(
                'type' => 'submit',
                'label' => false
            ));

            echo $this->Facebook->login(array('perms' => 'email,publish_stream'));

            echo $this->Form->end();
            ?>
            <script>
                $(document).ready(function () {

                    $("#cleanCity").click(function(event){
                        $("#QuestionSearchCity").val("");
                        $("#QuestionCity").val("");
                        $("#QuestionSearchCity").removeAttr('disabled');
                        $(this).hide();

                    });
                });
                $(function() {
                    function log( message ) {
                        $( "<div>" ).text( message ).prependTo( "#log" );
                        $( "#log" ).scrollTop( 0 );
                    }

                    $( "#QuestionSearchCity" ).autocomplete({
                        source: function( request, response ) {
                            $.ajax({
                                url: "http://ws.geonames.org/searchJSON",
                                dataType: "jsonp",
                                data: {
                                    featureClass: "P",
                                    style: "full",
                                    maxRows: 5,
                                    name_startsWith: request.term
                                },
                                success: function( data ) {
                                    response( $.map( data.geonames, function( item ) {
                                        return {
                                            label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                            value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                            data: item
                                        }
                                    }));
                                }
                            });
                        },
                        minLength: 2,
                        select: function( event, ui ) {
                            if(ui.item){
                                $("#QuestionCity").val(JSON.stringify(ui.item.data));
                                $("#QuestionSearchCity").attr('disabled', 'disabled');
                                $("#cleanCity").show();
                            }else{
                                $("#QuestionCity").val("");
                            }
                        },
                        open: function() {
                            $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                        },
                        close: function() {
                            $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                        }
                    });
                });
            </script>
            </div>
            <div class="instructions marco">
                <h2>How it works</h2>
                <p>Quien no ha querido hacerle preguntas a su Alcalde? Por eso creamos esto para ti, un simple u eficaz manera de dirigir nuestras inquietudes de una forma directa a nuestro alcalde, Por favor sea mesurado y especifico, la ciudadania sabra agradecerlo.</p>
                <p>Who has not wanted to ask your mayor? For that We did it, A simple and efficient way to send questions to our Mayor, Please be measured and specific, the citizens will know to thank you.</p>
                <h3><a href="">Post a question now!</a></h3>
            </div>
        </div>    
        <?php
    }

}
?>
