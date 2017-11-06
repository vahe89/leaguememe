$(document);
var anime = $('#orderid').val();
function loadEvent($action) {
    $.ajax({
        url: base_url + 'public/event/' + $action,
        success: function(data, textStatus, jqXHR) {
            $("#event #event_data").html(data);
        }
    })
}

function loadNews($tab) {

    $.ajax({
        url: base_url + 'public/news/newsList',
        data: {
            row: 0, rowperpage: 5,
            main: $tab
        },
        type: 'POST',
        dataType: 'HTML',
        beforeSend: function(xhr) {
            $("#popular-news").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
        },
        success: function(data, textStatus, jqXHR) {
            $("#news-outer #popular-news").html(data);
            var allcount = Number($('#article_total_groups').val());
            if (5 >= allcount) {
                // Change the text and background
                $('.load-more-articleslist').hide();
            } else {
                $('.load-more-articleslist').show();
                $(".load-more-articleslist").text("Load More");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#popular-news").html('<div style="text-align: center; padding-top: 80px">Error while loading discussion.</div>');
        }
    })
}
$('.load-more-articleslist').click(function() {
    var row = Number($('#article_row').val());
    var allcount = Number($('#article_total_groups').val());
    var article_tab = $('#article_status').val();
    var rowperpage = 5;
    row = row + rowperpage;

    if (row <= allcount) {
        $("#article_row").val(row);

        $.ajax({
            url: base_url + 'public/news/newsList',
            type: 'post',
            data: {row: row, rowperpage: rowperpage, main: article_tab},
            beforeSend: function() {
                $(".load-more-articleslist").text("Loading...");
            },
            success: function(response) {

                $(".popular-news:last").after(response).show().fadeIn("slow");
                var rowno = row + rowperpage;
                if (rowno > allcount) {

                    $('.load-more-articleslist').hide();
                } else {
                    $('.load-more-articleslist').show();
                    $(".load-more-articleslist").text("Load more");

                }

            }
        });
    } else {
        $('.load-more-articleslist').show();
        $('.load-more-articleslist').text("Loading...");

        $("#article_row").val(0);

        $('.load-more-articleslist').text("Load more");



    }

});
$(document).ready(function() {
    var gamemainTab = $('#gamemainTabval').val();
    if (gamemainTab == 'gamenew') {
        $('#' + gamemainTab).parent().addClass('active');
    } else {

        $('#gamepopular').parent().addClass('active');
    }
    var gamesubTabValue = $('#gamesubTabval').val();
    var mainTab = $('#mainTabval').val();
    if (mainTab == 'new') {
        $('#' + mainTab).parent().addClass('active');
    } else {

        $('#popular').parent().addClass('active');
    }
    var subTabs;
    var gamesubTabs;
    var subTabValue = $('#subTabval').val();
    var track_load = 1; //total loaded record group(s)
    var season_track_load = 1;
    var loading = false; //to prevents multipal ajax loads
    var total_groups; //total record group(s)
    var season_total_groups;
    var anime = $('#orderid').val();
    var page_track = $('#pagetrackid').val();
    var discNew = false;
    var discPop = "popular";
    var discFav = false;
    var $activeTab = "Leaguememe";
    var lastActivedisctab = "new";
    var lastActivenewstab = "new";
    var limit = 250;
    var limitdsc = 350;
    var lim = 150;
    var text_remaining;

    $(".back-image").click(function() {
        $(".inline_upload").slideDown();
        $('.inline_image_upload').slideUp();
    })
    $('#inline_tag1').on('click', '.rem', function() {
        $(this).parent().remove();
        var variable = $('#inline_tag1').text().replace(/\s\s+/g, ' ');

        $("#inline_tag2").text($.trim(variable));
    });
    $('#inline_upload_title').keyup(function(event) {
        var text_length = $('#inline_upload_title').val().length;
        text_remaining = limit - text_length;

        if ($('#inline_upload_title').val().length == 150) {
            event.preventDefault();
        } else if ($('#inline_upload_title').val().length > 150) {
            // Maximum exceeded
            this.value = this.value.substring(0, 150);
        }
        if (text_remaining == 150) {
            $("#inline_anime_count").html('150');
        } else {
            if (text_remaining >= 0)
                $("#inline_anime_count").html(text_remaining);
            else if (text_remaining === 0) {
                $("#inline_anime_count").html(text_remaining);
                $("#inline_anime_count").css('color', 'red');
            }
        }
    });

    $("#back-to-category").click(function() {
        $(".inline-pick-category").slideDown();
        $(".inline_pick_anime").slideUp();
    })
    /* Inline Add Picture ovver*/
    /***************************/

    $("#index-main-tab li").click(function() {
        $activeTab = $(this).find("a").text();
        if ($(this).find("a").text() == "Discussion") {
            $(".inline-disc-btn").show();
            $(".inline-league-btn, .inline-event-btn,.inline-gamechat-btn,.inline-poll-btn").hide();
            $('.discussionBack').hide();
            $('.discussionThread').show();
            loadDisc(lastActivedisctab);
        }
        else if ($(this).find("a").text() == "News") {
            $(".inline-disc-btn,.inline-league-btn,.inline-event-btn,.inline-gamechat-btn,.inline-poll-btn").hide();
            loadNews(lastActivenewstab);
        }
        else if ($(this).find("a").text() == "Leaguememe") {
            $(".inline-disc-btn, .inline-event-btn,.inline-gamechat-btn,.inline-poll-btn").hide();
            $('.onePieceThread').show();
            $('.onePieceBack').hide();
            $(".inline-league-btn").show();
        }
        else if ($(this).find("a").text() == "Event") {
            $(".inline-disc-btn, .inline-league-btn,.inline-gamechat-btn,.inline-poll-btn").hide();
            $(".inline-event-btn").show();
            loadEvent("");
        } else if ($(this).find("a").text() == "Gamechat") {
            $(".inline-disc-btn, .inline-league-btn,.inline-event-btn,.inline-poll-btn").hide();
            $(".inline-gamechat-btn").show();
            $('.gamechatBack').hide();
            $('.gamechatThread').show();

            game_league(gamemainTab, gamesubTabValue);

        } else if ($(this).find("a").text() == "Poll") {
            $(".inline-disc-btn, .inline-league-btn,.inline-gamechat-btn,.inline-event-btn").hide();
            $('.pollBack').hide();
            $(".inline-poll-btn").show();
            $('.pollThread').show();
            loadpoll();
        }

        if ($(this).find("a").attr('data-id') == 'league_drop') {
            if ($(this).find("a").attr('data-sid') == 'season_old') {
                $activeTab = "season_old";
            }
            else {
                $('#moment').find('ul').show();
                $activeTab = "Leaguememe";
            }
            $(".inline-disc-btn, .inline-event-btn,.inline-gamechat-btn,.inline-poll-btn").hide();
            $('.onePieceThread').show();
            $('.onePieceBack').hide();
            $(".inline-league-btn").show();
            $('.nav-tabs a[href="#moment"]').tab('show');
            $(this).find("a").attr("data-toggle", "dropdown");
            $(this).find("a").removeAttr("href");
        } else {
            $('#league_drop').attr("href", '#moment');
            $('#league_drop').attr("data-toggle", "tab");
            $('#league_drop').parent('li').removeClass('open');
            // $('.nav-tabs a[href="#moment"]').attr("data-toggle", "tab");
            //$(this).find("a").removeAttr("href");
        }
        $('.sidebar').removeClass('affix');
        $('.sidebar').removeAttr("style");
        $('.sidebar').removeClass('scroll-to-fixed-fixed');
    });
    $(document).on("submit", "form#event-form", function(event) {
        event.preventDefault();
        input = document.getElementById('event_file');
        var data = new FormData($("form#event-form")[0]);

        $.ajax({
            url: base_url + "public/event/create",
            type: 'POST',
            dataType: 'JSON',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(xhr) {
                $("#event-form-msg").hide();
                $("#event-form-msg").removeClass("alert-success");
                $("#event-form-msg").removeClass("alert-danger");
            },
            success: function(data, textStatus, jqXHR) {
                $("#event-form-msg").slideDown();
                if (data.status) {
                    $("#event-form-msg").addClass("alert-success");
                    $("#event-form-msg").html("Event successfully created.");
                }
                else {
                    $("#event-form-msg").addClass("alert-danger");
                    $("#event-form-msg").html(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#event-form-msg").addClass("alert-danger");
            }
        })

    })
    $("#disc-tabs li").click(function() {
        lastActivedisctab = $(this).data("name");
        loadDisc($(this).data("name"));
    })
    $("#news-tabs li").click(function() {
        lastActivenewstab = $(this).data("name");
        $('#article_status').val(lastActivenewstab);
        loadNews($(this).data("name"));
    })
    $(document).on("click", "span.disc-credit-show", function(e) {
        if ($(this).text() == "Credit") {
            $(this).text($(this).data("credit"));
            $(this).next("a").show();
        }
        else {
            $(this).text("Credit");
            $(this).next("a").hide();
        }
    })
    $(document).keyup(function(e) {

        if (e.which === 27) { // escape key maps to keycode `27`
            $(".cpylink").hide();
        }
    });
    list_league(mainTab, subTabValue);
    $('#freshVal').text("All");

    $.ajax({
        type: "POST",
        url: base_url + 'public/home/get_sub_tab_data',
        success: function(msg) {
            $('#subTabData').html(msg);
        }
    });
//    $.ajax({
//        type: "POST",
//        data: {type: "gamechat"},
//        url: base_url + 'public/home/get_sub_tab_data',
//        success: function(msg) {
//            $('#gamesubTabData').html(msg);
//        }
//    });
    $('.tabs').each(function() {
        var data = $(this).children().attr('id');
        $('#' + data).click(function() {
            mainTab = $(this).attr('id');
            list_league(mainTab, subTabValue);
        });
    });
    $('.gametabs').each(function() {
        var data = $(this).children().attr('id');
        $('#' + data).click(function() {
            gamemainTab = $(this).attr('id');
            if (gamemainTab == "gamepopular") {
                gamemainTab = "popular";
            } else if (gamemainTab == "gamenew") {
                gamemainTab = "new";
            } else if (gamemainTab == "gamebookmarks") {
                gamemainTab = "bookmarks";
            } else {
                gamemainTab = "popular";
            }
            game_league(gamemainTab, gamesubTabValue);
        });
    });

    setTimeout(function() {
        $(".cpylink").hide();
        $('.subTab').each(function() {
            var subids = $(this).children().attr('id');
            var subclass = $('#' + subids).attr('class');
            if (subclass == "active") {
                subTabs = subids;
                subTabValue = $('#' + subids).parent().attr('id');
            }
            $('#' + subids).bind('click', function() {
                $('#' + subTabs).removeClass('active');
                $('#' + subTabs).parent().removeClass('active');
                $(this).addClass('active');
                $(this).parent().addClass('active');
                subTabs = subids;
                subTabValue = $('#' + subids).parent().attr('id');
                $('#freshVal').text($(this).text());
                $('#subfreshVal').text($(this).text());
                list_league(mainTab, subTabValue);
            });
        });
        $('.game_subTab').each(function() {
            var gamesubids = $(this).children().attr('id');
            gamesubids = gamesubids.split("_");

            var gamesubclass = $('#game_' + gamesubids[1]).attr('class');
            if (gamesubclass == "active") {
                gamesubTabs = gamesubids[1];
                gamesubTabValue = $('#game_' + gamesubids[1]).parent().attr('id');
                gamesubTabValue = gamesubTabValue.split("_");
                gamesubTabValue = gamesubTabValue[1];
            }
            $('#game_' + gamesubids[1]).bind('click', function() {
                $('#game_' + gamesubTabs).removeClass('active');
                $('#game_' + gamesubTabs).parent().removeClass('active');
                $(this).addClass('active');
                $(this).parent().addClass('active');
                gamesubTabs = gamesubids[1];
                gamesubTabValue = $('#game_' + gamesubids[1]).parent().attr('id');
                gamesubTabValue = gamesubTabValue.split("_");
                gamesubTabValue = gamesubTabValue[1];
                $('#gamefreshVal').text($(this).text());
                game_league(gamemainTab, gamesubTabValue);
            });
        });
        $('.js-textareacopybtn').each(function() {
            var id = $(this).attr('id');

            $('#' + id).bind('click', function(e) {
                var leagueid = id.split('_');
                var selectorid = "#copytext_" + leagueid[1];
                var copyTextarea = document.querySelector(selectorid);
                $(selectorid).show();
                copyTextarea.select();
                try {
                    var successful = document.execCommand('copy');
                    $('#copy_user_msg').show(1000);
                    $('#copy_user_msg').hide(10000);
                } catch (err) {
                    //console.log('Oops, unable to copy');
                }
//                    $('#copytext_' + leagueid[1]).css({top: 100, 'z-index': '100', 'left': 180});

            });

        });
    }, 7000);
    $(window).scroll(function() { //detect page scroll
        $('.js-textareacopybtn').each(function() {
            var id = $(this).attr('id');
            $('#' + id).bind('click', function() {
                var leagueid = id.split('_');
                var selectorid = "#copytext_" + leagueid[1];
                $(selectorid).show();
                var copyTextarea = document.querySelector(selectorid);
                copyTextarea.select();
                try {
                    var successful = document.execCommand('copy');
                    $('#copy_user_msg').show(1000);
                    $('#copy_user_msg').hide(1000);
                } catch (err) {
                    //         console.log('Oops, unable to copy');
                }

            });
        });
        $('.js-aricletextareacopybtn').each(function() {
            var id = $(this).attr('id');
            $('#' + id).bind('click', function() {
                var articleid = id.split('_');
                var selectorid = "#articlecopytext_" + articleid[1];
                $(selectorid).show();
                var copyTextarea = document.querySelector(selectorid);
                copyTextarea.select();
                try {
                    var successful = document.execCommand('copy');
//                    $('#copy_user_msg').show(1000);
//                    $('#copy_user_msg').hide(1000);
                } catch (err) {
                    //         console.log('Oops, unable to copy');
                }

            });
        });

        if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
        {
            if (track_load <= total_groups && loading == false && $activeTab == "Leaguememe") //there's more data to load
            {

                var anime_name = $('#anime_name').val();
                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/leaguelist/list_scroll_data',
                    data: {group_no: page_track, main: mainTab, sub: subTabValue, anime_name: anime_name},
                    success: function(msg) {
                        $('#league_list_home').append(msg);
                        $('.animation_image').hide(); //hide loading image once data is received
                        track_load++; //loaded group increment  
                        page_track++;

                        if (page_track == total_groups) {
                            loading = true;
                            $("#morefun").hide();
                        } else
                        if (track_load == 2) {
                            loading = true;

                            $("#pagetrackid").attr("value", page_track);
                            $("#mainTabval").attr("value", mainTab);
                            $("#subTabval").attr("value", subTabValue);
                            var anime = page_track * 10;
                            $("#morefun1").attr("action", base_url + 'home/' + anime);
                            $("#morefun").show();
                        } else {
                            loading = false;
                        }
                    }
                });
            }
            if (season_track_load <= $('.season_total_groups').val() && loading == false && $activeTab == "season_old") //there's more data to load
            {

                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/leaguelist/season_old',
                    data: {group_no: season_track_load},
                    beforeSend: function() {
                        $('.animation_image').show();
                    },
                    success: function(data) {
                        $('#league_list_home').append(data);
                        $('.animation_image').hide(); //hide loading image once data is received
                        season_track_load++; //loaded group increment   

                        if (season_track_load == $('.season_total_groups').val()) {
                            loading = true;
                        } else {
                            loading = false;
                        }
                    }
                });
            }
            if (track_load <= total_groups && loading == false && $activeTab == "Gamechat") //there's more data to load
            {

                var anime_name = $('#gameanime_name').val();
                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/leaguelist/list_scroll_data',
                    data: {group_no: page_track, main: mainTab, sub: subTabValue, anime_name: anime_name, upload_type: "2"},
                    success: function(msg) {
                        $('#gameleague_list_home').append(msg);
                        $('.animation_image').hide(); //hide loading image once data is received
                        track_load++; //loaded group increment  
                        page_track++;

                        if (page_track == total_groups) {
                            loading = true;
                            $("#gamemorefun").hide();
//                        } else
//                        if (track_load == 10) {
//                            loading = true;
//
//                            $("#gamepagetrackid").attr("value", page_track);
//                            $("#gamemainTabval").attr("value", mainTab);
//                            $("#gamesubTabval").attr("value", subTabValue);
//                            var anime = page_track * 10;
//                            $("#gamemorefun1").attr("action", base_url + 'home/' + anime);
//                            $("#gamemorefun").show();
                        } else {
                            loading = false;
                        }
                    }
                });
            }
        }
    });
    function game_league(mainTab, subTabValue) {
        var anime_name = $('#gameanime_name').val();

        $.ajax({
            type: "POST",
            url: base_url + 'public/leaguelist/list_league/' + anime,
            data: {main: mainTab, sub: subTabValue, anime_name: anime_name, upload_type: "2"},
            beforeSend: function() {
                $('#gameanimation_image').slideDown();
            },
            success: function(msg) {
                $('html, body').animate({scrollTop: $("#body_id").offset().top - 90}, "slow");
                track_load = 1;

                $('#gameanimation_image').slideUp();
                $('#gameleague_list_home').html(msg);
                total_groups = $('.total_groups').val();
            }
        });
    }

    /*****************************************************/
    /***************Inline album upload start ************/


    var limit = 150;
    var text_remaining;
    $(document).on('keyup', '.title_count', function() {
        var str = $(this).attr('id');
        var idd = str.split("_");
        var id = idd[1];
        var text_length = document.getElementById('titl_' + id).value.length;
        text_remaining = limit - text_length;
        if (text_remaining == 150) {
            document.getElementById('tit' + id).innerHTML = '<span>150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('tit' + id).innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('tit' + id).innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });

    $('#inline_albumtag1').on('click', '.albumrem', function() {
        $(this).parent().remove();
        var variable = $('#inline_albumtag1').text().replace(/\s\s+/g, ' ');
        $("#inline_albumtag2").text($.trim(variable));
    });

    var alubmlimit = 150;
    var albumtext_remaining;
    var max = 150;
    $('#inline_main_title').keyup(function(event) {
        var text_length = $('#inline_main_title').val().length;
        //                            alert(text_length);
        albumtext_remaining = alubmlimit - text_length;
        if ($('#inline_main_title').val().length == max) {
            e.preventDefault();
        } else if ($('#inline_main_title').val().length > max) {
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
        if (albumtext_remaining == 150) {
            $("#inline_albumanime_count").html('<span>150</span>');
        } else {
            if (albumtext_remaining >= 0)
                $("#inline_albumanime_count").html('<span>' + albumtext_remaining + '</span>');
            else if (albumtext_remaining === 0) {

                $("#inline_albumanime_count").html('<span><font color=red>' + albumtext_remaining + '</font></span>');
            }
        }
    });
    $("#inline_albumform").submit(function(event) {
        event.preventDefault();



        var category = $("#inline_category_list_album .pic_category:checked").val();
        var tag = $("#inline_albumtag2").val();
        var main_title = $("#inline_main_title").val();
        var credit = $('#inline_album_author').val();
        var author = $('#inline_album_credit').val();
        var notsafe = 0;
        var spolier = 0;
        var spolier_val = 1;
        if ($("#inline_spoiler").is(':checked'))
            spolier = 1;
        if ($("#inline_not_safe").is(':checked')) {
            notsafe = 1;
        }
        if ($("#inline_credit_check").is(':checked')) {
            var credit_author = 1;
        } else {
            var credit_author = 0;
        }

        $.ajax({type: "POST",
            url: base_url + "public/home/add_albumdata",
            data: {data: $(this).serialize(),
                credit_author: credit_author,
                author: author,
                credit: credit,
                main_title: main_title,
                spolier: spolier,
                spolier_val: spolier_val,
                'category': category,
                tag: tag,
                notsafe: notsafe,
            },
            dataType: 'json',
            success: function(data) {
                if (data.result == "success") {
                    $.ajax({
                        url: base_url + 'public/home/last_save_album_image',
                        type: 'POST',
                        data: {
                            data: $('#inline_albumform').serialize(),
                            credit_author: credit_author,
                            author: author,
                            credit: credit,
                            main_title: main_title,
                            spolier: spolier,
                            spolier_val: spolier_val,
                            'category': category,
                            tag: tag,
                            notsafe: notsafe,
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.result == "success") {
                                $("#inline_anime_alert_album").slideUp();
                                $(".inline_album_upload").slideUp();
                                $(".inline_upload").slideDown();
                                $("#inline-upload-success").show().text("Album successfully uploaded.");
                                $("#inline_album_alert").hide();
                            } else if (data.result == "error") {
                                $("#inline_album_alert").show();
                                $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                            }
                        }
                    });
                } else if (data.result == "error") {
                    window.parent.scrollTo(0, 0);
                    $('#uploadOnePiece').animate({scrollTop: 0}, 'fast');
                    $("#inline_album_alert").show();
                    $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                }
            }});
    });
    $("#inline_back-album").click(function() {
        $(".inline_album_upload").slideUp();
        $(".inline_upload").slideDown();
    })
    $("#back-to-category-album").click(function() {
        $(".inline-album-category").slideUp();
        $(".inline_album_upload").slideDown();
    })
    $("#back-to-album-cat").click(function() {
        $(".inline-album-category").slideDown();
        $(".inline_album_anime").slideUp();
    })
    $(".inline_choose-album, #add_more_inline_album").click(function() {
        $("#uploadinlinealbum").click();
//        $(".inline_album_upload").slideDown();
//        $(".inline_upload").slideUp();

    })


    function list_league(mainTab, subTabValue) {
        var anime_name = $('#anime_name').val();
        $('#league_drop').removeAttr('data-sid');
        $.ajax({
            type: "POST",
            url: base_url + 'public/leaguelist/list_league/' + anime,
            data: {main: mainTab, sub: subTabValue, anime_name: anime_name},
            beforeSend: function() {
                $('#animation_image').slideDown();
            },
            success: function(msg) {
                $('html, body').animate({scrollTop: $("#body_id").offset().top - 90}, "slow");
                track_load = 1;

                $('#animation_image').slideUp();
                $('#league_list_home').html(msg);
                total_groups = $('.total_groups').val();
            }
        });
    }
});

function handle_inline(e) {
    if (e.which === 32) {
        var x = $('#inline_tag').val();
        if (x !== " ") {
            $("#inline_tag1").append('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close rem"></i></a>');
            $("#inline_tag").val("");
            $("#inline_tag2").append(x);
        } else {
            $("#inline_tag").val("");
        }
    }
    return false;
}
function loadDisc($tab) {
    $.ajax({
        url: base_url + "public/animelist/discussion_list",
        data: {
            anime_name: 0,
            headerType: 1,
            main: $tab
        },
        type: 'POST',
        dataType: 'HTML',
        beforeSend: function(xhr) {
            $("#popular-discussion").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
        },
        success: function(data, textStatus, jqXHR) {
            $("#popular-discussion").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#popular-discussion").html('<div style="text-align: center; padding-top: 80px">Error while loading discussion.</div>');
        }
    })
}

function loadpoll() {
    $.ajax({
        url: base_url + "public/poll/poll-listing",
        data: {
        },
        type: 'POST',
        dataType: 'HTML',
        beforeSend: function(xhr) {
            $("#all-poll").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
        },
        success: function(data, textStatus, jqXHR) {
            $("#all-poll").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#all-poll").html('<div style="text-align: center; padding-top: 80px">Error while loading Poll list.</div>');
        }
    })
}
/*****************************************************/
/***************Inline image upload start ************/
function inline_back_image_load() {
    $('#inline_image_upload_error').slideUp();
    $('#inline_cat_alert').slideUp();
    $(".inline-pick-category").slideUp();
    $(".inline_image_upload").slideDown();
}

function inline_next_page() {

    var wordd = $("#inline_anime_count").text();
    var category = $("#inline_category_list li .pic_category:checked").val();

    var title = $("#inline_upload_title").val();
    var description = $("#upload_description").val();
    var image_name = $("#inline_anime_upload_image").val();
    var video_name = "";
    var tag = $("#inline_tag2").val();
    var author = $("#inline_author").val();
    var credit = $("#inline_credit").val();
    if ($("#inline_check1").is(':checked')) {
        var not_safe = 1;
    } else {
        var not_safe = 0;
    }
    if ($("#inline_check2").is(':checked')) {
        var spoiler = 1;
    } else {
        var spoiler = 0;
    }
    if ($("#author_credit_check").is(':checked')) {
        var credit_author = 1;
    } else {
        var credit_author = 0;
    }
    if (wordd > 0) {
        $.ajax({
            url: base_url + 'public/home/upload_image_next',
            type: 'POST',
            data: {
                'title': title,
                'description': description,
                'not_safe': not_safe,
                'credit_author': credit_author,
                'image_name': image_name,
                'video_name': video_name,
                'tag': tag,
                'author': author,
                'credit': credit,
                'category': category,
                'spoiler': spoiler,
            },
            dataType: 'json',
            success: function(data) {
                if (data.result == "success") {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: base_url + 'public/home/last_save_upload_image',
                        data: {
                            'title': title,
                            'description': description,
                            'not_safe': not_safe,
                            'credit_author': credit_author,
                            'image_name': image_name,
                            'video_name': video_name,
                            'tag': tag,
                            'author': author,
                            'credit': credit,
                            'category': category,
                            'spoiler': spoiler,
                        },
                        success: function(msg) {
                            if (msg.result == "success") {
                                $(".inline_image_upload").slideUp();
                                $(".inline_upload").slideDown();
                                $("#inline_image_upload_error").hide();
                                window.location.reload();
                            } else {
                                $("#inline_image_upload_error").show();
                                $("#inline_image_upload_error").html('<strong>' + data.msg + '</strong>');
                            }
                        }
                    });

                } else if (data.result == "error") {
                    window.parent.scrollTo(0, 0);
                    $('#uploadOnePiece').animate({scrollTop: 0}, 'fast');
                    $("#inline_image_upload_error").show();
                    $("#inline_image_upload_error").html('<strong>' + data.msg + '</strong>');
                }

            }
        });
    }
}

function author_link($lnk, $txtbox) {
    if ($lnk == "fb") {
        document.getElementById($txtbox).value = "http://facebook.com/";
    }
    if ($lnk == "tt") {
        document.getElementById($txtbox).value = "https://twitter.com/";
    }
    if ($lnk == "ig") {
        document.getElementById($txtbox).value = "https://www.instagram.com";
    }
}
/***************Inline image upload over ************/
/*****************************************************/
/*****************************************************/
/***************Inline album upload start ************/

$("#uploadinlinealbum").change(function() {
    var data = new FormData($('#inline_album_form')[0]);
    $.ajax({
        type: "POST",
        url: base_url + "public/home/file_upload",
        mimeType: "multipart/form-data",
        contentType: false,
        data: data,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
            $('.inline_waitalbum').show();
        },
        success: function(data) {
            if (data.result == "success") {
                $(".inline_album_upload").slideDown();
                $(".inline_upload").slideUp();
                $("#inline_album_alert").hide();
                $("#inline-album").hide();
                $('.inline_waitalbum').hide();

                var j = data.firstname;
                var k = j.split(",");
                var m = k.length;


                var l;
                for (l = 0; l < m; l++) {
                    parts = k[l].split(".");
                    loc = parts.pop();
                    if (loc != "" && (loc == "jpg" || loc == "jpeg" || loc == "gif" || loc == "png")) {
                        $('#inline_albumarea').append('<div class="panel panel-default bor-radius-0"  id="inline_rem' + k[l] + '" >' +
                                '<span class="delete-panel inline_remove_img" style="float:right;cursor: pointer"  id="iar_' + k[l] + '" ><i class="fa fa-times"></i></span>' +
                                '<div class="panel-body">' +
                                '<div class="panel-content col-md-12 no-padding">' +
                                '<a href="">' +
                                '<div class="img-panel">' +
                                '<img src="' + base_url + 'uploads/league/' + k[l] + '"> <input type="hidden"  name="img_' + k[l] + '" value="' + k[l] + '" > ' +
                                '</div>' +
                                '</a>' +
                                '<input type="text" placeholder="Title" class="title-img-upload title_count" name="' + k[l] + '" maxlength="150" id="titl_' + k[l] + '">' +
                                '<div class="pull-right count-right">' +
                                '<span id="tit' + k[l] + '">139</span>' +
                                '</div>' +
                                '<textarea placeholder="Describe your post with tags!"  id="inline_album_tag_' + k[l] + '" data-aid="' + k[l] + '" class="txt-area-tags inline_album_tag"  style="overflow: hidden; overflow-wrap: break-word; height: 48px;"></textarea>' +
                                '<div class="hastag-view-upload" id="inline_album_tag1_' + k[l] + '"></div>\n\
                                <textarea style="display: none" class="form-control desc" name= "album_tag' + k[l] + '" id="inline_album_tag2_' + k[l] + '" rows="2" ></textarea>\n\
                                </div>' +
                                '</div>' +
                                '<div class="wrap-filter-post">' +
                                '<input type="text" maxlength="250" name="desc_' + k[l] + '"  maxlength="150"  id="desr**' + k[l] + '"  class="textarea-resize desc_count" placeholder="Describe your post">' +
                                '<div class="count-right" >' +
                                '<span id="dese' + k[l] + '" >250</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>');

                    } else {
                        $("#inline_album_alert").show();
                        $("#inline_album_alert").append('<strong>Make sure valid file type . Not allowed .' + loc + ' file format</strong>');
                        $("#inline-album").show();
                        $("#inline-album").html('<strong>' + data.msg + '</strong>');
                    }
                }
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/home/get_image_upload_category',
                    data: {
                        type: 'in_album'
                    },
                    success: function(msg) {
                        $('#inline_category_list_album').html(msg);
                    }
                });

            } else if (data.result == "error") {
                $('.inline_waitalbum').hide();
                $("#inline_album_alert").show();

                $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                $("#inline-album").show();
                $("#inline-album").html('<strong>' + data.msg + '</strong>');
            }
        }
    });

});
$(document).on('keyup', '.inline_album_tag', function(e) {
    if (e.which === 32) {
        var id = $(this).data('aid');
        var x = document.getElementById("inline_album_tag_" + id).value;
        if (x != " ") {
            var div = document.getElementById("inline_album_tag1_" + id);
            div.innerHTML = div.innerHTML + ('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close inline_album_rem " data-inlineremid="' + id + '"></i></a>');
            document.getElementById("inline_album_tag_" + id).value = "";
            var tag_val = document.getElementById("inline_album_tag2_" + id);
            tag_val.value = tag_val.value + x;
        } else {
            document.getElementById("inline_album_tag_" + id).value = "";
        }

    }
    return false;
});
$(document).on('click', '.inline_album_rem', function() {
    var id = $(this).data('inlineremid');
    $(this).parent().remove();

    var html = document.getElementById("inline_album_tag1_" + id).innerHTML;
    var variable = document.getElementById("inline_album_tag2_" + id).value = html.replace(/<[^>]*>/g, "");
    var new_variable = variable.replace(/\s\s+/g, " ");
    document.getElementById("inline_album_tag2_" + id).value = (new_variable.trim());
});
$(document).on('click', '.inline_remove_img', function() {
    var str = $(this).attr('id');
    var id = str.split("_");
    document.getElementById('inline_rem' + id[1]).remove();
    $(this).remove();
});

$("#inline_gameform").submit(function(event) {
    event.preventDefault();
//    var category = $("#inline_category_gamechat_list .pic_category:checked").val();
    var splashart_model = $("#inline_splashart_model").val();
    var main_title = $("#inline_main_title_gamechat").val();
    $.ajax({type: "POST",
        url: base_url + "public/home/add_gamechatdata",
        data: {data: $(this).serialize(),
//            category: category,
            splashart_model: splashart_model,
            main_title: main_title
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == "success") {
                $("#inline_gamechat_alert").hide();
                window.location.reload();
            } else if (data.result == "error") {
                $('#uploadGamechat').animate({scrollTop: 0}, 'fast');
                $("#inline_gamechat_alert").show();
                $("#inline_gamechat_alert").html('<strong>' + data.msg + '</strong>');
            }
        }});
});
var lim = 150;
var text_remaining;
$(document).on('keyup', '#inline_main_title_gamechat', function() {


    var text_length = document.getElementById('inline_main_title_gamechat').value.length;
    text_remaining = lim - text_length;
    if (text_remaining == 150) {
        document.getElementById('inline_title_count_gamechat').innerHTML = '<span >150</span>';
    } else {
        if (text_remaining >= 0) {
            document.getElementById('inline_title_count_gamechat').innerHTML = '<span>' + text_remaining + '</span>';
        } else if (text_remaining < 0) {

            document.getElementById('inline_title_count_gamechat').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
        }
    }

});