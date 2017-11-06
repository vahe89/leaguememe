<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo (isset($meta_title)) ? $meta_title : 'Leaguememe'; ?></title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : 'Leaguememe'; ?>"/>
        <meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : 'Leaguememe'; ?>"/>
        <meta name="author" content="LeaguaMeme.com "/>
        <?php
        $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?> 
        <?php
        
        if (isset($league_details[0]) && !empty($league_details[0])){
           ?>         
        <meta property = "og:description" content = "Entertainment legends" />
        <meta property = "og:title" content = "<?php echo $league_details[0]->leagueimage_name;?>" />
        <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
        <meta property="fb:app_id" content="428116147382282" /> 
        <!--<meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />-->

        <?php
        $filename = $league_details[0]->leagueimage_filename;
        $extention = pathinfo($filename, PATHINFO_EXTENSION);
         if ($extention) {
        ?>        
            <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
            <meta property="og:image:width" content="200" />
            <meta property="og:image:height" content="200" />
        <?php 
           } elseif (empty($league_details[0]->videoname)){
         ?>
            <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
            <meta property="og:image:width" content="200" />
            <meta property="og:image:height" content="200" />
         <?php 
           } else {
         ?>
            <meta property="og:video"             content="<?php echo base_url(); ?>uploads/league/mp4/<?php echo $league_details[0]->videoname; ?>" />
            <meta property="og:video:secure_url"  content="<?php echo base_url(); ?>uploads/league/mp4/<?php $league_details[0]->videoname; ?>" />
            <meta property="og:video:type"        content="video/mp4" />
            <meta property="og:video:width"       content="822" />
            <?php
           }
         }else{
             ?>
         <meta property = "og:description" content = "Entertainment legends" />
        <meta property = "og:title" content = "Leaguememe-League of Legends Entertainment" />
        <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
         <?php
         }
        ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>

        <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>


        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/popupstyle.css" />
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/style.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/dropzone.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/mobile.css">

        <script src="<?php echo base_url(); ?>assets/public/js/vendor/modernizr-2.6.2.min.js"></script>

        <!--        
                Date Picker 
        -->               
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">

        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url(); ?>assets/public/js/jquery-2.0.2.min.js"></script>
        <script>
            $(document).ready(function () {
                //Скрыть PopUp при загрузке страницы    
                shareHide();
            });
            //Функция отображения PopUp
            function shareShow() {
                $("#share1").show().delay();
            }
            //Функция скрытия PopUp
            function shareHide() {
                $("#share1").hide();
            }
        </script>
        <style>
            span.play {
                background: #222 none repeat scroll 0 0;
                border: 5px solid #fff;
                border-radius: 35px;
                color: #fff;
                font-size: 20px;
                font-weight: 700;
                height: 64px;
                left: 50%;
                line-height: 58px;
                margin-left: -30px;
                margin-top: -30px;
                opacity: 0.9;
                overflow: hidden;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                top: 38%;
                width: 67px;
            }
            .footer-msg {
                position:fixed;
                left:0px;
                bottom:10px;
                height:30px;
                width:10%;
                background:#999;
            }
            * html .footer-msg {
                position:absolute;
                //top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
            }
        </style>   

        <script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script>

        <!-- Bootstrap 3.3.5 -->
        <!--<script src="<?php //echo base_url();           ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>-->
        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>


        <!-- datepicker -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

    </head>

