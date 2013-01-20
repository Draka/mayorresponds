<?php
App::uses('Helper', 'View');

class CreateQuestionsHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

    public function listAll($questions) {
        if (count($questions)) {
            ?>
            <div class="marco form cleanTop50">
                <h1><?php echo __('Lasted questions') ?></h1>
                <?php foreach ($questions as $question): ?>
                    <table cellpadding="0" cellspacing="0" class="tQuestion">
                        <tr>
                            <td><div class="vote"><div class="num"><?php echo $question['Question']['vote_plus']; ?></div><div class="text"><?php echo $this->Html->link(__('Vote'), '/questions/vote/' . $question['Question']['id']) ?></div></div></td>
                            <td width="100%">
                                <div class="question">
                                    <?php echo $question['Question']['question']; ?>
                                </div>
                                <div class="meta">
                                    <?php echo $question['City']['name']; ?> -
                                    <?php echo $question['City']['country_code']; ?>
                                    [<?php echo $question['Question']['created']; ?>]

                                </div>
                            </td>
                            <td><div class="report"><?php echo $this->Html->link(__('Report'), '/questions/report/' . $question['Question']['id']) ?></div></td>
                        </tr>
                        <?php
                        ?>

                    </table>
                <?php endforeach; ?>
            </div>

            <?php
        }
    }

    public function form() {
        ?>
        <div class="questions form marco">
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
                'label' => false,
            ));

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
        <?php
    }

}
?>