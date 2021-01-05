$(document).ready(function() {
    $('#addIssue').click(function(){
        $('#issueModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#modal_image").hide();
        $("#modal_video").hide();
        $('#issueForm')[0].reset();
        $('.modal-title').text("Add Issue");
        $('#action').val('addIssue');
        $('#save').val('Save');
    });

    $("#issueModal").on('submit','#issueForm', function(event){
        event.preventDefault();
        $('#save').attr('disabled','disabled');
         var formData = new FormData(this);
        $.ajax({
            url:"issues_action.php",
            method:"POST",
            data:formData,
            success:function(data){
                $('#issueForm')[0].reset();
                $('#issueModal').modal('hide');
                $('#save').attr('disabled', false);
                location.reload();
            },
            contentType: false,
            cache: false,
            processData:false,
        })
    });

    $(".update").on('click', function(){
        var id = $(this).attr("id");
        var action = 'getIssue';
        $.ajax({
            url:'issues_action.php',
            method:"POST",
            data:{id:id, action:action},
            dataType:"json",
            success:function(data){
                $("#issueModal").on("shown.bs.modal", function () {
                    $('#id').val(data.id);
                    $('#project_id').val(data.project_id);
                    $('#issue_title').val(data.issue_title);
                    $('#issue_desc').val(data.issue_desc);
                    $('#issue_status_id').val(data.issue_status_id);
                    $('#page_link').val(data.page_link);
                    $('#issue_image').html(data.issue_image);
                    $('#issue_video').html(data.issue_video);
                    var issue_imgPath = 'img_uploads/' + data.issue_image;
                    $(".modal_image img").attr("src",issue_imgPath);
                    var issue_videoPath = 'vid_uploads/' + data.issue_video;
                    $(".modal_video video").attr("src",issue_videoPath);
                    $('.modal-title').text("Edit Issue");
                    $('#action').val('updateIssue');
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
        var action = "deleteIssue";
        if(confirm("Are you sure you want to delete this issue?")) {
            $.ajax({
                url:"issues_action.php",
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
