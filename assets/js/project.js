$(document).ready(function() {
    $('#addProject').click(function(){
        $('#projectModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#projectForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Project");
        $('#action').val('addProject');
        $('#save').val('Save');
    });

    $("#projectModal").on('submit','#projectForm', function(event){
        event.preventDefault();
        $('#save').attr('disabled','disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"project_action.php",
            method:"POST",
            data:formData,
            success:function(data){
                $('#projectForm')[0].reset();
                $('#projectModal').modal('hide');
                $('#save').attr('disabled', false);
                location.reload();
            }
        })
    });

    $(".update").on('click', function(){
        var id = $(this).attr("id");
        var action = 'getProject';
        $.ajax({
            url:'project_action.php',
            method:"POST",
            data:{id:id, action:action},
            dataType:"json",
            success:function(data){
                $("#projectModal").on("shown.bs.modal", function () {
                    $('#id').val(data.id);
                    $('#project_id').val(data.project_name);
                    $('#project_manager').val(data.project_manager_id);
                    $('#developer').val(data.developer_id);
                    $('#status').val(data.status_id);
                    $('#dev_date').val(data.dev_date);
                    $('#launch_date').val(data.launch_date);
                    $('.modal-title').text("Edit Project");
                    $('#action').val('updateProject');
                    $('#save').val('Save');
                }).modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
    });
    $(".delete").on('click', function(){
        var id = $(this).attr("id");
        var action = "deleteProject";
        if(confirm("Are you sure you want to delete this project?")) {
            $.ajax({
                url:"project_action.php",
                method:"POST",
                data:{id:id, action:action},
                success:function(data) {
                    location.reload();
                }
            })
        } else {
            return false;
        }
    });
});
