$(document).ready(function() {
    $(".delete_url_file_upload").click(function() {
        $(this).parents('.wrapper-file-upload').find(".url_file_upload").val('');
        var wrapper = $(this).parents(".wrapper-file-upload");
        if(wrapper.attr('data-cat') == 'image') {
            wrapper.find('img').remove();
        }
        else if(wrapper.attr('data-cat') == 'audio') {
            wrapper.find('audio').remove();
        }
    });

    $(".url_file_upload").each(function() {
        var wrapper = $(this).parents(".wrapper-file-upload");
        if($(this).val() != '' && wrapper.attr('data-cat') == 'image') {
            wrapper.append("<img src='/public"+$(this).val()+"' class='m-t'>");
        }
        else if($(this).val() != '' && wrapper.attr('data-cat') == 'audio') {
            wrapper.append("<audio controls class='m-t'><source src='/public"+$(this).val()+"' type='audio/mpeg'></audio>");
        }
    });

    $("#url_file_upload, #url_file_upload_2").change(function() {
        var wrapper = $(this).parents(".wrapper-file-upload");
        if(wrapper.attr('data-cat') == 'image') {
            wrapper.find('img').remove();
            wrapper.append("<img src='/public"+$(this).val()+"' class='m-t'>");
        }
        else if(wrapper.attr('data-cat') == 'audio') {
            wrapper.find('audio').remove();
            wrapper.append("<audio controls class='m-t'><source src='/public"+$(this).val()+"' type='audio/mpeg'></audio>");
        }
    });

    $("#add_input_to_groups_english").click(function() {
        var input = '<div class="input-group m-b"><input type="text" name="english[]" class="form-control m-b" value="" required><span class="input-group-btn"><button type="button" class="btn btn-danger delete_input_lesson"><i class="fa fa-times"></i></button></span></div>';
        $(this).parents('.form-group').find(".lesson_english").append(input);
    });

    $("#add_input_to_groups_vietnamese").click(function() {
        var input = '<div class="input-group m-b"><input type="text" name="vietnamese[]" class="form-control m-b" value="" required><span class="input-group-btn"><button type="button" class="btn btn-danger delete_input_lesson"><i class="fa fa-times"></i></button></span></div>';
        $(this).parents('.form-group').find(".lesson_vietnamese").append(input);
    });

    $("body").on('click', '.delete_input_lesson', function() {
        $(this).parents(".input-group").addClass("remove-input-group");
        $(".remove-input-group").remove();
    });
});

/*
 * use the Filemanager from a simple textfield
 */
var urlobj;

function BrowseServer(url, obj) {
    urlobj = obj;
    OpenServerBrowser(
        url,
        screen.width * 0.7,
        screen.height * 0.7);
}

function OpenServerBrowser(url, width, height) {
    var iLeft = (screen.width - width) / 2;
    var iTop = (screen.height - height) / 2;
    var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes";
    sOptions += ",width=" + width;
    sOptions += ",height=" + height;
    sOptions += ",left=" + iLeft;
    sOptions += ",top=" + iTop;
    var oWindow = window.open(url, "BrowseWindow", sOptions);
}

function SetUrl(url, width, height, alt) {
    document.getElementById(urlobj).value = url;
    oWindow = null;

    var idName = '#'+urlobj;
    $(idName).trigger("change");
}

