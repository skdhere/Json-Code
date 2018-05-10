<?php
	$json = file_get_contents('php://input');
	$obj  = json_decode($json);

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

	if((isset($obj->getHtml)) == "1" && (isset($obj->getHtml)))
	{
		$param_val          = $obj->param_val;
		$txt_hid_val        = $obj->txt_hid_val;
		$current_step_count = $obj->current_step_count;
		$data               = '';
		$responce_arr       = array();

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
		
		$responce_arr = array("Success"=>"Success", "resp"=>$data);
		echo json_encode($responce_arr);
		exit();
	}
?>