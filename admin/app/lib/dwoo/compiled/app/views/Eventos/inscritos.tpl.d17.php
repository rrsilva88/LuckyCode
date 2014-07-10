<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="users">
    <thead>
        <tr>
        <?php 
$_fh0_data = (isset($this->scope["titulos"]) ? $this->scope["titulos"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['titulo'])
	{
/* -- foreach start output */
?>
            <th width="25%"><?php echo $this->scope["titulo"]["nome"];?></th>
        <?php 
/* -- foreach end output */
	}
}?>    
        </tr>
    </thead>
    <tbody>
    
        <?php 
$_fh2_data = (isset($this->scope["inscritos"]) ? $this->scope["inscritos"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['registro'])
	{
/* -- foreach start output */
?>
            <tr>
                <?php 
$_fh1_data = (isset($this->scope["titulos"]) ? $this->scope["titulos"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['titulo'])
	{
/* -- foreach start output */
?>
                <?php $this->scope["campo"]=(isset($this->scope["titulo"]["id"]) ? $this->scope["titulo"]["id"]:null)?>

                    <td><?php if ($this->readVar("registro.campos.".(isset($this->scope["campo"]) ? $this->scope["campo"] : null).".valor")) {

echo $this->readVar("registro.campos.".(isset($this->scope["campo"]) ? $this->scope["campo"] : null).".valor");

}
else {
?> <?php 
}?></td>
                <?php 
/* -- foreach end output */
	}
}?>    
                
            </tr>
        <?php 
/* -- foreach end output */
	}
}?>    
    </tbody>
</table> 

<style>

.dataTables_length {
    float: left;
    width: 400px;
}

.dataTables_filter {
    float: right;
    text-align: right;
}
.dropdown-menu li{
    text-align:left;
}

</style>

<script>
$(document).ready(function() {
    
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

    
    $('#users').dataTable( {
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
           
           }
       }
    } );
} );
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>