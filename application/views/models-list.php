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
                <div id="body">
                    <h3 style="text-align: center">Models List</h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover dataex-html5-export">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Manufacturer</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Registration Number</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($modelsData as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['manufacturer']; ?></td>
                                    <td><?php echo $data['model'];; ?></td>
                                    <td><?php echo $data['color']; ?></td>
                                    <td><?php echo $data['registration_number']; ?></td>

                                    <td>
                                        <button class="btn btn-primary"
                                                title="view" onclick="getModalData(<?php echo $data['model_id']; ?>)">
                                            View
                                        </button>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p><strong>Manufacturer:</strong><span id="manufacturer"></span></p>
                <p><strong>Color:</strong><span id="color"></span></p>
                <p><strong>Manufacturing Year:</strong><span id="manufacturing_Year"></span></p>
                <p><strong>Registration Number:</strong><span id="reg_no"></span></p>
                <p><strong>notes:</strong><span id="notes"></span></p>
                <input type="hidden" id="modelId">
                <div id="imagesDiv">

                </div>
                <button class="btn btn-primary" onclick="deleteModel();">Sold</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    function getModalData(modelId) {
        $.ajax({
            type: "POST",
            url: base_url + 'index.php/Dashboard/getModaldataById/' + modelId,
            success: function (resp) {
                var parsedData = JSON.parse(resp);
                $(".modal-title").html(parsedData[0]['model']);
                $("#manufacturer").html(parsedData[0]['manufacturer']);
                $("#color").html(parsedData[0]['color']);
                $("#reg_no").html(parsedData[0]['registration_number']);
                $("#manufacturing_Year").html(parsedData[0]['manufacturing_year']);
                $("#notes").html(parsedData[0]['note']);
                $("#modelId").val(parsedData[0]['model_id']);
                $('#myModal').modal('show');
                getImages(modelId);
            }
        });

    }
    function getImages(modelId) {

        $.ajax({
            type: "POST",
            url: base_url + 'index.php/Dashboard/getModalImagesById/' + modelId,
            success: function (resp) {
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    var img = data[0]['image'];
                    var path = base_url + '/assets/uploads/' + img;
                    $("#imagesDiv").html('<li><img src=' + path + '  height="42" width="42"></li>');
                }
            }
        });
    }
    function deleteModel() {
        var modelId=$("#modelId").val();


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
                        url: base_url + 'index.php/Dashboard/deleteModel/' + modelId,
                        success: function (resp) {
                            if (resp == "success") {
                                swal("Sold Out!", "Model has been Sold.", "success");
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