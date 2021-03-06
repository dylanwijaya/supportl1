$(document).ready(function(){	
	
	var dataRecords = $('#recordListing').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax":{
			url:"ajax_actionVIP.php",
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
			url:'ajax_actionVIP.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#company').val(data.company);
				$('#product').val(data.product);
				$('#account').val(data.account);
				$('#customer').val(data.customer);
				$('#sales').val(data.sales);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
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
			url:"ajax_actionVIP.php",
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
				url:"ajax_actionVIP.php",
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