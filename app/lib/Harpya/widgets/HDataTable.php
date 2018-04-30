<?php

/**
 * 
 */

class HDataTable extends TElement
{
  private $headers;
  private $props = [] ;
  private $items = [];

    public function __construct($title,$header)
    {
        parent::__construct('div');
        $this->id = 'app';
        $this->style = 'width: 100% !important ';

        $this->headers($header);
        $this->add("
        <template>
  <v-card>
    <v-card-title>
      $title
      <v-spacer></v-spacer>
      <v-text-field
        append-icon='search'
        label='Buscar'
        single-line
        hide-details
        v-model='search'
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers='headers'
      :items='items'
      :search='search'
    >
      <template slot='items' slot-scope='props'>
      $this->headers
      </template>
      <v-alert slot='no-results' :value='true' color='error' icon='warning'>
        Your search for '{{ search }}' found no results.
      </v-alert>
    </v-data-table>
  </v-card>
</template>"
    
    );
 }

 public function addItem($item){

  $this->items[] = $item;
 }

 private function headers($headers){

  $this->headers = "";

  foreach($headers as $h){
    $this->headers .= " <td class='text-xs-right'>{{ props.item.$h }}</td>";
  }
 }

 /*
 text: 'Label usado',
 align: 'left', 
 sortable: false, 
 value: 'name'
*/
  public function addProps($props){

      $this->props[] =  $props;
}


    public function show(){

      $item = json_encode($this->items);
      $props = json_encode($this->props);

      
       TScript::create("
        new Vue({
            el: '#app',
            data () {
              return {
                search: '',
                headers: $props,
                items: $item 
              }
            }
          });
        
        ");
        parent::show();
    }

}