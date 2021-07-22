
		<div class="flat_area grid_16">
							<h2>Plantillas <small>(<strong>nota:</strong> estos son los modelos de impresiones para cualquier reporte) </small>
								<div class='holder'>
		<button data-dialog="dialog_form" title='Nuevo' class="orange dialog_button circle ">
														<img src="images/icons/small/grey/create_write.png">
													Agregar
													</button>
		</div>
							</h2>

			<div class="box grid_16 single_datatable">
				<div id="tabla" class="no_margin">
				    <table id='tabla_plantillas' class=' datatable'>
				    <thead>
					<tr>
						<th>Nombre Plantilla</th>
						<th>Acciones</th>
					</tr>	
					<thead>
					<tbody>
				<?php $data=$model->findAll();
				 foreach($data as $plant){?>
					<tr id='row_<?=$plant->id; ?>'>
						<td><?=$plant->titulo;?></td>
						<td>
		<button title='Modificar' class="light  tiny icon_only img_icon">
														<img src="images/icons/small/grey/pencil.png">
													</button>
							<button title='Quitar' data-dialog="dialog_delete" onclick='seleccionar(<?=$plant->id?>)' class="light dialog_button tiny icon_only img_icon">
														<img src="images/icons/small/grey/trashcan.png">
													</button>
													

												</td>
					</tr>	

				<? }?>
					</tbody>
				</table>
				</div>

			</div>
			<script>
			var seleccion;
			var table1 = $('#tabla .datatable').dataTable( {
				"bJQueryUI": true,
				"sScrollX": "",
				"bSortClasses": false,
				"aaSorting": [[0,'asc']],
				"bAutoWidth": true,
				"bInfo": true,
				"bServerSide": true,
    "sAjaxSource": "scripts/post.php",
    "sServerMethod": "POST"
				"sScrollX": "101%",
				"bScrollCollapse": true,
				"sPaginationType": "full_numbers",
				"bRetrieve": true,
				"fnInitComplete": function () {

					$("#tabla .dataTables_length > label > select").uniform();
					$("#tabla .dataTables_filter input[type=text]").addClass("text");
					$(".datatable").css("visibility","visible");

				}
	});
			function fnGetSelected( oTableLocal )
{
    return $('tabla.tr.row_selected');
}
				function seleccionar(id)
				{
					seleccion=id;
					$("#tabla tbody tr").click( function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            table1.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
				}
				function eliminar()
				{
					$.get('index.php?r=plantillas/quitar&id='+seleccion, function(data) {
						var anSelected = fnGetSelected( table1 );
        if ( anSelected.length !== 0 ) {
            table1.fnDeleteRow( '<tr id="row_69" class="odd"><td>aaa</td><td><button class="light  tiny icon_only img_icon" title="Modificar"><img src="images/icons/small/grey/pencil.png"></button><button class="light dialog_button tiny icon_only img_icon" onclick="seleccionar(69)" data-dialog="dialog_delete" title="Quitar"><img src="images/icons/small/grey/trashcan.png"></button></td></tr>');
        }
					});
				}
			</script>
			<?php $this->renderPartial('create',array('model'=>$model));?>
			
		</div>
