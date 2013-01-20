<?php
App::uses('Helper', 'View');

class CreateQuestionsHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

    public function form() {
        ?>
        <div class="questions form">
            <h1><?php echo __('Make your Question')?></h1>
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