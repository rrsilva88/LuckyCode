                    <div class="widget-forms clearfix">
                    <form id='send_push'>
                    <div class="control-group ">
                      <label for="form_username">Filtro</label>
                      <div class="controls">
                        <select name='filtro' id='filtro' class='span12'>
                            <option value="1">Todos os cadastrados</option>
                            <option value="2">Todos disponíveis</option>
                            <option value="3">Todos indisponívies</option>
                            <option value="4">Todos que fizeram corrida nos ultimos 7 dias</option>
                            
                        </select>
                      </div>
                    </div>

                    <div class="control-group ">
                      <label for="form_password">Mensagem:</label>
                      <div class="controls">
                        <textarea style="height:200px;" name='mensagem' rows="5" onkeyup="countChar(this)" class="span12"></textarea>
                      </div>
                    </div>
                    <div class="alert alert-info">
                      <strong style="width: 157px; float: left;">Caracteres Restantes:</strong><div id="charNum" style="width: 100px; float: left;">1024</div><br/>
                      <strong>Dica:</strong> Utilize a tag {literal}{nome}{/literal} caso queira que a mensagem seja enviado com o nome do motoboy o sistema irá substituir essa tag pelo nome do motoboy. 
                  </div>
                  
                   
                  
                 
                  
                  </form>
                  </div>  
                  
                  
{literal}                   
<script>                  
function SendSMS(){
  $(".loading").show();    
         var serial = $("#send_push").serialize();
         $.post("SMS/ajaxConfigSMS", serial,
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

</script>
{/literal}