<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php echo base_url(); ?>assets/public/img/favicon-96x96.png" type="image/x-icon">

        <title><?php echo (isset($meta_title)) ? $meta_title : 'Leaguememe'; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : 'Leaguememe'; ?>"/>
        <meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : 'Leaguememe'; ?>"/>
        <meta name="author" content="leaguememe.com "/>
        <?php
        $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?> 
        <?php
        if (isset($league_details[0]) && !empty($league_details[0])) {
            ?>         
            <meta property="og:description" content="Entertainment legends" />
            <meta property="og:title" content="<?php echo $league_details[0]->leagueimage_name; ?>" />
            <meta property="og:url" content="<?php echo $actual_link; ?>" />
            <meta property="fb:app_id" content="852663711513838" /> 
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
            } elseif (empty($league_details[0]->videoname)) {
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
        } else {
            ?>
            <meta property = "og:description" content = "Entertainment legends" />
            <meta property = "og:title" content = "Leaguememe-League of Legends Entertainment" />
            <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
            <?php
        }
        ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';</script>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/public/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles -->
        <!--<link href="<?php echo base_url(); ?>assets/public/css/style.css" rel="stylesheet">-->
        <link href="<?php echo base_url(); ?>assets/public/css/style.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/helper.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/hack.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/pop-up.css" rel="stylesheet">
        <!--<link href="<?php echo base_url(); ?>assets/public/css/responsive.css" rel="stylesheet">-->
        <link href="<?php echo base_url(); ?>assets/public/css/responsive.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/dropzone.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/dropdown-enhancement.css">

        <link href="<?php echo base_url(); ?>assets/public/css/cropper.min.css" rel="stylesheet">

        <!-- Important Owl stylesheet -->
        <link href="<?php echo base_url(); ?>assets/public/css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/owl.theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/chosen.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/ImageSelect.css" rel="stylesheet">


        <!--Date Picker -->               
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">


        <!--<script src="<?php echo base_url(); ?>assets/public/js/jquery-2.0.2.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-2.0.2.js" integrity="sha256-0u0HIBCKddsNUySLqONjMmWAZMQYlxTRbA8RfvtCAW0=" crossorigin="anonymous"></script>


        <!-- Google Font -->

        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/cropper.css">

