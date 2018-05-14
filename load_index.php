<?php
	$json = file_get_contents('php://input');
	$obj  = json_decode($json);
    session_start();

	function getHtmlForFraction($hid_incr_id, $current_step_count)
	{
		$html_data = '';

		$html_data .= '<div id="tbl_bb_frac_'.$hid_incr_id.'" class="col-md-5">';
            $html_data .= '<div>';
                $html_data .= '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_frac_'.$hid_incr_id.'\', '.$current_step_count.');"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            $html_data .= '</div>';
            $html_data .= '<table>';
                $html_data .= '<tr>';
                    $html_data .= '<td>';
                        $html_data .= '<div><input type="" class="form-control" name=""></div>';
                    $html_data .= '</td>';
                    $html_data .= '<td>';
                        $html_data .= '<div><input type="" class="form-control" name=""></div>';
                        $html_data .= '<hr>';
                        $html_data .= '<div><input type="" class="form-control" name=""></div>';
                    $html_data .= '</td>';
                $html_data .= '</tr>';
            $html_data .= '</table>';  
        $html_data .= '</div>';

		return $html_data;
	}

	function getHtmlForMultiplyOperator($hid_incr_id, $current_step_count)
	{
		$html_data = '';

		$html_data .= '<div id="tbl_op_multi_'.$hid_incr_id.'" class="col-md-2" align="center">';
            $html_data .= '<div>';
                $html_data .= '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_op_multi_'.$hid_incr_id.'\', '.$current_step_count.');"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            $html_data .= '</div>';
            $html_data .= '<table>';
                $html_data .= '<tr>';
                    $html_data .= '<td>';
                        $html_data .= '<div>&nbsp;</div>';
                        $html_data .= '<h3>X</h3>';
                        $html_data .= '<div>&nbsp;</div>';
                    $html_data .= '</td>';
                $html_data .= '</tr>';
            $html_data .= '</table>';  
        $html_data .= '</div>';

		return $html_data;
	}

	function getHtmlForImproperFraction($hid_incr_id, $current_step_count)
	{
		$html_data = '';

		$html_data .= '<div id="tbl_bb_improper_frac_'.$hid_incr_id.'" class="col-md-5">';
            $html_data .= '<div>';
                $html_data .= '<a href="javascript:void(0)" onclick="getRmElement(\'tbl_bb_improper_frac_'.$hid_incr_id.'\', '.$current_step_count.');"><i class="fa fa-times-circle" style="color:#f00;" aria-hidden="true"></i></a>';
            $html_data .= '</div>';
            $html_data .= '<table>';
                $html_data .= '<tr>';
                    $html_data .= '<td>';
                        $html_data .= '<div><input type="" class="form-control" name=""></div>';
                        $html_data .= '<hr>';
                        $html_data .= '<div><input type="" class="form-control" name=""></div>';
                    $html_data .= '</td>';
                $html_data .= '</tr>';
            $html_data .= '</table>';  
        $html_data .= '</div>';

		return $html_data;
	}

	if(@$_POST['test']==1)
	{
		$array = [];

		// $a                       = array();
		// $a['bb_mixed_fraction']  = array("name"=>'satish');
		// $a['bb_mixed_fraction1'] = array("name"=>'satish');
		// $a['bb_mixed_fraction']  = array("name"=>'satish');
		// $array['step1']          = $a;
		
		
		$mainArr                            =   $_SESSION['mainArr'];
		
		$array['step'.(sizeof($mainArr)+1)] =   $_SESSION['jsonArr'];
		
		
		$_SESSION['mainArr']  = [];
		array_push($mainArr,$array);

		$_SESSION['mainArr']   = $mainArr;
		// print_r($mainArr);
		echo json_encode($mainArr);
	}

	if((isset($obj->getHtml)) == "1" && (isset($obj->getHtml)))
	{
		$param_val          = $obj->param_val;
		$txt_hid_val        = $obj->txt_hid_val;
		$current_step_count = $obj->current_step_count;
		$data               = '';
		$responce_arr       = array();

		$jsonArr  = $obj->jsonArr;



		if($param_val == 'bb_mixed_fraction')
		{
			$data .= getHtmlForFraction($txt_hid_val, $current_step_count);
		}
		elseif($param_val == 'op_multiply')
		{
			$data .= getHtmlForMultiplyOperator($txt_hid_val, $current_step_count);
		}
		elseif($param_val == 'bb_improper_fraction')
		{
			$data .= getHtmlForImproperFraction($txt_hid_val, $current_step_count);
		}

		test($current_step_count,$param_val,$txt_hid_val);

		$responce_arr = array("Success"=>"Success", "resp"=>$data);
		echo json_encode($responce_arr);
		exit();
	}

	function test($current_step_count,$param_val,$txt_hid_val)
	{
		if(!isset($_SESSION['jsonArr']))
		{
			$_SESSION['jsonArr'] = array();
			$_SESSION['mainArr'] = array();
		}

		if($current_step_count==1)
		{
			$_SESSION['current_step_count'] = 1;
		}

		if($current_step_count != $_SESSION['current_step_count'])
		{
			$_SESSION['jsonArr'] = array();
			$_SESSION['current_step_count'] = $current_step_count;
		}

		$ar       = [];

		if($param_val=='bb_mixed_fraction')
		{
			$ar[$param_val] = ["w"=>$txt_hid_val,'n'=>'2','d'=>'5'];
		}else if($param_val =='bb_improper_fraction')
		{
			$ar[$param_val] = ['n'=>'2','d'=>'5'];
		}else
		{
			$ar[$param_val] = ['operator'=>$param_val];
		}

       
        $array          = $_SESSION['jsonArr'];

		array_push($array,$ar);

		$_SESSION['jsonArr'] = $array;

		// print_r($_SESSION);
	}
?>