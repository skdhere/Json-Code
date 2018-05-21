<?php

session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Example</title>
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
                    <ul class="list-group" style="font-size: 12px;">
                        <li class="list-group-item">
                            <a href="javascript:void(0)" id="bb_mixed_to_improper" name="bb_mixed_to_improper" title="Converting Mixed To Improper Fraction" onclick="add_building_block('bb_mixed_to_improper', 'Convert Mixed to Improper Fraction');">
                                Converting Mixed To Improper Fraction
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" id="bb_prime_factors" name="bb_prime_factors" title="Find Prime Factors of Fraction" onclick="add_building_block('bb_prime_factors', 'Find the prime factor of num and denom');">
                                Find Prime Factors of Fraction
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" id="bb_cancel_comm_factors" name="bb_cancel_comm_factors" title="Canceling Common Factors" onclick="add_building_block('bb_cancel_comm_factors', 'Cancel common factors');">
                                Canceling Common Factors
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" id="bb_multiply_remaining_factors" name="bb_multiply_remaining_factors" title="Multiply Remaining Factors" onclick="add_building_block('bb_multiply_remaining_factors', 'Multiply factors');">
                                Multiply Remaining Factors
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" id="bb_improper_to_mixed" name="bb_improper_to_mixed" title="Converting Improper To Mixed Fraction" onclick="add_building_block('bb_improper_to_mixed', 'Convert Improper to Mixed Fraction');">
                                Converting Improper To Mixed Fraction
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-center pb-3">
                    <h6>Operators</h6>
                    <ul class="list-group">
                        <li class="list-group-item draggable">
                            <a href="javascript:void(0)" onclick="Multiply('op_multiply', 'hid_op_multiply_count');">X</a>
                            <input type="hidden" id="hid_op_multiply_count" name="hid_op_multiply_count" value="0">
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
                        <li class="list-group-item" onclick="customBlock()">Custom ENUM</li>
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
                <div id="div_qtype_solution" class="row p-3">
                    
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
                <button id="btn_add_init" name="btn_add_init" class="btn btn-primary btn-block m-1" style="display: none;">Add Initiations</button>
                <button id="btn_add_res" name="btn_add_res" class="btn btn-primary btn-block m-1" style="display: none;">Add Result</button>
                <button id="btn_add_step" name="btn_add_step" class="btn btn-primary btn-block m-1" style="display: none;" onclick="changeCurrentStepCount();">Add Steps</button>
                <button id="btn_add_solution" name="btn_add_solution" class="btn btn-primary btn-block m-1" style="display: none;" onclick="addSolution();">Add Solutions</button>
                <hr>
                <button id="btn_view_qtype" name="btn_view_qtype" class="btn btn-primary btn-block m-1" style="display: none;">View Qtype</button>
                <button id="btn_new_qtype" name="btn_new_qtype" class="btn btn-primary btn-block m-1" onclick="setObject()">New Qtype</button>
                <button id="btn_save_qtype" name="btn_save_qtype" class="btn btn-primary btn-block m-1" style="display: none;">Save Qtype</button>
                <button id="btn_del_qtype" name="btn_del_qtype" class="btn btn-primary btn-block m-1" onclick="deleteQtype();" style="display: none;">Delete Qtype</button>
                
                <input type="hidden" id="hid_newqtypeflag"  name="hid_newqtypeflag" value="0">
                <input type="hidden" name="hid_cont_add_step_count" id="hid_cont_add_step_count" value="0">
                <input type="hidden" name="hid_current_step_count" id="hid_current_step_count" value="1">
            </div>
        </div>
    </div>
</div>
    <script src="js/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

        ar = {
                "QType": 1,
                "Qtype Name": "Multiplication of 2 Mixed fraction",
                "Question": [],
                "Solution":[],
            }
        isSoltion = 0;
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

        // =================================================================
        // START : Function For Show and Hide Content 
        // =================================================================
            function showContent(id)
            {
                $('#'+id).css('display', 'block');
            }

            function hideContent(id)
            {
                $('#'+id).css('display', 'none');
            }
        // =================================================================
        // END : Function For Show and Hide Content 
        // =================================================================

        // =================================================================
        // START : Add HTML Code, ENUM
        // =================================================================
            // Function For getting HTML Code of Improper Fractions
            function Improper(param_val, hid_val)
            {
                var current_step_count = parseInt($('#hid_current_step_count').val());
                var html               = '';
                var txt_hid_val        = parseInt($('#'+hid_val).val());
                txt_hid_val            = parseInt(txt_hid_val) + 1;
                $('#'+hid_val).val(txt_hid_val);
                
                var hid_newqtypeflag   = $('#hid_newqtypeflag').val();
                
                if(hid_newqtypeflag != 0)
                {
                    enumCount++;
                    // if(hid_newqtypeflag == 1)
                    // {
                        createJson(param_val);
                    //     from_where = 'qtype';
                    // }
                    // else if(hid_newqtypeflag == 2)
                    // {
                    //     from_where = 'Solution';
                    // }
                    
                    html += '<div id="div'+enumCount+'" class="col-md-5">';
                        html += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                            html += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';  // , \''+from_where+'\'
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
                    // enumCount1 = enumCount - 1; 
                    // $('#cancel_div'+enumCount1).empty();
                    // if(hid_newqtypeflag == 1)
                    // {
                        $('#div_qtype').append(html);
                    // }
                    // else if(hid_newqtypeflag == 2)
                    // {
                    //    var current_step_count = $('#hid_current_step_count').val();
                    //    $('#div_step_'+current_step_count).append(html); 
                    // }
                }
                else
                {
                    alert('Sorry, You have to add QType First!');
                }
            }

            // Function For getting HTML Code of Mixed Fractions
            function Mixed(param_val, hid_val)
            {
                var current_step_count = parseInt($('#hid_current_step_count').val());
                var html               = '';
                var txt_hid_val        = parseInt($('#'+hid_val).val());
                txt_hid_val            = parseInt(txt_hid_val) + 1;
                $('#'+hid_val).val(txt_hid_val);
                
                var hid_newqtypeflag   = $('#hid_newqtypeflag').val();

                if(hid_newqtypeflag != 0)
                {
                    enumCount++;
                    createJson(param_val);
                    
                    html += '<div id="div'+enumCount+'" class="col-md-5">';
                        html += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                            html += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
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
                    // enumCount1 = enumCount - 1; 
                    // $('#cancel_div'+enumCount1).empty().html('&nbsp;');
                    $('#div_qtype').append(html);
                }
                else
                {
                    alert('Sorry, You have to add QType First!');
                }
            }

            // Function For getting HTML Code of Multiplication Operator
            function Multiply(param_val, hid_val)
            {

                var current_step_count = parseInt($('#hid_current_step_count').val());
                var html               = '';
                var txt_hid_val        = parseInt($('#'+hid_val).val());
                txt_hid_val            = parseInt(txt_hid_val) + 1;
                $('#'+hid_val).val(txt_hid_val);
                
                var hid_newqtypeflag   = $('#hid_newqtypeflag').val();

                if(hid_newqtypeflag != 0)
                {
                    enumCount++;
                    createJson(param_val);
                    
                    html_data = '';

                    html_data += '<div id="div'+enumCount+'" class="col-md-2" align="center">';
                        html_data += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                            html_data += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
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
                    // enumCount1 = enumCount - 1; 
                    // $('#cancel_div'+enumCount1).empty().html('&nbsp;');
                    $('#div_qtype').append(html_data);
                }
                else
                {
                    alert('Sorry, You have to add QType First!');
                }
            }
        // =================================================================
        // END : Add HTML Code, ENUM
        // =================================================================
        
        // =================================================================
        // START : Function For Add QType Section [Dn By Prathamesh on 16052018]
        // =================================================================
            function checkParamType(param_val)
            {
                // console.log(param_val);
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
                
                // console.log(ar);
                $('#jasonData').html(ar);
                arr = JSON.stringify(ar);
                $('#jasonData').html(arr);

                // console.log(ar.Question.length);

                if(ar.Question.length > 0)
                {
                    showContent('btn_add_solution');
                    showContent('btn_del_qtype');
                    // showContent('btn_save_qtype');
                    hideContent('btn_new_qtype');
                }
                
                // console.log(arr);
            }

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
                    var QTypeName = prompt("Please Enter QType Name:");
                    console.log(QTypeName);
                    if (QTypeName != null)
                    {
                        if(QTypeName != '')
                        {
                            $('#hid_newqtypeflag').val(1);
                            $('#div_qtype').html('<div class="col-md-2"><span class="badge badge-info badge-pill">QType: </span></div><div class="col-md-10"><h2 id="qtype_name">'+QTypeName+'</h2></div>');
                            
                            ar = {
                                "QType": 1,
                                "Qtype_Name": "Multiplication of 2 Mixed fraction",
                                "Question": [],
                                "Solution":[],
                            }

                            ar.Qtype_Name = QTypeName;
                        }
                        else
                        {
                            alert('Please Insert the Valid QType name');
                        }
                    }
                }
                else
                {
                    alert("Sorry, You have already added one QType!");                
                }
            }
        // =================================================================
        // END : Function For Add QType Section [Dn By Prathamesh on 16052018]
        // =================================================================

        // =================================================================
        // START : Remove Element From QTypes
        // =================================================================
            function getRmElement(btnCount)
            {
                $('#div'+btnCount).remove();
                var len = (ar.Question.length) - 1;
                ar.Question.splice(len,1);

                $('#rmBtn'+(btnCount-1)).css('display','block');
                
                if(ar.Question.length == 0)
                {
                    hideContent('btn_add_solution');
                }

                arr = JSON.stringify(ar);
                $('#jasonData').html(arr);
            }
        // =================================================================
        // END : Remove Element From QTypes
        // =================================================================

        // =================================================================
        // START : Delete Entire QType [Reset as a New Window]
        // =================================================================
            function deleteQtype()
            {
                var confirmDelete = confirm("Are you sure, You want to delete this?");
                // console.log(confirmDelete);
                if(confirmDelete)
                {
                    ar = {
                            "QType": 1,
                            "Qtype Name": "Multiplication of 2 Mixed fraction",
                            "Question": [],
                            "Solution":[],
                        }
                    isSoltion = 0;
                    enumCount = 0;

                    arr = {};

                    $('#div_editor_contain').empty();
                    $('#div_editor_contain').html('<div id="div_qtype" class="row p-3"></div><div id="div_qtype_solution" class="row p-3"></div>');
                    $('#jasonData').empty();

                    $('#hid_newqtypeflag').val(0);
                    $('#hid_cont_add_step_count').val(0);
                    $('#hid_current_step_count').val(1);
                    $('#hid_op_multiply_count').val(0);
                    $('#hid_bb_improper_fraction_count').val(0);
                    $('#hid_bb_mixed_fraction_count').val(0);

                    showContent('btn_new_qtype');
                    hideContent('btn_save_qtype');
                    hideContent('btn_add_solution');
                    hideContent('btn_add_step');
                    hideContent('btn_del_qtype');
                    hideContent('btn_view_qtype');
                    hideContent('btn_add_res');
                    hideContent('btn_add_init');
                }
                else
                {
                    return false;
                }
            }
        // =================================================================
        // END : Delete Entire QType [Reset as a New Window]
        // =================================================================

        // =================================================================
        // START : Function For Add Solution Section [Dn By Prathamesh on 16052018]
        // =================================================================
            function getSolutionArray()
            {
                solutionData =  {
                                    "Start":"Initiations",
                                    "Steps": [],
                                    "End":"Result"
                                }
                return solutionData;
            }

            function createSolutionJson()
            {
                solutionData = getSolutionArray();

                ar.Solution.push(solutionData);

                // console.log(ar);
                $('#jasonData').html(ar);
                arr = JSON.stringify(ar);
                $('#jasonData').html(arr);

                if(ar.Solution.length > 0)
                {
                    showContent('btn_add_step');
                }

                // console.log(arr);
            }

            function addSolution()
            {
                var hid_newqtypeflag = $('#hid_newqtypeflag').val();
                if(hid_newqtypeflag != 0)
                {
                    // console.log($('#div_qtype').find('div').length);
                    if( $('#div_qtype').find('div').length > 1)
                    {
                        if(hid_newqtypeflag != 2)
                        {
                            $('#hid_newqtypeflag').val(2);
                        }
                        isSoltion++;
                        html_data = '<div class="col-md-12" style="height:30px;background-color:#116cff;color:#FFF;">';
                            html_data += 'Display Solution: '+isSoltion;
                        html_data += '</div>';
                        html_data += '<div id="div_init" class="row p-3">';
                            html_data += '<div class="col-md-12">';
                                html_data += '<span class="badge badge-info badge-pill">Initiations :</span>';
                            html_data += '</div>';
                        html_data += '</div>';
                        html_data += '<div id="div_step_1" class="row p-3">';
                            html_data += '<div class="col-md-12">';
                                html_data += '<span class="badge badge-info badge-pill">Step 1:</span>';
                            html_data += '</div>';
                        html_data += '</div>';
                        
                        $('.rmBtn').css('display','none');
                        createSolutionJson();
                        $('#div_qtype_solution').append(html_data); 
                    }
                    else
                    {
                        alert('Sorry, Please add Question Type first!');
                    }
                }
                else
                {
                    alert('Sorry, Please add QType first!');
                }
            }
        // =================================================================
        // END : Function For Add Solution Section [Dn By Prathamesh on 16052018]
        // =================================================================

        // =================================================================
        // START : Function For Adding New Step inside the Current Solution
        // =================================================================
            function changeCurrentStepCount()
            {
                var current_step_count = $('#hid_current_step_count').val();
                // alert(current_step_count);
                new_step_count         = parseInt(current_step_count) + 1;
                $('#hid_current_step_count').val(new_step_count);
                
                data = "<hr><div id='div_step_"+new_step_count+"' class='row p-3'><div class='col-md-12'><span class='badge badge-info badge-pill'>Step "+new_step_count+":</span></div></div>";
                $('#div_editor_contain').append(data);
            }
        // =================================================================
        // END : Function For Adding New Step inside the Current Solution
        // =================================================================

        // =================================================================
        // START : Function for adding building-block
        // =================================================================
            function add_building_block(param_val, building_block_name)
            {
                // console.log(param_val+' '+building_block_name);
                var hid_newqtypeflag = $('#hid_newqtypeflag').val();

                if(hid_newqtypeflag != 0)
                {
                    enumCount++;
                    // Calling Function For Creating JSON

                    html = '<div id="div'+enumCount+'" class="col-md-12">';
                        html += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                            html += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
                        html += '</div>';
                        html += '<div style="border:3px dashed #ccc;background-color: hsla(0,0%,100%,.25);overflow-y:auto;">';
                            html += 
                            html += building_block_name;
                        html += '</div>';
                    html += '</div>';

                    $('.rmBtn').css('display','none');
                    
                    var current_step_count = $('#hid_current_step_count').val();
                    $('#div_step_'+current_step_count).append(html); 
                }
                else
                {
                    alert('Sorry, You have to add QType First!');
                }
            }
        // =================================================================
        // END : Function for adding building-block
        // =================================================================

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