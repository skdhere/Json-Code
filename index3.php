<?php

session_start();
session_destroy();
?>
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
                        <li class="list-group-item draggable">`int`</li>
                        
                    </ul>
                </div>
            </div>
          <div class="row">
            <div class="col-md-6 text-center">
                <h6>Enum Types</h6>
                <ul class="list-group ">
                    <li class="list-group-item">
                        <a href="javascript:void(0)" class="draggable" onclick="Mixed('bb_mixed_fraction', 'hid_bb_mixed_fraction_count');">
                            Mixed Fraction
                        </a>
                        <input type="hidden" name="hid_bb_mixed_fraction_count" id="hid_bb_mixed_fraction_count" value="0">
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:void(0)" class="draggable" onclick="Improper('bb_improper_fraction', 'hid_bb_improper_fraction_count');">
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
            <div id="div_editor_contain" class="col-md-12 droppable" style="border:3px dashed #ccc;background-color: hsla(0,0%,100%,.25);height:500px;overflow-y:auto;">
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

        var jsonArr = [];

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
        
        var jsonArr   = [];
        var mainArr  = [];
        current_step  = 1;
        ar            = {}
        function createJson(current_step_count,param_val,txt_hid_val)
        {
            if(current_step_count !=current_step)
            {  
                // ar = [];
                // mainArr['step'+current_step] =[];
                // mainArr['step'+current_step].push(jsonArr);
                // current_step  = current_step_count;
                // console.log(mainArr);
                // ar[param_val]  = [];
                // jsonArr =[];
            }

            var  ar       = [];

            ar[param_val] = [{"name":txt_hid_val}];

            jsonArr.push(ar);
            console.log(jsonArr);
        }

        function getAppendData(param_val, hid_val)
        {
            
            var txt_hid_val = parseInt($('#'+hid_val).val());
            txt_hid_val     = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            var current_step_count = $('#hid_current_step_count').val();

            // if(current_step_count !=current_step)
            // { 
            //     current_step = current_step_count;
            // }
            

            var sendInfo = {"param_val":param_val, "txt_hid_val":txt_hid_val, "current_step_count":current_step_count, "getHtml":1,"jsonArr":jsonArr};

            var get_HTML = JSON.stringify(sendInfo);
            $.ajax({
                url: "load_index.php?",
                type: "POST",
                data: get_HTML,
                contentType: "application/json; charset=utf-8",                     
                success: function(response) 
                {
                    data = JSON.parse(response);
                    createJson(current_step_count,param_val,txt_hid_val) ;

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
            ar = [];
            ar5 =[];
            var current_step_count = parseInt($('#hid_current_step_count').val());
            // mainArr['step'+current_step_count] = [];
            ar5['step'+current_step_count]     =  [jsonArr];

            mainArr.push(ar5);
            console.log(mainArr);
            current_step  = current_step_count + 1;
            
            jsonArr = [];
            
            var demo = [];
            for(var i = 0; i<mainArr.length;i++)
            {
                console.log(mainArr[i]);
                // console.log(mainArr[i][0]);
                var n ='step'+ (i+1);
                console.log(n);
                // console.log(JSON.parse(mainArr[i]))
                console.log(mainArr[i].step+(i+1));
                console.log('===============');
            }

            $.ajax({
                url: "load_index.php?",
                type: "POST",
                data: {'pst':demo,'test':1},
                contentType: "application/x-www-form-urlencoded",                     
                success: function(response) 
                {

                    data = JSON.parse(response);
                    console.log(data);
                },
                error: function (request, status, error) 
                {},
                complete: function()
                {}
            });
            
           
            new_step_count         = parseInt(current_step_count) + 1;
            $('#hid_current_step_count').val(new_step_count);
            // data = "<div style='clear: both;'></div><div id='div_step_"+new_step_count+"'>Step-"+new_step_count+"</div>";
            data = "<hr><div id='div_step_"+new_step_count+"' class='row p-3'><div class='col-md-12'><span class='badge badge-info badge-pill'>Step "+new_step_count+":</span></div></div>";
            $('#div_editor_contain').append(data);
        }

    function Improper(param_val, hid_val)
    {
        var current_step_count = parseInt($('#hid_current_step_count').val());
        var html = '';
        var txt_hid_val = parseInt($('#'+hid_val).val());
        txt_hid_val     = parseInt(txt_hid_val) + 1;
        $('#'+hid_val).val(txt_hid_val);

        if ($('#div_step_'+current_step_count).find('div').length == 0)
        {
           current_step_count = current_step_count - 1;
           $('#hid_current_step_count').val(current_step_count);
           $('#'+hid_val).val(0);
           alert("please add the step first!");
           return false;
        }
        
         // alert($('#div_step_'+current_step_count).find('div').length);
         // if ($('#div_step_'+current_step_count).find('div').length == 1)
         // {
         //    // $('#div_step_'+current_step_count).remove();
         // }

        html += '<div id="tbl_bb_improper_frac_'+txt_hid_val+'" class="col-md-5">';
            html += '<div>';
                html += '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_improper_frac_'+txt_hid_val+'\', '+current_step_count+');"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            html += '</div>';
            html += '<table>';
                html += '<tr>';
                    html += '<td>';
                        html += '<div><input type="" class="form-control" name=""></div>';
                        html += '<hr>';
                        html += '<div><input type="" class="form-control" name=""></div>';
                    html += '</td>';
                html += '</tr>';
            html += '</table>';  
        html += '</div>';

        $('#div_step_'+current_step_count).append(html);
    }

    function Mixed(param_val, hid_val)
    {
        var current_step_count = parseInt($('#hid_current_step_count').val());
        var html = '';
        var txt_hid_val = parseInt($('#'+hid_val).val());
        txt_hid_val     = parseInt(txt_hid_val) + 1;
        $('#'+hid_val).val(txt_hid_val);

        if ($('#div_step_'+current_step_count).find('div').length == 0)
        {
           current_step_count = current_step_count - 1;
           $('#hid_current_step_count').val(current_step_count);
           $('#'+hid_val).val(0);
           alert("please add the step first!");
           return false;
        }
        
        html += '<div id="tbl_bb_frac_'+txt_hid_val+'" class="col-md-5">';
            html += '<div>';
                html += '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_frac_'+txt_hid_val+'\', '+current_step_count+');"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            html += '</div>';
            html += '<table>';
                html += '<tr>';
                    html += '<td>';
                        html += '<div><input type="" class="form-control" name=""></div>';
                    html += '</td>';
                    html += '<td>';
                        html += '<div><input type="" class="form-control" name=""></div>';
                        html += '<hr>';
                        html += '<div><input type="" class="form-control" name=""></div>';
                    html += '</td>';
                html += '</tr>';
            html += '</table>';  
        html += '</div>';

        $('#div_step_'+current_step_count).append(html);
    }
    </script>
    <script type="text/javascript" src="js/ASCII.js"></script>
</body>
</html>
