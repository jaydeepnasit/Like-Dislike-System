<?php

session_start();

require_once 'Config/Functions.php';
$Fun_call = new Functions();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])){
    header('Location:index.php');
}

$select_post = $Fun_call->select_order('poster','p_id');

$field['u_uni_no'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('user',$field);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Like-Dislike System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <div class="container mt-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="post.php"><b>LIKE-DISLIKE SYSTEM</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline ml-auto">
                    <div class="user-area">
                        <img src="Background/Users/<?php echo $sel_user_img['u_image']; ?>" alt="User">
                    </div>
                    <a href="logout.php" class="logout my-2 my-sm-0"><i class="fas fa-power-off fa-2x"></i></a>
                </form>
            </div>
        </nav>
    </div>

    <div class="container mt-2">
        <div class="row row-cols-1 row-cols-md-3">
            <?php if($select_post){ foreach($select_post as $post_val){ ?>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="Background/Post/<?php echo $post_val['p_image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post_val['p_name']; ?></h5>
                        <p class="card-text"><?php echo $post_val['p_text']; ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="LD-area">
                            <?php

                                $ld_status1 = $ld_status2 = '';

                                $ver_field['r_u_id'] = $_SESSION['user_uni_no'];
                                $ver_field['r_p_id'] = $post_val['p_uni_id'];

                                $check_like = $Fun_call->select_assoc('rating_info',$ver_field);
                                
                                $ch_val = $check_like['r_u_choice'];
                                if($ch_val == 'Like'){
                                    $ld_status1 = "LD-color";
                                }elseif($ch_val == 'Dislike'){
                                    $ld_status2 = "LD-color";
                                }
                                else{
                                    $ld_status1 = $ld_status2 = '';
                                }

                                $ver_field2['r_p_id'] = $post_val['p_uni_id'];
                                $ver_field2['r_u_choice'] = 'Like';
                                $check_like_count = $Fun_call->select_count('rating_info',$ver_field2);

                                $ver_field2['r_u_choice'] = 'Dislike';
                                $check_dislike_count = $Fun_call->select_count('rating_info',$ver_field2);

                            ?>
                            <div class="LD-area-sub" >
                                <i class="fas fa-thumbs-up <?php echo $ld_status1; ?>" id="<?php echo $post_val['p_uni_id']; ?>" data-postid="<?php echo $post_val['p_uni_id']; ?>"></i> <span class="like-count"><?php if(is_numeric($check_like_count['NumberOfLikeDislike'])){ echo $check_like_count['NumberOfLikeDislike']; } ?></span>
                            </div>
                            <div class="LD-area-sub">
                                <i class="fas fa-thumbs-down <?php echo $ld_status2; ?>" id="456" data-postid="<?php echo $post_val['p_uni_id']; ?>"></i> <span class="dislike-count"><?php if(is_numeric($check_dislike_count['NumberOfLikeDislike'])){ echo $check_dislike_count['NumberOfLikeDislike']; } ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $(document).ready(function (){

            var user_id= '<?php echo $_SESSION['user_uni_no']; ?>';

            $(".LD-area-sub > i.fa-thumbs-up").on("click", function(){
                var post_id = $(this).data('postid');
                var choice = 'Like';
                $se_btn1 = $(this);
                $se_btn2 = $(this).closest("div.LD-area").find("i.fa-thumbs-down");
                $.ajax({
                    type: "POST",
                    url: "Ajax/ldsystem.php",
                    data: {'userid' : user_id, 'postid' : post_id, 'choice' : choice},
                    success: function (response) {
                        var get_status = JSON.parse(response);
                        if(get_status.status == 101){
                            $se_btn1.removeClass("LD-color");
                            $se_btn1.siblings('span.like-count').text(get_status.like);
                        }
                        else if(get_status.status == 102){
                            $se_btn2.removeClass("LD-color");
                            $se_btn1.addClass("LD-color");
                            $se_btn1.siblings('span.like-count').text(get_status.like);
                            $se_btn2.siblings('span.dislike-count').text(get_status.dislike);
                        }
                        else if(get_status.status == 103){
                            $se_btn1.addClass("LD-color");
                            $se_btn1.siblings('span.like-count').text(get_status.like);
                        }
                        else{
                            console.log(get_status.status+'-->'+get_status.msg);
                        }
                    }
                });
            });

            $(".LD-area-sub > i.fa-thumbs-down").on("click", function(){
                var post_id = $(this).data('postid');
                var choice = 'Dislike';
                $se_btn1 = $(this);
                $se_btn2 = $(this).closest("div.LD-area").find("i.fa-thumbs-up");
                $.ajax({
                    type: "POST",
                    url: "Ajax/ldsystem.php",
                    data: {'userid' : user_id, 'postid' : post_id, 'choice' : choice},
                    success: function (response) {
                        var get_status = JSON.parse(response);
                        if(get_status.status == 201){
                            $se_btn1.removeClass("LD-color");
                            $se_btn1.siblings('span.dislike-count').text(get_status.dislike);
                        }
                        else if(get_status.status == 202){
                            
                            $se_btn1.addClass("LD-color");
                            $se_btn2.removeClass("LD-color");
                            $se_btn1.siblings('span.dislike-count').text(get_status.dislike);
                            $se_btn2.siblings('span.like-count').text(get_status.like);
                        }
                        else if(get_status.status == 203){
                            $se_btn1.addClass("LD-color");
                            $se_btn1.siblings('span.dislike-count').text(get_status.dislike);
                        }
                        else{
                            console.log(get_status.status+'-->'+get_status.msg);
                        }
                    }
                });
            });

        });

    </script>

</body>

</html>