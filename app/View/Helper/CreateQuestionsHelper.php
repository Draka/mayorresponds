<?php
App::uses('Helper', 'View');

class CreateQuestionsHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

    public function form() {
        ?>
        <div class="questions form">
            <?php
            echo $this->Form->create('Question', array('url' => 'question/add'));

            echo $this->Form->input('city', array(
                'type' => 'text',
                'value' => isset($form['title']) ? $form['title'] : '',
                'label' => __('City:'),
                'class' => 'required',
                'maxlength' => 50,
                'div' => array('class' => 'input required')
            ));
            echo $this->Form->end(__('Post your question'));
            ?>
            <div class="ui-widget" style="margin-top: 2em; font-family: Arial;">
                Result:
                <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
            </div>
            <script>
                $(function() {
                    function log( message ) {
                        $( "<div>" ).text( message ).prependTo( "#log" );
                        $( "#log" ).scrollTop( 0 );
                    }

                    $( "#QuestionCity" ).autocomplete({
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
                                            value: item.name
                                        }
                                    }));
                                }
                            });
                        },
                        minLength: 2,
                        select: function( event, ui ) {
                            log( ui.item ?
                                "Selected: " + ui.item.label :
                                "Nothing selected, input was " + this.value);
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