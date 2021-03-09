$(function()   
{ 
    // JQuery Populate Crop Table List Function
    var table = $('#crop-batch-table').DataTable({
        aaSorting: [[ 0, "desc" ]],
        ajax:{
            url:"predictor_table", 
            dataSrc:function(json){
                return json.data;
            },
        },

        columns: [
            {title: 'Batch No.', data: 'batch_no', name: 'batch_no'},
            {title: "Crop Age", data: 'day_number', name: 'day_number'},
            {title: "Date Uploaded", data: 'date_uploaded', name: 'date_uploaded'},
            {title: "Target Color Percentage", data: 'percentage', name: 'percentage'+'%'},
            {title: "Status", data: 'status', name: 'status'},
            {
                title: 'Action',
                data: 'crop_id', 
                name: 'crop_id', 
                orderable: true, 
                searchable: true,
                render: function(crop_id){
                    return  '<button style="margin-left:5px; data-toggle="modal" data-id="'+crop_id+'" class="btn btn-warning btn-sm edit-post-crop"><i class="glyphicon glyphicon-pencil"></i></button>' + 
                            '<button style="margin-left:5px; data-toggle="modal" data-id="'+crop_id+'" class="btn btn-danger btn-sm delete-post-crop"><i class="glyphicon glyphicon-trash"></i></button>';
                }
                
            },
        ],
    });

    // JQuery Populate Batch Number List Function
    var batch_list = $.ajax({
    aaSorting: [[ 0, "asc" ]],
    type: "GET",
    url: "list_batch",
    dataSrc:function(json) {
        return json.data;
    },
        success: function(response)
        {
            var length = 0
        
            if (response.data != null) 
            {
                length = response.data.length;
            }
            if (length > 0) 
            {
                for (var i = 0; i < length; i++) 
                {
                    var id = response.data[i].id;  
                    var batch_number = response.data[i].batch_number;
                    var batch_number_option = "<option value='"+id+"'>"+batch_number+"</option>"; 
                    $("#batch_number_filter").append(batch_number_option);
                    $("#batch_number_upload").append(batch_number_option);
                }
            }
        }
    });

    // JQuery Batch Function Search
    $('body').on('click', '#modal-search', function () 
    {
        var batch_search =  $('#batch_number_filter').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "predictor/search",
            data: {
                batch_search: batch_search,
            },
            success: function(response){
                table.clear();
                table.rows.add( response ).draw();
                
                if($.trim(response) == ''){
                    document.getElementById("batch-date-started").value = "yyyy-mm-dd";
                    document.getElementById("batch-date-ended").value = "yyyy-mm-dd";
                }else{
                    document.getElementById("batch-date-started").value = response[0].date_started;
                    document.getElementById("batch-date-ended").value = response[0].date_ended;
                }
            },
        });
    });

    // JQuery Batch Function Add
    $('body').on('click', '#add-batch', function () {
        save_method = 'add';
        $("#batch-form")[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#batch-number-error').empty();
        $('#date-started-error').empty();
        $('#batch-form-modal').modal('show');
        $('.modal-title').text('Add Batch');
    });

    // JQuery Batch Add(Insert) Function Save
    $('body').on('click', '#modal-save-batch', function () 
    {
        if(save_method == 'add') {
            url = "predictor/insert_batch";
        } else {
            url = "predictor/update_batch";
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: url,
            data: $('#batch-form').serialize(),
          
            success: function(){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success!',
                    text: 'The batch has been saved!',
                    showConfirmButton: false,
                    timer: 2000
                })
              
                $("#batch-form")[0].reset();
                $('#batch-form-modal').modal("hide");
                table.ajax.reload();  
                batch_list.ajax.reload(); 
                location.reload();
            },
            error: function (data){
                var obj = JSON.parse(data.responseText);
                console.log(obj.errors);
                if(obj.errors){
                    $( '#batch-number-error' ).html( obj.errors.batch_number[0] );
                    $( '#date-started-error' ).html( obj.errors.date_started[0] );
                }
            },
        });
    })

    // JQuery Upload New Image Function
    $('body').on('click', '#upload-new-image', function () 
    {
        save_method = 'add';
      
        $("#upload-form")[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $('#file-error').empty();
        $('#batch-number-list-upload-error').empty();
        $('#day-number-error').empty();

        $('#upload-form-modal').modal('show');
        $('.modal-title').text('Upload New Image');
    });

    // JQuery Corn Save and Update
    $('body').on('click', '#modal-save-crop', function () 
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "predictor/save_crop",
            data: $('#upload-form').serialize(),
          
          
        });
    })


    // JQuery Edit Selected Crop Data Function
    $('body').on('click', '.edit-post-crop', function () 
    {
        save_method = 'update';
      
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        
        $('#file-error').empty();
        $('#batch-number-list-upload-error').empty();
        $('#day-number-error').empty();

        $('#upload-form-modal').modal('show');
        $('.modal-title').text('Edit Crop');

        var edit_id = $(this).data('id');

        console.log(edit_id);
     
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "predictor/edit_crop",
            data: {
                edit_id: edit_id,
            },
            success: function (data){
                console.log(data);
                $('#id').val(data.result.id);   
                // $('#file').val(data.result.file);   
                $('#day_number').val(data.result.day_number);
                $('#batch_number_upload').val(data.result.batch_number);
            },
            error: function (){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error!',
                    text: 'There is an error.',
                    showConfirmButton: false,
                    timer: 2000
                })
            },
        });
    })

     // JQuery Crop Add(Insert) & Edit(Update) Function Save
     $('body').on('click', '#modal-save-crop', function () 
     {
        alert("save!");
     })



    // JQuery Materials Function Delete
    $('body').on('click', '.delete-post-crop', function () 
    {
        var delete_key = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            confirmButtonText: '<i class="glyphicon glyphicon-ok"></i> ',
            cancelButtonColor: '#292b2c  ',
            cancelButtonText: '<i class="glyphicon glyphicon-remove"></i> ',
            reverseButtons: false
          
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "preditor/delete_crop",
                    data: {
                        delete_key: delete_key,
                    },
                    success: function (){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The material has been deleted.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        table.ajax.reload();   
                    },
                    error: function (){
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error!',
                            text: 'There is an error.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                });
            } 
            else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Cancelled!',
                    text: 'The material was not deleted.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        })
    });

});
