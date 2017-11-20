<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php echo base_url(); ?>assets/public/img/favicon-96x96.png" type="image/x-icon">
        <title><?php echo (isset($meta_title)) ? $meta_title : 'Leaguememe'; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : 'Leaguememse'; ?>"/>
        <meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : 'league of legends, league of legends builds, league of legends news, lol article, lol guides, champion builds, champion guides, league of legends strategy, lol strategy, league of legends champions, lol champions'; ?>"/>
        <meta name="author" content="leaguememe.com "/>
        <script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-30586739-2', 'auto'); ga('send', 'pageview'); </script>
        <?php
        $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?> 
        <?php
        if (isset($league_details[0]) && !empty($league_details[0])) {
            ?>         
            <meta property="og:description" content="Share and tag your friends who would understand this meme!" />
            <meta property="og:title" content="<?php echo $league_details[0]->leagueimage_name; ?>" />
            <meta property="og:url" content="<?php echo $actual_link; ?>" />
            <meta property="fb:app_id" content="852663711513838" /> 
            <!--<meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />-->
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:site" content="Leaguememes" />
            <meta name="twitter:title" content="<?php echo $league_details[0]->leagueimage_name; ?>" />
            <meta name="twitter:description" content="Entertainment legends" />
            <meta name="twitter:url" content="<?php echo $actual_link; ?>" />
            
            <?php
            $filename = $league_details[0]->leagueimage_filename;
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            if ($extention) {
                ?>        
                <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
               
                <meta name="twitter:image:src" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
                <?php
            } elseif (empty($league_details[0]->videoname)) {
                ?>
                <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
                
                <meta name="twitter:image:src" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
                <?php
            } else {
                ?>
                <meta property="og:video"             content="<?php echo base_url(); ?>uploads/league/mp4/<?php echo $league_details[0]->videoname; ?>" />
                <meta property="og:video:secure_url"  content="<?php echo base_url(); ?>uploads/league/mp4/<?php $league_details[0]->videoname; ?>" />
                <meta property="og:video:type"        content="video/mp4" />
                <meta property="og:video:width"       content="822" />
                <meta name="twitter:videp:src" content="<?php echo base_url(); ?>uploads/league/mp4/<?php echo $league_details[0]->videoname; ?>" />
                <?php
            }
        } else if (isset($patch_detail[0]) && !empty($patch_detail[0])) {
            $img_slider = explode(",", $patch_detail[0]->file);
            ?>
            <meta property="og:description" content="<?= $patch_detail[0]->patch_description ?>" />
            <meta property="og:title" content="<?php echo $patch_detail[0]->patch_name; ?>" />
            <meta property="og:url" content="<?php echo $actual_link; ?>" />
            <meta property="fb:app_id" content="852663711513838" />  
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:site" content="Leaguememe" />
            <meta name="twitter:title" content="<?php echo $patch_detail[0]->patch_name; ?>" />
            <meta name="twitter:description" content="<?= $patch_detail[0]->patch_description ?>" />
            <meta name="twitter:url" content="<?php echo $actual_link; ?>" />
            <?php
            foreach ($img_slider as $img) {
                if (!empty($img)) {
                    ?>
                    <meta property="og:image" content="<?= base_url() ?>uploads/patch_notes/<?= $img ?>" /> 
                  
                    <meta name="twitter:image:src" content="<?= base_url() ?>uploads/patch_notes/<?= $img ?>" />

                <?php } else {
                    ?>
                    <meta property="og:image" content="<?= base_url() ?>assets_new/public/img/img-1.png" />
                   
                    <meta name="twitter:image:src" content="<?= base_url() ?>assets_new/public/img/img-1.png" />
                    <?php
                }
            }
        } else {
            if (isset($share_img) && !empty($share_img)) {
                ?>
                <meta property="og:image" content="<?php echo base_url(); ?>uploads/articles/<?php echo $share_img; ?>" />
                <meta name="twitter:card" content="summary" />
                <meta name="twitter:site" content="Leaguememe" />
                <meta name="twitter:title" content="Leaguememe-League of Legends Entertainment" />
                <meta name="twitter:description" content="Entertainment legends" />
                <meta name="twitter:image:src" content="<?php echo base_url(); ?>uploads/articles/<?php echo $share_img; ?>" />
                <meta name="twitter:url" content="<?php echo $actual_link; ?>" />
                <?php
            }
            ?>
            <meta property = "og:description" content = "Entertainment legends" />
            <meta property = "og:title" content = "Leaguememe - League of Legends Entertainment" />
            <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
            <?php
        }
        ?>
        <?php $new_url = "http://league.local/"; ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var new_base_url = '<?php echo $new_url; ?>';
        </script>

        <link href="<?php echo $new_url ?>assets_new/public/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles --> 
        <link href="<?php echo $new_url; ?>assets_new/public/css/style.css" rel="stylesheet">
        <!--All css components-->
        <link href="<?php echo $new_url; ?>assets_new/public/css/components.css" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script  type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.6/select2.min.js"></script>
