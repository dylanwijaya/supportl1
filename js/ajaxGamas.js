$(document).ready(function(){	
	
	var dataRecords = $('#recordListing').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax":{
			url:"ajax_actionGamas.php",
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

	});		
	$("#recordListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		$.ajax({
			url:'ajax_actionGamas.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#brand').val(data.brand);
				$('#product').val(data.product);
				$('#start').val(data.start);
				$('#end').val(data.end);
				$('#problem').val(data.problem);
				$('#escalation').val(data.escalation);
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Records");
				$('#action').val('updateRecord');
				$('#save').val('Save');
			}
		})
	});

	$("#recordModal").on('submit','#recordForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ajax_actionGamas.php",
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
				url:"ajax_actionGamas.php",
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