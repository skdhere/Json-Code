<?php
    $json_data = file_get_contents('abc.json');
    $json_arr  = json_decode($json_data,true);
    

    function rmSquare($str)
    {
        $final_str = trim((str_replace(array('[',']',' '),array('','',''), $str)));
        return $final_str;
    }

    function strNum($num1)
    {
        $final_num = rmSquare(substr($num1, 0,strpos($num1, '<br>')));
        return $final_num;
    }

    function strDen($den1)
    {
        $final_den = rmSquare(str_replace('<br>', '',strstr($den1, '<br>')));
        return $final_den;
    }



    $func_arr  = array();
    foreach($json_arr['Solutions'][0]['Steps'] as $steps)
    {
        array_push($func_arr,$steps);
    }
    
    $var_arr = array();

    $output    = array();
    function setVariables($w,$n,$d)
    {
        global $output;
        global $var_arr;
        $v  = $n.','.$d.','.$w;

        $output['v'.(count($output)+1)]  = $v;
    }

    function getMixedFraction()
    {
        $w = rand(1,20);
        $n = rand(1,9);
        $d = rand(1,9);

        //==============Start : Done by satish 13may2018===========//
        if($n > $d)
        {
            $temp = $n;
            $n    = $d;
            $d    = $temp;
        }
        elseif($n == $d)
        {
            if($n==1) // check n and d is equal or not
            {
                $d = $d + 1;
            }else
            {
                $n = $n - 1;
            }
        }
        //==============End : Done by satish 13may2018===========//

        setVariables($w,$n,$d);

        $html_data = '';

        $html_data .= '<div class="col-md-5">';
            $html_data .= '<table>';
                $html_data .= '<tr>';
                    $html_data .= '<td>';
                        $html_data .= '<div><input type="" class="form-control" name="" value="'.$w.'" readonly></div>';
                    $html_data .= '</td>';
                    $html_data .= '<td>';
                        $html_data .= '<div><input type="" class="form-control" name="" value="'.$n.'" readonly></div>';
                        $html_data .= '<hr>';
                        $html_data .= '<div><input type="" class="form-control" name="" value="'.$d.'" readonly></div>';
                    $html_data .= '</td>';
                $html_data .= '</tr>';
            $html_data .= '</table>';  
        $html_data .= '</div>';
        return $html_data;
    }

    
    function getOperator($op_val)
    {
        $html_data = '';    

        $html_data .= '<div class="col-md-2" align="center">';
            $html_data .= '<table>';
                $html_data .= '<tr>';
                    $html_data .= '<td>';
                        $html_data .= '<div>&nbsp;</div>';
                        if($op_val == 'op_multiply')
                        {
                            $html_data .= '<h3>X</h3>';
                        }
                        $html_data .= '<div>&nbsp;</div>';
                    $html_data .= '</td>';
                $html_data .= '</tr>';
            $html_data .= '</table>';  
        $html_data .= '</div>';

        return $html_data;
    }


    
    function shellExcecute($func_name,$param)
    {
        $url = "C:/Python27/python.exe satish-test.py $func_name $param";
        $res = shell_exec($url);
        return $res;
    }


    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo ucfirst($json_arr['Qtype_Name']); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>

<div class="jumbotron text-center">
    <h1 id="qtype_name"><?php echo ucfirst($json_arr['Qtype_Name']); ?></h1>
</div>

<div class="container-fluid">
    <div id="question" class="row">
        <div class="col-md-2">
            &nbsp;
        </div>
        <div class="col-md-8">
            <div id="div_editor_contain" class="col-md-12 droppable">
                <div class="row p-3" id="question">
                <?php
                foreach ($json_arr['Question_Format'] as $question) 
                {
                    if($question['Name']=='enum_mixed_fraction')
                    {
                        echo getMixedFraction();
                    }

                    if($question['Name'] == 'op_multiply')
                    {
                        echo getOperator('op_multiply');
                    }
                }

                // $v1 = $var_arr[0];
                // $v2 = $var_arr[1];
                ?>
                </div>
            </div>    
        </div>
        <div class="col-md-2">
            &nbsp;
        </div>
    </div>
</div>
<?php

$output['v1'] ="3,4,3";
$output['v2'] ="1,3,3";

$k = 1;
$v = 'n';

$m = 0;
$ar1 = array('FNum','FDenum');
foreach ($func_arr as $step) {
    foreach($step['BB_Format'] as $format)
    {
        
            $frmt = $format['Format'][0];
            $out  = shellExcecute($frmt['BB_Function'],@$output[$frmt['Input']]);
            
            if($frmt['BB_Function']=='multiplyFactors') 
            {
                // echo $frmt['BB_Function'];
                // echo $out;
                $output[$ar1[$m]] = $out;
                $m++;
            }
            
            if($frmt['BB_Function']=='cancelCommonFactors')
            {
               $p = @$output['FConNumFactors'].' '.@$output['FConDenumFactors'];

               $out  = shellExcecute($frmt['BB_Function'],@$p);
                 

                
                $result_num  = strNum($out);
                
               
                $output['FNumFactors']   = $result_num;
                $output['FDenumFactors'] = $result_deno;
            }
           if($frmt['BB_Function'] =='computeListOfPrimeFactors')
            {
                // echo $out;
                $result_num  = strNum($out);
                $result_deno = strDen($out);
                
                $output['fn'.$k]     = $result_num;
                $output['fd'.$k]     = $result_deno;
                $k++;

            }
            elseif($frmt['BB_Function'] =='Concatenation')
            {
                $output[$frmt['Output']] = $output['f'.$v.'1'].','.$output['f'.$v.'2'];
                $v = 'd';
            }
            elseif($frmt['BB_Function'] =='convertImproperToMixedFraction')
            {
                $p = @$output['FNum'].' '.@$output['FDenum'];
                $out  = shellExcecute($frmt['BB_Function'],@$p);
                $out  = rmSquare($out);
                $output['FResult'] = $out;
                
            }else
            { 
                $out  = rmSquare($out);
                $output[$frmt['Output']] = $out;
            }
    }
}

unset($output['fn3']);
unset($output['fd3']);
unset($output['fn4']);
unset($output['fd4']);
var_dump($output);

?>
<br>
  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            
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
                             Convert mixed in improper function
                        </a>
                        <input type="hidden" name="hid_bb_improper_fraction_count" id="hid_bb_improper_fraction_count" value="0">
                    </li>
                    <li class="list-group-item" onclick="customBlock()">BB 3</li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
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
            </div>
             <div id="jasonData"></div>
        </div>
        <div class="col-md-2">
            <div class="col-md-12" style="border:3px dashed #ccc;background-color: hsla(0,0%,100%,.25);height:500px">
                <button class="btn btn-primary btn-block m-1" id="initBtn" onclick="init()">Add Initiations</button>
               
                <button class="btn btn-primary btn-block m-1" onclick="changeCurrentStepCount();">
                    Add Steps
                </button>
                <hr>
<!-- 
                <button class="btn btn-primary btn-block m-1">View Qtype</button>
                <button class="btn btn-primary btn-block m-1">New Qtype</button> -->
            </div>
        </div>
    </div>
    
</div>
    <script src="js/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

        JsonArr = {
              "QType": 1,
              "Qtype Name": "Multiplication of 2 Mixed fraction",
              "Question": [],
              "Solution":[],
            }
        isSoltion = false;
        enumCount = 0;
        
        function init()
        {
            var question = $('#question').html();
            $('#div_qtype').append('<div class="col-md-12"><span class="badge badge-info badge-pill">Initiations:</span></div>');
            $('#div_qtype').append(question);

            $('#initBtn').css('display','none');
        }
        //set blank when adding new question type
        function getRmElement(btnCount)
        {
            $('#div'+btnCount).remove();

            var len = (JsonArr.Question.length) - 1;

            JsonArr.Question.splice(len,1);

            $('#rmBtn'+(btnCount-1)).css('display','block');

            arr = JSON.stringify(JsonArr);

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
            enumCount++;
            html = '';
             html = '<div id="div'+enumCount+'"  class="row">';
             html += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                html += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            html += '</div>';

            html += '<div class="col-md-5">';
                
                html += '<table>';
                    html += '<tr>';
                        html += '<td>';
                            html += '<div><input type="text" name="v1n1" id="v1n1" class="form-control numsonly" name="" onkeypress="return numsonly(event)" maxlength="3" id="v1n1"></div>';
                            html += '<hr>';
                            html += '<div><input type="text" name="v1d1" id="v1d1" class="form-control numsonly" onkeypress="return numsonly(event)" name="" maxlength="3" id="v1d1"></div>';
                        html += '</td>';
                    html += '</tr>';
                html += '</table>';  
            html += '</div>';

           
            html += MultiplyQuestion();


            html += '<div  class="col-md-5">';
               
                html += '<table>';
                    html += '<tr>';
                        html += '<td>';
                            html += '<div><input type="text" name="v2n2" id="v2n2" class="form-control" name="" onkeypress="return numsonly(event)" maxlength="3" id="v2n2"></div>';
                            html += '<hr>';
                            html += '<div><input type="text" name="v2d2" id="v2d2" class="form-control" name="" onkeypress="return numsonly(event)" maxlength="3"  id="v2d2"></div>';
                        html += '</td>';
                    html += '</tr>';
                html += '</table>';  
            html += '</div>';

            html += '<button class="btn btn-success" style="padding:0px" onclick="check()">Check </button>';

            html += '</div>';

            $('.rmBtn').css('display','none');

            $('#div_qtype').append(html);
        }

        function MixedQuestion(param_val, hid_val)
        {

            var w = parseInt(Math.random().toFixed(2)*100);
            var n = parseInt(Math.random().toFixed(2)*100);
            var d = parseInt(Math.random().toFixed(2)*100);

            var da = JSON.stringify({'w':3});
            $.ajax({
                url: "test-satish.py?",
                type: "POST",
                data: { 'parameter1': 'value1', 'parameter2': 'value2' },
                                   
                success: function(response) 
                {
                    console.log(response);
                    json = JSON.parse(response);
                    $('#qtype_name').html(json.Qtype_Name);
                    showQuestion(json);
                },
                error: function (request, status, error) 
                {},
                complete: function()
                {}
            });

            html ='';
            html += '<table>';
                html += '<tr>';
                    html += '<td>';
                        html += '<div>'+w+'</div>';
                    html += '</td>';
                    html += '<td>';
                        html += '<div>'+n+'</div>';
                        html += '<hr>';
                        html += '<div>'+d+'</div>';
                    html += '</td>';
                html += '</tr>';
            html += '</table>';  
            
            return html;
            
        }

        function MultiplyQuestion(param_val, hid_val)
        {       
            
            html_data ='';
            html_data += '<table>';
                html_data += '<tr>';
                    html_data += '<td>';
                        html_data += '<div>&nbsp;</div>';
                        html_data += '<h3>X</h3>';
                        html_data += '<div>&nbsp;</div>';
                    html_data += '</td>';
                html_data += '</tr>';
            html_data += '</table>';  
            return html_data;
        }

        function Mixed(param_val, hid_val)
        {
            var current_step_count = parseInt($('#hid_current_step_count').val());
            var html               = '';
            var txt_hid_val        = parseInt($('#'+hid_val).val());
            txt_hid_val            = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            
            enumCount++;
            
            html += '<div id="div'+enumCount+'" class="col-md-5">';
                html += '<div id="cancel_div'+enumCount+'" style="height:15px;">';
                    html += '<a href="javascript:void(0)" onclick="getRmElement('+enumCount+');" id="rmBtn'+enumCount+'" class="rmBtn"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
                html += '</div>';
                html += '<table>';
                    html += '<tr>';
                        html += '<td>';
                            html += '<div><input type="" class="form-control numsonly" name=""></div>';
                        html += '</td>';
                        html += '<td>';
                            html += '<div><input type="" class="form-control numsonly" name=""></div>';
                            html += '<hr>';
                            html += '<div><input type="" class="form-control numsonly" name=""></div>';
                        html += '</td>';
                    html += '</tr>';
                html += '</table>';  
            html += '</div>';

            $('.rmBtn').css('display','none');
            $('#div_qtype').append(html);
        }

        function Multiply(param_val, hid_val)
        {

            var current_step_count = parseInt($('#hid_current_step_count').val());
            var html               = '';
            var txt_hid_val        = parseInt($('#'+hid_val).val());
            txt_hid_val            = parseInt(txt_hid_val) + 1;
            $('#'+hid_val).val(txt_hid_val);
            
            var hid_newqtypeflag = $('#hid_newqtypeflag').val();

            enumCount++;
            
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
            // $('#cancel_div'+enumCount).html('');
            $('#div_qtype').append(html_data);
           
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


        function loadQuestion()
        {
            $.ajax({
                url: "userAction.php?",
                type: "POST",
                contentType: "application/json; charset=utf-8",                     
                success: function(response) 
                {
                    json = JSON.parse(response);
                    $('#qtype_name').html(json.Qtype_Name);
                    showQuestion(json);
                },
                error: function (request, status, error) 
                {},
                complete: function()
                {}
            });
        }
       
        // loadQuestion();

        function showQuestion(json)
        {
            var variable = json.Question;
            var html     = '';
            for(var i = 0;i<variable.length;i++)
            {
                if(variable[i].name =='Mixedfraction')
                {
                    html +='<div class="col-md-1">';
                    html += MixedQuestion();
                     html +='</div>';
                }

                if(variable[i].name =='Multiply')
                {
                    html +='<div class="col-md-1">';
                    html += MultiplyQuestion();
                    html +='</div>';
                }
            }

            $('#question').html(html);
        }

        function check()
        {

        }

        </script>

    <script type="text/javascript" src="js/ASCII.js"></script>
    <script type="text/javascript" src="custom.js"></script>
</body>
</html>
