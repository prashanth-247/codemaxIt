<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CodeMaxIt</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.imageuploader.css">
    <style type="text/css">

        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            /* margin: 40px;*/
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        . form-group {
            text-align: left;
        }

        .header {
            color: #2196F3;
            font-size: 27px;
            padding: 10px;
        }

        .red {
            color: red;
        }

        .dangerAlert {
            display: none;
        }
    </style>
</head>
<body>
<?php // include('header.php');?>


<nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">CODEMAX </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url();?>index.php/Dashboard">Home</a></li>
            <li><a href="<?php echo base_url();?>index.php/Dashboard/modelList">List</a></li>
            <li><a href="<?php echo base_url();?>index.php/Dashboard">Add Manufacturer</a></li>
            <li class=""><a href="<?php echo base_url();?>index.php/Dashboard/addModel">Add Model</a></li>
        </ul>
    </div>
</nav>


<div class="jumbotron">
    <div class="container">

        <div id="body">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" action="" id="modelForm" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Add Model</legend>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <label for="asset_type_name">Manufacturer Name<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="manufacturer_error"> Manufacturer Name Is Mandatory</span></label>
                                <select class="form-control add-model" id="manufacturer_id" name="manufacturer_id"
                                        validate="manufacturer_error"">
                                <option value="">Select Type</option>
                                <?php foreach ($manufacturerData as $row) { ?>
                                    <option value="<?php echo $row['manufacturer_id']; ?>"
                                    ><?php echo $row['manufacturer']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="asset_type_name">Model Name<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="model_error"> Model Name Is Mandatory</span></label>
                                <input type="text" id="model" name="model"
                                       class="form-control add-model"
                                       placeholder="Enter model Type Name"
                                       validate="model_error">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <label for="color">Color<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="color_error">Color Name Is Mandatory</span></label>
                                <input type="text" id="color" name="color"
                                       class="form-control add-model"
                                       placeholder="Enter color"
                                       validate="color_error" ">
                            </div>
                            <div class="col-md-4">
                                <label for="asset_type_name">Manufacturing Year<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="manufacturing_year_error">Manufacturer Year Is Mandatory</span></label>
                                <input type="text" id="manufacturing_year" name="manufacturing_year"
                                       class="form-control add-model yearPicker"
                                       placeholder="Enter Manufacturing Year"
                                       validate="manufacturing_year_error">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <label for="registration_number">Registration Number<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="registration_number_error">Registration Number Is Mandatory</span></label>
                                <input type="text" id="registration_number" name="registration_number"
                                       class="form-control add-model"
                                       placeholder="Enter registration_number"
                                       validate="registration_number_error" ">
                            </div>
                            <div class="col-md-4">
                                <label for="note">Notes<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="note_error">Notes Is Mandatory</span></label>
                                <textarea type="text" id="note" name="note"
                                          class="form-control add-model"
                                          placeholder="Enter Notes"
                                          validate="note_error"></textarea>
                            </div>
                        </div>
                        <label for="fileinput" class="col-md-offset-2">Select Images<span
                                    class="red dangerAlert"
                                    id="image_error "></label>
                        <div class="form-group">

                            <div class="uploader__box js-uploader__box l-center-box">
                                    <div class="uploader__contents">
                                        <label class="button button--secondary" for="fileinput">Select Files</label>
                                        <input id="fileinput" class="uploader__file-input" type="file" multiple value="Select Files">
                                    </div>
                                    <input class="button button--big-bottom" type="button" value="Upload Selected Files">
                            </div>
                            <input type="hidden" id="imagesArray" name="images" >

                        </div>

                    </fieldset>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary btn-md"
                                    onclick="return manufacturerValidateForm();">Submit
                            </button>
                        </div>
                    </div>

                </form>


            </div>

        </div>

    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.imageuploader.js"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';

    $(function () {
        var options = {
            submitButtonCopy: 'Upload Selected Files',
            instructionsCopy: 'Drag and Drop, or',
            furtherInstructionsCopy: 'Your can also drop more files, or',
            selectButtonCopy: 'Select Files',
            secondarySelectButtonCopy: 'Select More Files',
            dropZone: $(this),
            fileTypeWhiteList: ['jpg', 'png', 'jpeg', 'gif', 'pdf'],
            badFileTypeMessage: 'Sorry, we\'re unable to accept this type of file.',
            ajaxUrl: base_url + 'index.php/Dashboard/upload',
            testMode: false
        };
        $('.js-uploader__box').uploader(options);

        $('.yearPicker').datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
</script>
<script>


    function manufacturerValidateForm() {

        var flag = 1;
        $('.add-model').each(function () {
            var valid = $(this).attr('validate');
            $("#" + valid).hide();

            if ($(this).val().trim() == '') {
                $("#" + valid).show();
                flag = 0;
            }
        });
        if ($("#fileinput").val() == "") {
        flag=0;
        $("#image_error").show().html("Image is mandatory")
        }

        if (flag == 0) {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: base_url + 'index.php/Dashboard/addNewModel',
                data: $("#modelForm").serialize(),
                success: function (resp) {
                    if (resp != "success") {
                        sweetAlert("Oops...", "Model Already Exist!", "error");
                    } else {
                        swal({
                            title: "Added!",
                            text: "Model Added Successfully",
                            type: "success",
                            showConfirmButton: true
                        });
                        window.location = base_url + "Dashboard/modelList";
                    }
                }
            });
        }
    }

    function deleteManufacturer(manufacturerId) {
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({

                        type: "POST",
                        url: base_url + '/Dashboard/deleteManufacturer/' + manufacturerId,
                        success: function (resp) {
                            if (resp == "success") {
                                swal("Deleted!", "Manufacturer has been deleted.", "success");
                                location.reload();
                            }
                        }
                    });

                } else {
                }
            }
        );

    }

</script>
</body>
</html>