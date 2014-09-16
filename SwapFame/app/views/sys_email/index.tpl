<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
                    <div class="widget-forms clearfix">
                    <form id='send_push'>
                    <!--div class="control-group ">
                      <label for="form_username">Filtro</label>
                      <div class="controls">
                        <select name='filtro' id='filtro' class='span12'>
                            <option value="1">Todos os usuários</option>
                            <option value="2">Todos os usuários que já realizaram pedidos</option>
                            <option value="3">Todos os usuários que não realizaram pedidos</option>
                        </select>
                      </div>
                    </div-->

                    <div class="control-group ">
                      <label for="form_password">Título:</label>
                      <div class="controls">
                        <input type="hidden" value="1" class='span12' name='filtro' id='filtro'>
                        <input type="text" class='span12' name='titulo' id='titulo'>
                      </div>
                    </div> 
                    
                    <div class="control-group ">
                      <label for="form_password">Mensagem:</label>
                      <div class="controls">
                        <textarea style="height:200px;" name='content' rows="5" class="span12" id="editor1"></textarea>
                      </div>
                    </div>
                    <div class="alert alert-info">
                      <strong>Obs:</strong>Caso queira adicionar o nome do usuario utilize a seguinte tag {literal}{nome}{/literal}.
                  </div>
                  
                   
                  
                 
                  
                  </form>
                  </div>  
                  
                  
{literal}                   
<script>                  
function SendEmail(){
 for (instance in CKEDITOR.instances) {
    CKEDITOR.instances[instance].updateElement();
}


if($("#titulo").val() == ''){

    alert('PREENCHA UM TITULO!');
    return false;
}

if($("#editor1").val() == ''){

    alert('PREENCHA UMA MENSAGEM!');
    return false;
}


  $(".loading").show(); 
     

     
         var serial = $("#send_push").serialize();
         $.post("Email/ajaxConfigEmail", serial,
          function(data){
                 console.log(data);
            $("#status_envio").html(data);
            bindTable();
              $(".loading").hide();
          });
}


function bindTable(){

    
     /* Default class modification */
    $.extend( $.fn.dataTableExt.oStdClasses, {
      "sWrapper": "dataTables_wrapper form-inline"
    } );


    /* API method to get paging information */
    $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
    {
      return {
        "iStart":         oSettings._iDisplayStart,
        "iEnd":           oSettings.fnDisplayEnd(),
        "iLength":        oSettings._iDisplayLength,
        "iTotal":         oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
        "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
      };
    };


    /* Bootstrap style pagination control */
    $.extend( $.fn.dataTableExt.oPagination, {
      "bootstrap": {
        "fnInit": function( oSettings, nPaging, fnDraw ) {
          var oLang = oSettings.oLanguage.oPaginate;
          var fnClickHandler = function ( e ) {
            e.preventDefault();
            if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
              fnDraw( oSettings );
            }
          };

          $(nPaging).addClass('pagination').append(
            '<ul>'+
              '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
              '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
            '</ul>'
          );
          var els = $('a', nPaging);
          $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
          $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
        },

        "fnUpdate": function ( oSettings, fnDraw ) {
          var iListLength = 5;
          var oPaging = oSettings.oInstance.fnPagingInfo();
          var an = oSettings.aanFeatures.p;
          var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

          if ( oPaging.iTotalPages < iListLength) {
            iStart = 1;
            iEnd = oPaging.iTotalPages;
          }
          else if ( oPaging.iPage <= iHalf ) {
            iStart = 1;
            iEnd = iListLength;
          } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
            iStart = oPaging.iTotalPages - iListLength + 1;
            iEnd = oPaging.iTotalPages;
          } else {
            iStart = oPaging.iPage - iHalf + 1;
            iEnd = iStart + iListLength - 1;
          }

          for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
            // Remove the middle elements
            $('li:gt(0)', an[i]).filter(':not(:last)').remove();

            // Add the new list items and their event handlers
            for ( j=iStart ; j<=iEnd ; j++ ) {
              sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
              $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                .insertBefore( $('li:last', an[i])[0] )
                .bind('click', function (e) {
                  e.preventDefault();
                  oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                  fnDraw( oSettings );
                } );
            }

            // Add / remove disabled classes from the static elements
            if ( oPaging.iPage === 0 ) {
              $('li:first', an[i]).addClass('disabled');
            } else {
              $('li:first', an[i]).removeClass('disabled');
            }

            if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
              $('li:last', an[i]).addClass('disabled');
            } else {
              $('li:last', an[i]).removeClass('disabled');
            }
          }
        }
      }
    } );


    /*
     * TableTools Bootstrap compatibility
     * Required TableTools 2.1+
     */
    if ( $.fn.DataTable.TableTools ) {
      // Set the classes that TableTools uses to something suitable for Bootstrap
      $.extend( true, $.fn.DataTable.TableTools.classes, {
        "container": "DTTT btn-group",
        "buttons": {
          "normal": "btn",
          "disabled": "disabled"
        },
        "collection": {
          "container": "DTTT_dropdown dropdown-menu",
          "buttons": {
            "normal": "",
            "disabled": "disabled"
          }
        },
        "print": {
          "info": "DTTT_print_info modal"
        },
        "select": {
          "row": "active"
        }
      } );

      // Have the collection use a bootstrap compatible dropdown
      $.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
        "collection": {
          "container": "ul",
          "button": "li",
          "liner": "a"
        }
      } );
    }

    
    $('#motoboys').dataTable( {
        "bProcessing": true,  
        "sPaginationType": "bootstrap"
    } );

}


// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
    document.write(
        'Editor não foi carregado com sucesso!<br /> Por favor recarregue a pagina!' ) ;
}
else
{
var editor = CKEDITOR.replace( 'editor1',
 {
     filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
     filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
     filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
     filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
     filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
     filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
 } 
 );


    // Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
    // The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
    CKFinder.setupCKEditor( editor, '../' ) ;

    // It is also possible to pass an object with selected CKFinder properties as a second argument.
    // CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
}


</script>
{/literal}