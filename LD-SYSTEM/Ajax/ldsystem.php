<?php

session_start();

require_once '../Config/Functions.php';
$Fun_call = new Functions();

$json_ch = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if((isset($_POST['userid']) && is_numeric($_POST['userid'])) && (isset($_POST['postid']) && is_numeric($_POST['postid'])) && (isset($_POST['choice']))){

        $userid = $Fun_call->validate($_POST['userid']);
        $postid = $Fun_call->validate($_POST['postid']);
        $choice = $Fun_call->validate($_POST['choice']);

        if(!empty(trim($userid)) && !empty(trim($postid)) && !empty(trim($choice))){

            $ch_con['r_u_id'] = $userid;
            $ch_con['r_p_id'] = $postid;

            $chi_con['r_u_id'] = $userid;
            $chi_con['r_p_id'] = $postid;
            $chi_con['r_u_choice'] = $choice;

            $chs_con['r_p_id'] = $postid;
            $chs_con['r_u_choice'] = $choice;

            if($choice == 'Like'){

                    $ch_rec = $Fun_call->select_assoc('rating_info', $ch_con);

                    if($ch_rec){

                        $fd_choice = $ch_rec['r_u_choice'];
                        if($fd_choice == 'Like'){

                            $de_rec = $Fun_call->delete('rating_info', $ch_con);
                            if($de_rec){

                                $check_like_count = $Fun_call->select_count('rating_info', $chs_con);
                                
                                $json_ch['status'] = 101;
                                $json_ch['msg'] = 'Already Liked';
                                $json_ch['like'] = $check_like_count['NumberOfLikeDislike'];
                                $json_ch['dislike'] = NULL;
                                
                            }
                            else{
                                $json_ch['status'] = 104;
                                $json_ch['msg'] = 'Like Not Deleted';
                                $json_ch['like'] = NULL;
                                $json_ch['dislike'] = NULL;
                            }

                        }
                        else{

                            $fields['r_u_choice'] = $choice;

                            $up_rec = $Fun_call->update('rating_info', $fields, $ch_con);
                            if($up_rec){
                                
                                $check_like_count = $Fun_call->select_count('rating_info', $chs_con);
                                $chs_con['r_u_choice'] = 'Dislike';
                                $check_dislike_count = $Fun_call->select_count('rating_info', $chs_con);

                                $json_ch['status'] = 102;
                                $json_ch['msg'] = 'Already Disliked now Updated';
                                $json_ch['like'] = $check_like_count['NumberOfLikeDislike'];
                                $json_ch['dislike'] = $check_dislike_count['NumberOfLikeDislike'];
        
                            }
                            else{
                                $json_ch['status'] = 105;
                                $json_ch['msg'] = 'Like Not Updated';
                                $json_ch['like'] = NULL;
                                $json_ch['dislike'] = NULL;
                            }

                        }

                    }
                    else{

                        $ins_rec = $Fun_call->insert('rating_info', $chi_con);
                        if($ins_rec){

                            $check_like_count = $Fun_call->select_count('rating_info', $chs_con);

                            $json_ch['status'] = 103;
                            $json_ch['msg'] = 'Liked';
                            $json_ch['like'] = $check_like_count['NumberOfLikeDislike'];
                            $json_ch['dislike'] = NULL;

                        }
                        else{
                        $json_ch['status'] = 106;
                        $json_ch['msg'] = 'Like Not Added';
                        $json_ch['like'] = NULL;
                        $json_ch['dislike'] = NULL;
                        }
                    }
            }   
            elseif($choice == 'Dislike'){ 
              
                    $ch_rec = $Fun_call->select_assoc('rating_info', $ch_con);

                    if($ch_rec){

                        $fd_choice = $ch_rec['r_u_choice'];
                        if($fd_choice == 'Dislike'){

                            $de_rec = $Fun_call->delete('rating_info', $ch_con);
                            if($de_rec){

                                $check_dislike_count = $Fun_call->select_count('rating_info', $chs_con);
        
                                $json_ch['status'] = 201;
                                $json_ch['msg'] = 'Already Disliked';
                                $json_ch['like'] = NULL;
                                $json_ch['dislike'] = $check_dislike_count['NumberOfLikeDislike'];

                            }
                            else{
                                $json_ch['status'] = 204;
                                $json_ch['msg'] = 'Dislike Not Deleted';
                                $json_ch['like'] = NULL;
                                $json_ch['dislike'] = NULL;
                            }

                        }
                        else{

                            $fields['r_u_choice'] = $choice;

                            $up_rec = $Fun_call->update('rating_info', $fields, $ch_con);
                            if($up_rec){
        
                                $check_dislike_count = $Fun_call->select_count('rating_info', $chs_con);

                                $chs_con['r_u_choice'] = 'Like';
                                $check_like_count = $Fun_call->select_count('rating_info', $chs_con);

                                $json_ch['status'] = 202;
                                $json_ch['msg'] = 'Already Liked now Updated';
                                $json_ch['like'] = $check_like_count['NumberOfLikeDislike'];
                                $json_ch['dislike'] = $check_dislike_count['NumberOfLikeDislike'];
        
                            }
                            else{
                                $json_ch['status'] = 205;
                                $json_ch['msg'] = 'Dislike Not Updated';
                                $json_ch['like'] = NULL;
                                $json_ch['dislike'] = NULL;
                            }

                        }

                    }
                    else{

                        $ins_rec = $Fun_call->insert('rating_info', $chi_con);
                        if($ins_rec){

                            $check_dislike_count = $Fun_call->select_count('rating_info', $chs_con);

                            $json_ch['status'] = 203;
                            $json_ch['msg'] = 'Disliked';
                            $json_ch['like'] = NULL;
                            $json_ch['dislike'] = $check_dislike_count['NumberOfLikeDislike'];

                            
                        }
                        else{
                            $json_ch['status'] = 206;
                            $json_ch['msg'] = 'Dislike Not Inserted';
                            $json_ch['like'] = NULL;
                            $json_ch['dislike'] = NULL;
                        }
                    }                                
            }    
            else{

                    $json_ch['status'] = 301;
                    $json_ch['msg'] = 'Invalid Value Not Allow';
                    $json_ch['like'] = NULL;
                    $json_ch['dislike'] = NULL;

            } 

        }
        else{
            $json_ch['status'] = 302;
            $json_ch['msg'] = 'Invalid Value Not Allow';
            $json_ch['like'] = NULL;
            $json_ch['dislike'] = NULL;
        }

    }
    else{
        $json_ch['status'] = 303;
        $json_ch['msg'] = 'Invalid Data Not Allow';
        $json_ch['like'] = NULL;
        $json_ch['dislike'] = NULL;
    }

}
else{
    $json_ch['status'] = 304;
    $json_ch['msg'] = 'Invalid Request Method';
    $json_ch['like'] = NULL;
    $json_ch['dislike'] = NULL;
}

echo json_encode($json_ch);

?>