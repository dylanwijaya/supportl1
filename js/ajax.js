$(document).ready(function(){	
	
	var dataRecords = $('#recordListing').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax":{
			url:"ajax_action.php",
			type:"POST",
			data:{action:'listRecords'},
			dataType:"json"
		},
	});	
	
	$('#addRecord').click(function(){
		$('#recordModal').modal('show');
		$('.modal-title').html("Add Record");
		$('#recordForm')[0].reset();
		$('#action').val('addRecord');
		$('#save').val('Add');
		$('#no_ticket').attr('readonly',false);
		$('#company').attr('readonly',false);
		$('#product').attr('readonly',false);
		$('#invoice').attr('readonly',false);
		$('#price').attr('readonly',false);
		$('#sow').attr('readonly',false);
		$('#agent').attr('readonly',false);
		$('#sales').attr('readonly',false);
		$('#start').attr('readonly',false);
		$('#finish').attr('readonly',false);
		$('#status').attr('readonly',false);
		$('#logs_date').attr('readonly',false);
		$('#logs_date').attr('hidden','disabled');
	});		
	$("#recordListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		$.ajax({
			url:'ajax_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#no_ticket').val(data.no_ticket);
				$('#no_ticket').attr('readonly',false);
				$('#company').val(data.company);
				$('#company').attr('readonly',false);
				$('#product').val(data.product);
				$('#product').attr('readonly',false);
				$('#invoice').val(data.invoice);
				$('#invoice').attr('readonly',false);
				$('#price').val(data.price);
				$('#price').attr('readonly',false);
				$('#sow').val(data.sow);
				$('#sow').attr('readonly',false);
				$('#agent').val(data.agent);
				$('#agent').attr('readonly',false);
				$('#sales').val(data.sales);
				$('#sales').attr('readonly',false);
				$('#start').val(data.start);
				$('#start').attr('readonly',false);
				$('#finish').val(data.finish);
				$('#finish').attr('readonly',false);
				$('#status').val(data.status);
				$('#status').attr('readonly',false);
				$('#logs_date').val(data.logs_date);
				$('#logs_date').attr('readonly',false);
				$('#logs_date').attr('hidden','disabled');
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Records");
				$('#action').val('updateRecord');
				$('#save').val('Save');
				$('#save').attr('hidden', false);
			}
		})
	});
	$("#recordListing").on('click', '.info', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		$.ajax({
			url:'ajax_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#no_ticket').val(data.no_ticket);
				$('#no_ticket').attr('readonly','enabled');
				$('#company').val(data.company);
				$('#company').attr('readonly','enabled');
				$('#product').val(data.product);
				$('#product').attr('readonly','enabled');
				$('#invoice').val(data.invoice);
				$('#invoice').attr('readonly','enabled');
				$('#price').val(data.price);
				$('#price').attr('readonly','enabled');
				$('#sow').val(data.sow);
				$('#sow').attr('readonly','enabled');
				$('#agent').val(data.agent);
				$('#agent').attr('readonly','enabled');
				$('#sales').val(data.sales);
				$('#sales').attr('readonly','enabled');
				$('#start').val(data.start);
				$('#start').attr('readonly','enabled');
				$('#finish').val(data.finish);
				$('#finish').attr('readonly','enabled');
				$('#status').val(data.status);
				$('#status').attr('readonly','enabled');
				$('#logs_date').val(data.logs_date);
				$('#logs_date').attr('readonly','enabled');
				$('#logs_date').attr('hidden',false);
				$('.modal-title').html("View Record");
				$('#action').val('detailRecord');
				$('#save').val('Done');
				$('#save').attr('hidden','disabled');
			}
		})
	});
	$("#recordModal").on('submit','#recordForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ajax_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#recordForm')[0].reset();
				$('#recordModal').modal('hide');				
				$('#save').attr('disabled', false);
				dataRecords.ajax.reload();
			}
		})
	});	
	$("#recordListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteRecord";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"ajax_action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					dataRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});