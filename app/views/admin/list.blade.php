@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
<script>
  $(document).ready(function(){
    $('.pedidos').addClass('active');
    $('.t-pedidos').addClass('en-admin');
  });
</script>
@stop


@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row">

    <div class="data-inv">
        <table id="jsontable" class="display table table-bordered" width="100%">
          <thead>
            <tr>
              <th>Id</th>
              <th>Rol</th>
              <th>Usuario</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody id="list_user">
          </tbody>
        </table>
    </div>

  </div>
</div>




{{ HTML::script('js/accounting.min.js') }}
  <script>


  /* $.ajax( {
                "dataType": 'json',
                "type": "GET",
                "url": sSource,
                "data": aoData,
                "success": fnCallback
            } ); */


var oTable = $('#jsontable').dataTable();  //Initialize the datatable

    $.ajax({
      url: "/salidas/listarp",
      dataType: 'json',
      success: function(s){
      console.log(s);
      console.log(s[0].id);
          oTable.fnClearTable();
            for(var i = 0; i < s.length; i++) {
                           oTable.fnAddData([
                                          '<input type="button"  value="'+s[i].id+'" />',
                                          s[i].rol_id,
                                          s[i].usuario,
                                          s[i].email,
                                      ]);
                    } // End For

            

      },
      error: function(e){
         console.log(e.responseText);
      }
      });


  $('#list_user').dataTable({
    'bJQueryUI': true,
    'iDisplayLength': 100,
    'aLengthMenu': [[25, 50, 100], [25, 50, 100]],
    'fnRowCallback': function(nRow, aData, iDisplayIndex){
    $(nRow).addClass('ex_highlight');

    return nRow;
    }
    });


$('#list_user').dataTable( {
  "columnDefs": [
    { className: "my_class", "targets": [ 0 ] }
  ]
} );


    $('#list_user').dataTable( {
  "columns": [
    { className: "my_ejemplo" },

  ]
} );


 /*    dom = $('#list_user');

            $.ajax({
               "dataType": 'json',
                type: "GET",
                url: "/salidas/listarp",
                success: function (domi) {
                  console.log(domi);
                    d = "";
 
            for(datos in domi.p){

                    d += '<tr><td>'+domi.p[datos].id+'</td>';
                    d += '<td>'+domi.p[datos].rol_id+'</td>';
                    d += '<td>'+domi.p[datos].usuario+'</td>';
                    d += '<td>'+domi.p[datos].password+'</td>';
                    d += '<td>'+domi.p[datos].email+'</td></tr>';
                 }

                dom.append(d);



        },

        error: function () {
            alert("failure");
        }
    });  */
/*
$(document).ready(function(){

}); */


 /* $(function(){
     $('table.data-table.sort').dataTable( {
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
      });
     $('table.data-table.full').dataTable( {
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true,
          "sPaginationType": "full_numbers",
          "sDom": '<""f>t<"F"lp>',
          "sPaginationType": "bootstrap"
      });
  }); */


      /*    $(document).ready(function() {
            $('#example').dataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "listarp",
                "aoColumns": [
                    { "mData": null,
                      "mRender": function(edata){
                        return '<input type="button"  value="'+edata[0]+'" />';
                      }
                    },
                    { "mData": 0 },
                    { "mData": 1 }
                    
                ]
            } );
            } ); */



  </script>

@stop
