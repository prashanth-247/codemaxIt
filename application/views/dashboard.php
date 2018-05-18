<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CodeMaxIt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
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
                <form class="form-horizontal" method="post" action="" id="manufacturerForm">
                    <fieldset>
                        <legend class="text-center header">Add Manufacturer</legend>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <label for="asset_type_name">Manufacturer Name<span class="red">*</span><span
                                            class="red dangerAlert"
                                            id="manufacturer_error"> Manufacturer Name Is Mandatory</span></label>
                                <input type="text" id="manufacturer" name="manufacturer"
                                       class="form-control add-manufacturer"
                                       placeholder="Enter Asset Type Name"
                                       validate="manufacturer_error" ">
                            </div>
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

                <div id="body">
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover dataex-html5-export">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Manufacturer</th>
                                <!--<th>Asset Registration Number</th>-->
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($manufacturerData as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['manufacturer']; ?></td>

                                    <td>

                                        <a class="btn btn-primary" href="javascript:"
                                           onclick="deleteManufacturer(<?php echo $data['manufacturer_id']; ?>)"
                                           title="Delete"><i class="fa fa-trash-o"
                                                             aria-hidden="true"></i>Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                            </tbody>

                        </table>
                    </div>
                    <div style="text-align: right;">
                        <button class="button btn-sm"> Load More..<i class="fa fa-angle-double-right"></i></button>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script>
    function manufacturerValidateForm() {

        var flag = 1;
        $('.add-manufacturer').each(function () {
            var valid = $(this).attr('validate');
            $("#" + valid).hide();

            if ($(this).val().trim() == '') {
                $("#" + valid).show();
                flag = 0;
            }
        });

        if (flag == 0) {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: base_url + 'index.php/Dashboard/addManufacturer',
                data: $("#manufacturerForm").serialize(),
                success: function (resp) {
                    if (resp == "manufacturer_exists") {
                        sweetAlert("Oops...", "Manufacturer Already Exist!", "error");
                    } else {
                        swal({
                            title: "Added!",
                            text: "Manufacturer Type Added Successfully",
                            type: "success",
                            showConfirmButton: true
                        });
                        window.location.reload();
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