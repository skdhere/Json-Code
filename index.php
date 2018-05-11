<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>

<div class="jumbotron text-center">
    <h1>Editor For Question and Solution Type</h1>
</div>
  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-6 text-center pb-3">
                    <h6>Building Block List</h6>
                    <ul class="list-group">
                        <li class="list-group-item">BB 1</li>
                        <li class="list-group-item">BB 2</li>
                        <li class="list-group-item">BB 3</li>
                    </ul>
                </div>
                <div class="col-md-6 text-center pb-3">
                    <h6>Operators</h6>
                    <ul class="list-group">
                        <li class="list-group-item draggable">
                            <a href="javascript:void(0)" onclick="getAppendData('op_multiply', 'hid_op_multiply_count');">X</a>
                            <input type="hidden" name="hid_op_multiply_count" id="hid_op_multiply_count" value="0">
                        </li>
                        <li class="list-group-item draggable">/</li>
                        <li class="list-group-item draggable">+</li>
                        <li class="list-group-item draggable">-</li>
                        <li class="list-group-item draggable">%</li>
                    </ul>
                </div>
            </div>
          <div class="row">
            <div class="col-md-6 text-center">
                <h6>Enum Types</h6>
                <ul class="list-group ">
                    <li class="list-group-item">
                        <a href="javascript:void(0)" class="draggable" onclick="getAppendData('bb_mixed_fraction', 'hid_bb_mixed_fraction_count');">
                            Mixed Fraction
                        </a>
                        <input type="hidden" name="hid_bb_mixed_fraction_count" id="hid_bb_mixed_fraction_count" value="0">
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:void(0)" class="draggable" onclick="getAppendData('bb_improper_fraction', 'hid_bb_improper_fraction_count');">
                            Improper Fraction
                        </a>
                        <input type="hidden" name="hid_bb_improper_fraction_count" id="hid_bb_improper_fraction_count" value="0">
                    </li>
                    <li class="list-group-item">BB 3</li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
                <h6>Text</h6>
                <input type="text" class="form-control" name="">
                <button class="btn btn-primary m-3">Add</button>
            </div>
          </div>
        </div>
        <div class="col-md-7">
            <div id="div_editor_contain" class="col-md-12 droppable" style="border:3px dashed #ccc;background-color: hsla(0,0%,100%,.25);height:500px;overflow-y:scroll;">
                <div id="div_step_1" class="row p-3">
                    <div class="col-md-12">
                        <span class="badge badge-info badge-pill">Step 1:</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="col-md-12" style="border:3px dashed #ccc;background-color: hsla(0,0%,100%,.25);height:500px">
                <button class="btn btn-primary btn-block m-1">Add Initiations</button>
                <button class="btn btn-primary btn-block m-1">Add Result</button>
                <button class="btn btn-primary btn-block m-1" onclick="changeCurrentStepCount();">
                    Add Steps
                </button>
                <input type="hidden" name="hid_cont_add_step_count" id="hid_cont_add_step_count" value="0">
                <input type="hidden" name="hid_current_step_count" id="hid_current_step_count" value="1">
                <button class="btn btn-primary btn-block m-1">Add Solutions</button>
                <hr>
                <button class="btn btn-primary btn-block m-1">View Qtype</button>
                <button class="btn btn-primary btn-block m-1">New Qtype</button>
                <button class="btn btn-primary btn-block m-1">Save Qtype</button>
                <button class="btn btn-primary btn-block m-1">Delete Qtype</button>
            </div>
        </div>
    </div>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
         $( function() {

            $('.draggable').draggable({
              revert: "invalid",
              stack: ".draggable",
              helper: 'clone'
            });
            $('.droppable').droppable({
              accept: ".draggable",
              drop: function(event, ui) {
                var droppable = $(this);
                var draggable = ui.draggable;
                // Move draggable into droppable
                var drag = $('.droppable').has(ui.draggable).length ? draggable : draggable.clone().draggable({
                  revert: "invalid",
                  stack: ".draggable",
                  helper: 'clone'
                });
                drag.appendTo(droppable);
                draggable.css({
                  float: 'left'
                });
              }
            });

         });
        
        function getAppendData(param_val, hid_val)
        {
            var txt_hid_val = parseInt($('#'+hid_val).val());
            txt_hid_val     = parseInt(txt_hid_val) + 1;
            console.log(txt_hid_val);
            $('#'+hid_val).val(txt_hid_val);

            var current_step_count = $('#hid_current_step_count').val();

            var sendInfo = {"param_val":param_val, "txt_hid_val":txt_hid_val, "current_step_count":current_step_count, "getHtml":1};
            var get_HTML = JSON.stringify(sendInfo);
            $.ajax({
                url: "load_index.php?",
                type: "POST",
                data: get_HTML,
                contentType: "application/json; charset=utf-8",                     
                success: function(response) 
                {
                    data = JSON.parse(response);

                    if(data.Success == "Success") 
                    {
                        $('#div_step_'+current_step_count).append(data.resp);
                    } 
                    else
                    {                   
                        $('#div_editor_contain').append('');
                    }
                },
                error: function (request, status, error) 
                {},
                complete: function()
                {}
            });
        }

        function getRmElement(element_id, current_step_count)
        {
            $('#'+element_id).remove();
            if ($('#div_step_'+current_step_count).find('div').length == 1)
            {
                $('#div_step_'+current_step_count).remove();
            }
        }

        function changeCurrentStepCount()
        {
            var current_step_count = parseInt($('#hid_current_step_count').val());
            new_step_count         = parseInt(current_step_count) + 1;
            $('#hid_current_step_count').val(new_step_count);
            // data = "<div style='clear: both;'></div><div id='div_step_"+new_step_count+"'>Step-"+new_step_count+"</div>";
            data = "<hr><div id='div_step_"+new_step_count+"' class='row p-3'><div class='col-md-12'><span class='badge badge-info badge-pill'>Step "+new_step_count+":</span></div></div>";
            $('#div_editor_contain').append(data);
        }
    </script>
</body>
</html>
