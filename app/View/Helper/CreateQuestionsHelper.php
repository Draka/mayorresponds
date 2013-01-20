<?php
App::uses('Helper', 'View');

class CreateQuestionsHelper extends AppHelper {

    public $helpers = array('Html', 'Form', 'Facebook.Facebook');

    public function details($question, $ext = false) {
        ?>
        <div class="marco form cleanTop50">
            <h1><?php echo __('%s\'s mayor please answer:', $question['City']['name']) ?></h1>
            <table cellpadding="0" cellspacing="0" class="tQuestion">
                <tr>
                    <td><div class="vote"><div class="num"><?php echo $question['Question']['vote_plus']; ?></div><div class="text"><?php echo $this->Html->link(__('I support'), '/questions/support/' . $question['Question']['id']) ?></div></div></td>
                    <td width="100%">

                        <div class="question">
                            <?php echo $this->Html->link($question['Question']['question'], '/questions/' . $question['Question']['id']); ?>
                        </div>
                        <div class="meta">
                            <small>by <?php echo $question['User']['name']; ?>, from <?php echo $this->Html->link($question['City']['name'], '/cities/' . $question['City']['name']); ?>. Created:  <?php echo $question['Question']['created']; ?>.</small>

                        </div>
                    </td>
                    <td><div class="report"><?php echo $this->Html->link(__('Report'), '/questions/report/' . $question['Question']['id']) ?></div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style addthis_32x32_style"
                             addthis:url="http://www.mayorresponds.org/questions/<?php echo $question['Question']['id'] ?>"
                             addthis:title="<?php echo __('Mayor of %s please answer:', $question['City']['name']) ?>"
                             addthis:description="<?php echo str_replace('"', "'", $question['Question']['question']) ?>">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                        </div>
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50fb6bb5384fffe9"></script>
                        <!-- AddThis Button END -->
                    </td>
                </tr>

            </table>
            <?php
            if ($ext && count($question['Answer'])) {
                ?>
                <h1><?php echo __('Answers') ?></h1>
                <?php foreach ($question['Answer'] as $answer): ?>
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
                <?php endforeach; ?>
                <?php
            }
            ?>
        </div>

        <?php
    }

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
                                    <?php echo $this->Html->link(sprintf('%s\'s mayor: %s', $question['City']['name'], $question['Question']['question']), '/questions/' . $question['Question']['id']); ?>
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

                echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'width' => '400'));

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
                <p>Quien no ha querido hacerle preguntas a su Alcalde? Por eso creamos este sitio, una simple y eficaz manera para preguntarle a su alcalde, Por favor sea <strong>mesurado</strong> y <strong>especifico</strong>, la ciudadania sabra agradecerlo.</p>
                <p>Who has not wanted to ask your mayor? For that We did it, A simple and efficient way to send questions to our Mayor, Please be <strong>measured</strong> and <strong>specific</strong>, the citizens will know to thank you.</p>
                <h3><a href="">Post a question now!</a></h3>
            </div>
        </div>
        <?php
    }

}
?>
