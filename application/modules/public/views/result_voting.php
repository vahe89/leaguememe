<?php //  echo $poll_ans[0]['total_answer']; exit;?>

<script src="<?php echo base_url() ?>assets/public/js/jquery.progress.js"></script>
<style>
    div.background-cover {
        display: none;
    }
</style> 

<body style="background-color:#eee;" >
    <div class="container no-padding">
        <div class="single-panel" style="margin-top: 90px; margin-left: -1px;">
            <?php
            foreach ($result_voting as $poll_result) {
                $new_all_answer = array();
                $array = explode(",", $poll_result['answers']);
                $new_all_answer = $array;
                ?>
                <div class="row-custom">
                    <div class="col-md-12 no-padding">
                        <div class="title-section" style="margin-top: -10px;">
                            <span>Result Voting</span>
                            <a href="javascript:void(0);" class="btn btn-red btn-back-review" id="back">Back</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 no-padding">
                    <div class="question-result">
                        <?php echo $poll_result['questions'] ?>
                    </div>

                    <div class="item-result">
                        <?php
                        $i = 0;
                        if (isset($poll_vote)) {
                            $total_votes = 0;
                            for ($i = 0; $i < count($poll_vote); $i++) {
                                $ans = trim($poll_vote[$i]['answer']);
                                $key = array_search($ans, $new_all_answer);
                                ?>
                                <div class="choice-result">
                                    <?php echo $i + 1; ?>.&nbsp;<?php echo $poll_vote[$i]['answer']; ?>
                                </div>

                                <div class="wrapper-progress-bar">
                                    <svg id="container<?php echo $i + 1; ?>"></svg>                        
                                    <span><?php
                                        $vote = $poll_vote[$i]['total'];
                                        echo $vote . " Votes";
                                      $ans_tot_vote = $poll_ans[0]['total_answer'];
                                        ?> 
                                        <script type="text/javascript">
                                            var i = <?php echo $i + 1; ?>;
                                            var progress = <?php echo $vote; ?>;
                                            var total_ans_vote = <?php echo ($vote*100)/$ans_tot_vote; ?>;
                                            $("#container" + i).Progress({
                                                percent: total_ans_vote,
                                                width: 280,
                                                height: 30,
                                                fontSize: 16,
                                                barColor: ' #17ae97',
                                                backgroundColor: '#caddda',
                                                fontColor: '#f7f7f7'
                                            });
                                        </script>
                                    </span>
                                </div>

                                <?php
                                unset($new_all_answer[$key]);
                                ?>
                                <?php
                                $total_votes += isset($poll_vote[$i]['total']) ? $poll_vote[$i]['total'] : 0;
                            }
                        }
                        foreach ($new_all_answer as $un_vote) {
                            ?>
                            <div class="choice-result">
                                <?php echo $i + 1; ?>.&nbsp;<?php echo $un_vote; ?>
                            </div>
                            <div class="wrapper-progress-bar">
                                <svg id="container<?php echo $i + 1; ?>"></svg>                        
                                <span><?php
                                    echo "0 Votes";
                                    ?> 
                                    <script type="text/javascript">
                                            var i = <?php echo $i + 1; ?>;
                                            $("#container" + i).Progress({
                                                percent: 0,
                                                width: 280,
                                                height: 30,
                                                fontSize: 16,
                                                barColor: ' #17ae97',
                                                backgroundColor: '#caddda',
                                                fontColor: '#f7f7f7'
                                            });
                                        </script>
                                </span>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>

                <div class="total-result">
                    <span class="value-totat"><?php echo $total_votes; ?></span>
                    <span class="description-total">Total Votes</span>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 ads-view">
                <div class="box-center">
                    <?php
                    echo $this->load->view('template/right_sidebar');
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>                 



<script>
    $(document).on('click', '#back', function () {
        var id = <?php echo $this->uri->segment(2); ?>;
        window.location.href = base_url + 'poll-vote/' + id;
    });
</script>