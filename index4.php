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
                            <a href="javascript:void(0)" onclick="Multiply('op_multiply', 'hid_op_multiply_count');">X</a>
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
                    <li class="list-group-item" onclick="customBlock()">BB 3</li>
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
                <div id="div_qtype" class="row p-3">
                    
                </div>

                <!-- <div id="div_step_1" class="row p-3">
                    <div class="col-md-12">
                        <span class="badge badge-info badge-pill">Step 1:</span>
                    </div>
                </div> -->
            </div>
             <div id="jasonData"></div>
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
                <button class="btn btn-primary btn-block m-1" onclick="setObject()">New Qtype</button>
                <input type="hidden" id="hid_newqtypeflag"  name="hid_newqtypeflag" value="0">
                <button class="btn btn-primary btn-block m-1">Save Qtype</button>
                <button class="btn btn-primary btn-block m-1">Delete Qtype</button>
            </div>
        </div>
    </div>
    
</div>
    <script src="js/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

        ar = {
              "QType": 1,
              "Qtype Name": "Multiplication of 2 Mixed fraction",
              "Question": [],
              "Solution":[],
            }
        isSoltion = false;
        enumCount = 0;

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

        
        
       //set blank when adding new question type

        function setObject()
        {
            ar = {}; //set blank when adding new question type
            $('#jasonData').html('');
            enumCount = 0;
            // initialization type object 

            var hid_newqtypeflag = $('#hid_newqtypeflag').val();
            if(hid_newqtypeflag == 0)
            {
                $('#hid_newqtypeflag').val(1);
                var QTypeName = prompt("Please Enter QType Name:");
                $('#div_qtype').html('<div class="col-md-12"><span class="badge badge-info badge-pill">QType: </span><span id="qtype_name">'+QTypeName+'</span></div>');
                
                ar = {
                  "QType": 1,
                  "Qtype_Name": "Multiplication of 2 Mixed fraction",
                  "Question": [],
                  "Solution":[],
                }    
                ar.Qtype_Name = QTypeName;
                console.log(ar);
            }
            else
            {
                alert("Sorry, You have already added one QType!");                
            }
        }
        
        function checkParamType(param_val){

            console.log(param_val);
            if(param_val=='bb_improper_fraction')
            {
                b = {
                     "name": param_val,
                     "Type": "variable", 
                     "N"   : "",
                     "D"   : "",
                     "W"   : "1"
                    }

            }else if(param_val=='bb_mixed_fraction')
            {
                b = {
                     "name": param_val,
                     "Type": "variable", 
                     "N"   : "",
                     "D"   : "",
                     "W"   : ""
                    }
            }else
            {
                b = {"name": param_val,
                     "Type": "operator"
                 }
            }

            return b;
        }

        function createJson(param_val)
        {
            b = checkParamType(param_val);
            
            ar.Question.push(b);
            
            console.log(ar);
            $('#jasonData').html(ar);
            arr = JSON.stringify(ar);
            $('#jasonData').html(arr);
            console.log(arr);
        }

        function getRmElement(element_id, btnCount)
        {
            $('#div'+btnCount).remove();
            var len = (ar.Question.length) - 1;
            ar.Question.splice(len,1);

            $('#rmBtn'+(btnCount-1)).css('display','block');
            
            arr = JSON.stringify(ar);
            $('#jasonData').html(arr);
        }
        
        function changeCurrentStepCount()
        {
            new_step_count         = parseInt(current_step_count) + 1;
            $('#hid_current_step_count').val(new_step_count);
            
            data = "<hr><div id='div_step_"+new_step_count+"' class='row p-3'><div class='col-md-12'><span class='badge badge-info badge-pill'>Step "+new_step_count+":</span></div></div>";
            $('#div_editor_contain').append(data);
        }

        function Improper(param_val, hid_val)
        {
            var current_step_count = parseInt($('#hid_current_step_count').val());
            var html               = '';
            var txt_hid_val        = parseInt($('#'+hid_val).val());
            txt_hid_val            = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            
            var hid_newqtypeflag = $('#hid_newqtypeflag').val();

            if(hid_newqtypeflag != 0)
            {
                enumCount++;
                createJson(param_val);
                
                html += '<div id="div'+enumCount+'" class="col-md-5">';
                    html += '<div>';
                        html += '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_improper_frac_'+txt_hid_val+'\', '+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
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

                $('.rmBtn').css('display','none');
                if(hid_newqtypeflag == 1)
                {
                    $('#div_qtype').append(html);
                }
                else
                {

                }
            }
            else
            {
                alert('Sorry, You have to add QType First!');
            }

            
        }

        function Mixed(param_val, hid_val)
        {
            var current_step_count = parseInt($('#hid_current_step_count').val());
            var html               = '';
            var txt_hid_val        = parseInt($('#'+hid_val).val());
            txt_hid_val            = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            
            var hid_newqtypeflag = $('#hid_newqtypeflag').val();

            if(hid_newqtypeflag != 0)
            {
                enumCount++;
                createJson(param_val);
                html += '<div id="div'+enumCount+'" class="col-md-5">';
                    html += '<div>';
                        html += '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_frac_'+txt_hid_val+'\', '+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
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

                $('.rmBtn').css('display','none');
                if(hid_newqtypeflag == 1)
                {
                    $('#div_qtype').append(html);
                }
                else
                {

                }
            }
            else
            {
                alert('Sorry, You have to add QType First!');
            }
        }

        function Multiply(param_val, hid_val)
        {

            var current_step_count = parseInt($('#hid_current_step_count').val());
            var html               = '';
            var txt_hid_val        = parseInt($('#'+hid_val).val());
            txt_hid_val            = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            
            var hid_newqtypeflag = $('#hid_newqtypeflag').val();

            if(hid_newqtypeflag != 0)
            {
                enumCount++;
                createJson(param_val);

                html_data = '';

                html_data += '<div id="div'+enumCount+'" class="col-md-2" align="center">';
                    html_data += '<div>';
                        html_data += '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_op_multi_'+txt_hid_val+'\', '+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
                    html_data += '</div>';
                    html_data += '<table>';
                        html_data += '<tr>';
                            html_data += '<td>';
                                html_data += '<div>&nbsp;</div>';
                                html_data += '<h3>X</h3>';
                                html_data += '<div>&nbsp;</div>';
                            html_data += '</td>';
                        html_data += '</tr>';
                    html_data += '</table>';  
                html_data += '</div>';

                $('.rmBtn').css('display','none');
                if(hid_newqtypeflag == 1)
                {
                    $('#div_qtype').append(html_data);    
                }
                else
                {

                }
                
            }
            else
            {
                alert('Sorry, You have to add QType First!');
            }
        }

        function customBlock()
        {
            var n = prompt("Number of numerator");
            var d = prompt("Number of denominator");

            if(isNaN(n) || isNaN(n))
            {
                alert('numerator and denominator are not valid');
                customBlock();
                return false;
            }

            var o = prompt("Operator");

            var html ='';

            html +='<div style="text-align: center;" class="col-md-5">';
            html +='<div>'
            for(var i = 1;i<=n;i++)
            {
                html +='<input type="text" style="width:20px"/> ';
                if(i !=n)
                {
                    html +=' '+o+' ';
                }
            }
            html +='</div>'
            html +='<hr>';
            html +='<div>';
            for(var i = 1;i<=d;i++)
            {
                html +='<input type="text" style="width:20px"/> ';
                if(i !=d)
                {
                    html +=' '+o+' ';
                }
            }
            html +='</div>'
            html +='</div>'
            var current_step_count = parseInt($('#hid_current_step_count').val());

            $('#div_step_'+current_step_count).append(html);
        }

        </script>
    <script type="text/javascript" src="js/ASCII.js"></script>
</body>
</html>