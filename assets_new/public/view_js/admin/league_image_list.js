function delete_league_img(league_img_id) {

    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "leaguelist/deleteleague_img",
            data: "league_img_id=" + league_img_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function active_league(league_id, league_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "leaguelist/update_status",
            data: "league_id=" + league_id + "&league_status=" + league_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function active_credit(credit_id, credit_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "leaguelist/active_credit",
            data: "credit_id=" + credit_id + "&credit_status=" + credit_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function popular_league(league_id, league_popular_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "leaguelist/popular_status",
            data: "league_id=" + league_id + "&popular_status=" + league_popular_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}


$('#list_league').dataTable({
    "aoColumns": [
        {"mData": "DT_RowId"},
        {"mData": "meme_name"},
        {"mData": "category_name"},
        {"mData": "credit"},
        {"mData": "meme_image"},
        {"mData": "action"}
    ],
    // set the initial value
    "bLengthChange": false,
    "bStateSave": true,
    "iDisplayLength": 10,
    "bDestroy": true,
    "aaSorting": [],
    "bProcessing": true,
    "bServerSide": true,
    "sServerMethod": "POST",
    "sAjaxSource": base_url + 'league-list-table',
    "aLengthMenu": [
        [10, 20, 30, -1],
        [10, 20, 30, "All"] // change per page values here
    ],
    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
    "sPaginationType": "full_numbers",
    "oLanguage": {
        "sLengthMenu": "_MENU_ records per page",
        "oPaginate": {
            "sPrevious": " <p>Prev </p>",
            "sNext": " <p> Next </p>"
        }
    },
    "aoColumnDefs": [
        {"bSortable": false, "aTargets": [0]},
        {"bSortable": true, "aTargets": [1]},
        {"bSortable": false, "aTargets": [2]},
        {"bSortable": true, "aTargets": [3]},
        {"bSortable": true, "aTargets": [4]},
        {"bSortable": false, "aTargets": [5]}
    ]
});