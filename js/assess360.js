var Competency = function() {
    const saveCursorPosition = function(e) {
        document.documentElement.style.setProperty('--x', e.x);
        document.documentElement.style.setProperty('--y', e.y);
    }

    document.addEventListener('mousemove', e => { saveCursorPosition(e); })

    var ac = -1;
    var selectedGroupID = -1;
    var selectedCompetencyID = -1;
    var competencyTable = null;
    var componentTable = null;
    var frameworkTableColCount = 0;
    var frameworkTable = null;
    var frameworkTableObj = [];
    var editRowID = -1;
    var deleteRowId = -1;
    var exportForm = null;
    var excelForm = null;

    function changeCompetencyTable() {
        if (typeof competencyObj !== 'undefined') {
            var orderId = 9999;
            var data = [];
            var title = [];
            var actionButton = '<button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm addButton">&nbsp;&nbsp;<i class="material-icons">add</i>&nbsp;&nbsp;</button>';
            for (var id in competencyObj) {
                if (competencyObj.hasOwnProperty(id)) {
                    var competency = competencyObj[id];
                    var keyName = currentLang + "_name";
                    var name = decodeURIComponent(competency[keyName]);
                    var keyDefine = currentLang + "_desp";
                    var define = "";
                    if (typeof competency[keyDefine] !== 'undefined') {
                        define = decodeURIComponent(competency[keyDefine]);
                    }
                    if (name != "") {
                        if (selectedGroupID >= 0 && competency["parent"] == selectedGroupID) {
                            $("#competency-next-div").show();
                            $(".competency-table-competency-div").show();
                            data.push([competency["order_id"], (name + "<span>" + define + "</span>"), actionButton, id]);
                            title[id] = define;

                            if (selectedCompetencyID == -1 && competency["order_id"] < orderId) {
                                orderId = competency["order_id"];
                                selectedCompetencyID = id;
                            }
                        }
                    }
                }
            }

            if (competencyTable == null) {
                competencyTable = $('.competency-table-competency').DataTable({
                    data: data,
                    searching: false,
                    info: false,
                    scrollX: "100%",
                    scrollY: "50vh",
                    scrollCollapse: true,
                    iDisplayLength: -1,
                    rowReorder: false,
                    columnDefs: [
                        { orderable: true, targets: 0, visible: false },
                        { className: 'competency-name name', targets: 1 },
                        { className: 'text-center actionButton', targets: 2 },
                        { className: 'hideRowId', targets: 3 },
                        { orderable: false, targets: '_all' }
                    ],
                    language: {
                        "sEmptyTable": lang['general_table_no_data'],
                    }
                });
            } else {
                competencyTable.clear();
                competencyTable.rows.add(data);
                competencyTable.draw();
                competencyTable.columns.adjust();
            }

            if (selectedCompetencyID > -1) {
                $('.competency-table-competency tbody tr').find('td').each(function() {
                    if ($(this).hasClass("hideRowId") && $(this).html() == selectedCompetencyID) {
                        $(this).parent().addClass("table-row-highlight");
                        return false;
                    }
                });
            }

            changeComponentTable();
        }
    }

    function changeComponentTable() {
        if (typeof competencyObj !== 'undefined') {
            var data = [];
            var title = [];
            for (var id in competencyObj) {
                if (competencyObj.hasOwnProperty(id)) {
                    var competency = competencyObj[id];
                    var keyName = currentLang + "_name";
                    var name = decodeURIComponent(competency[keyName]);
                    var keyDefine = currentLang + "_desp";
                    var define = "";
                    if (typeof competency[keyDefine] !== 'undefined') {
                        define = decodeURIComponent(competency[keyDefine]);
                    }
                    if (name != "") {
                        if (selectedCompetencyID >= 0 && competency["parent"] == selectedCompetencyID) {
                            $("#competency-next-div2").show();
                            $(".competency-table-component-div").show();
                            data.push([competency["order_id"], (name + "<span>" + define + "</span>"), id]);
                            title[id] = define;
                        }
                    }
                }
            }

            if (componentTable == null) {
                componentTable = $('.competency-table-component').DataTable({
                    data: data,
                    searching: false,
                    info: false,
                    scrollX: "100%",
                    scrollY: "50vh",
                    scrollCollapse: true,
                    iDisplayLength: -1,
                    rowReorder: false,
                    columnDefs: [
                        { orderable: true, targets: 0, visible: false },
                        { className: 'competency-name name', targets: 1 },
                        { className: 'hideRowId', targets: 2 },
                        { orderable: false, targets: '_all' }
                    ],
                    language: {
                        "sEmptyTable": lang['general_table_no_data'],
                    }
                });
            } else {
                componentTable.clear();
                componentTable.rows.add(data);
                componentTable.draw();
                componentTable.columns.adjust();
            }
        }
    }

    function updateFrameworkTable() {
        var data = [];

        if (frameworkTableColCount == 0) {
            frameworkTableColCount = $(".competency-frm-table tr:first th").length;
        }

        for (var i = 0; i < frameworkTableObj.length; i++) {
            var tmp = [];
            tmp.push("");
            for (var j = 0; j < frameworkTableColCount - 3; j++) {
                if (j == 0) {
                    if (editRowID == i) {
                        var value = "";
                        if (frameworkTableObj[i][j] && frameworkTableObj[i][j].length > 0) {
                            value = frameworkTableObj[i][j][0];
                        }
                        var textfield = '<input type="text" class="positionName" value="' + value + '">';
                        tmp.push(textfield);
                    } else {
                        if (frameworkTableObj[i][j] && frameworkTableObj[i][j].length > 0) {
                            tmp.push(frameworkTableObj[i][j][0]);
                        } else {
                            tmp.push("");
                        }
                    }
                } else {
                    if (frameworkTableObj[i][j] && frameworkTableObj[i][j].length > 0) {
                        var value = "";
                        for (var k = 0; k < frameworkTableObj[i][j].length; k++) {
                            if (competencyObj[frameworkTableObj[i][j][k]]) {
                                var competency = competencyObj[frameworkTableObj[i][j][k]];
                                var keyName = currentLang + "_name";
                                var name = decodeURIComponent(competency[keyName]);
                                if (value != "") {
                                    // value += "<br>";
                                }
                                if (editRowID == i) {
                                    value += "<div class='nowrap'>&bull;&nbsp;" + name + "<button type='button' class='btn btn-primary btn-link btn-sm deleteButton' id='" + frameworkTableObj[i][j][k] + "'><i class='material-icons'>close</i></button></div>";
                                } else {
                                    value += "<div class='nowrap'>&bull;&nbsp;" + name + "</div>";
                                }
                            }
                        }
                        tmp.push(value);
                    } else {
                        tmp.push("");
                    }
                }
            }

            if (editRowID == i) {
                var button = '<div class="nowrap"><button type="button" class="btn btn-success btn-sm addButton competency-save-btn">' + lang['competency_framework_save'] + '</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-dark btn-sm addButton competency-cancel-btn">' + lang['competency_framework_cancel'] + '</button></div>';
                tmp.push(button);

            } else {
                var button = '<div class="nowrap"><button type="button" class="btn btn-primary btn-sm addButton competency-edit-btn">' + lang['competency_framework_edit'] + '</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-dark btn-sm addButton competency-delete-btn" data-toggle="modal" data-target="#deleteModal">' + lang['competency_framework_delete'] + '</button></div>';
                tmp.push(button);
            }

            if (frameworkTableObj[i][frameworkTableColCount] && frameworkTableObj[i][frameworkTableColCount].length > 0) {
                tmp.push(frameworkTableObj[i][frameworkTableColCount][0]);
            } else {
                tmp.push(-1);
            }

            data.push(tmp);
        }

        if (editRowID < 0) {
            var tmp = [];
            for (var i = 0; i < frameworkTableColCount - 2; i++) {
                if (i == 1 && editRowID >= 0) {
                    var textfield = '<input type="text" class="positionName">';
                    tmp.push(textfield);
                } else {
                    tmp.push("");
                }
            }
            var button = '';
            if (editRowID >= 0) {
                button = '<button type="button" class="btn btn-success btn-sm addButton competency-add-btn">' + lang['competency_framework_save'] + '</button>';
            } else {
                button = '<button type="button" class="btn btn-primary btn-sm addButton competency-add-btn">' + lang['competency_framework_add'] + '</button>';
            }
            tmp.push(button);
            tmp.push(-1);
            data.push(tmp);
        }

        if (frameworkTable == null) {
            var array = [];
            for (var i = 0; i < frameworkTableColCount - 1; i++) {
                if (i == 0) {
                    array[i] = { orderable: true, targets: i, visible: false };
                } else if (i == frameworkTableColCount - 2) {
                    array[i] = { className: 'text-center', targets: i };
                } else {
                    array[i] = { className: 'text-left', targets: i };
                }
            }
            array[frameworkTableColCount - 1] = { className: 'hideRowId', targets: (frameworkTableColCount - 1) };
            array[frameworkTableColCount] = { orderable: false, targets: '_all' };

            frameworkTable = $('.competency-frm-table').DataTable({
                data: data,
                searching: false,
                info: false,
                scrollX: "100%",
                scrollY: "50vh",
                scrollCollapse: true,
                iDisplayLength: -1,
                rowReorder: false,
                columnDefs: array,
                language: {
                    "sEmptyTable": lang['general_table_no_data'],
                }
            });
        } else {
            frameworkTable.clear();
            frameworkTable.rows.add(data);
            frameworkTable.draw();
            frameworkTable.columns.adjust();
        }
    }

    function getFrameworkTableData() {
        $.ajax({
            url: "assess360",
            data: {
                "ac": ac,
                "a": "getFramework",
            },
            method: "POST",
            success: function(response) {
                if (response.indexOf("<script>") >= 0) {
                    alert(lang['general_time_out']);
                    window.location = "logout";
                    return;
                }

                frameworkTableObj = JSON.parse(response);
                updateFrameworkTable();
            }
        });
    }

    jQuery(document).ready(function($) {
        ac = $("#ac").length > 0 ? $("#ac").val() : -1;

        getFrameworkTableData();

        if (typeof competencyObj !== 'undefined') {
            var data = [];
            var title = [];
            for (var id in competencyObj) {
                if (competencyObj.hasOwnProperty(id)) {
                    var competency = competencyObj[id];
                    var keyName = currentLang + "_name";
                    var name = decodeURIComponent(competency[keyName]);
                    var keyDefine = currentLang + "_desp";
                    var define = "";
                    if (typeof competency[keyDefine] !== 'undefined') {
                        define = decodeURIComponent(competency[keyDefine]);
                    }
                    if (name != "") {
                        // group table
                        if (competency["parent"] == -1) {
                            $(".dropdown-competency-group-menu").append('<li><a id="' + id + '">' + name + '</a></li>');
                            data.push([competency["order_id"], (name + "<span>" + define + "</span>"), id]);
                            title[id] = define;

                            if (selectedGroupID == -1 && competency["order_id"] == 0) {
                                selectedGroupID = id;
                            }
                        }
                    }
                }
            }

            if (data.length > 0) {
                $(".competency-table-group-div").show();
            }

            var groupTable = $('.competency-table-group').DataTable({
                data: data,
                searching: false,
                info: false,
                scrollX: "100%",
                scrollY: "50vh",
                scrollCollapse: true,
                iDisplayLength: -1,
                rowReorder: false,
                columnDefs: [
                    { orderable: true, targets: 0, visible: false },
                    { className: 'competency-name name', targets: 1 },
                    { className: 'hideRowId', targets: 2 },
                    { orderable: false, targets: '_all' }
                ],
                language: {
                    "sEmptyTable": lang['general_table_no_data'],
                }
            });

            if (selectedGroupID > -1) {
                $('.competency-table-group tbody tr').find('td').each(function() {
                    if ($(this).hasClass("hideRowId") && $(this).html() == selectedGroupID) {
                        $(this).parent().addClass("table-row-highlight");
                        return false;
                    }
                });
            }

            changeCompetencyTable();
        }

        $(".competency-table-group tr").click(function() {
            if ($(this).parent("tbody").is("tbody")) {
                $(".competency-table-group").find('tr').each(function() {
                    $(this).removeClass("table-row-highlight");
                });
                $(this).addClass("table-row-highlight");

                selectedGroupID = $(this)[0].lastChild.innerHTML;
                selectedCompetencyID = -1;
                changeCompetencyTable();
            }
        });

        $(".div-datatable-competency").on("click", ".competency-table-competency tr", function() {
            if ($(this).parent("tbody").is("tbody")) {
                $(".competency-table-competency").find('tr').each(function() {
                    $(this).removeClass("table-row-highlight");
                });
                $(this).addClass("table-row-highlight");

                selectedCompetencyID = $(this)[0].lastChild.innerHTML;
                changeComponentTable();
            }
        });

        $("body").on("click", ".competency-add-btn", function() {
            editRowID = $(this).parent().parent()[0].rowIndex - 1;
            if (!frameworkTableObj[editRowID]) {
                frameworkTableObj[editRowID] = [];
            }
            updateFrameworkTable();
            $(".competency-add-table").show();
        });

        $("body").on("click", ".competency-edit-btn", function() {
            editRowID = $(this).parent().parent().parent()[0].rowIndex - 1;
            if (!frameworkTableObj[editRowID]) {
                frameworkTableObj[editRowID] = [];
            }
            updateFrameworkTable();
            $(".competency-add-table").show();
        });

        $("body").on("click", ".competency-cancel-btn", function() {
            editRowID = -1;
            getFrameworkTableData();
            $(".competency-add-table").hide();
        });

        $("body").on("click", ".deleteButton", function() {
            if (editRowID >= 0 && frameworkTableObj[editRowID]) {
                var id = $(this).attr("id");
                for (var i = 1; i < frameworkTableColCount - 3; i++) {
                    if (frameworkTableObj[editRowID][i]) {
                        var index = frameworkTableObj[editRowID][i].indexOf(id);
                        if (index >= 0) {
                            frameworkTableObj[editRowID][i].splice(index, 1);
                            break;
                        }
                    }
                }
                updateFrameworkTable();
            }
        });

        $("body").on("click", ".competency-save-btn", function() {
            $(".competency-add-table").hide();

            if (editRowID >= 0 && frameworkTableObj[editRowID]) {
                var id = $(this).parent().parent().parent().find(".hideRowId").html();
                var obj = frameworkTableObj[editRowID];
                $.ajax({
                    url: "assess360",
                    data: {
                        "ac": ac,
                        "a": "addFramework",
                        "id": id,
                        "value": JSON.stringify(obj),
                    },
                    method: "POST",
                    success: function(response) {
                        if (response.indexOf("<script>") >= 0) {
                            alert(lang['general_time_out']);
                            window.location = "logout";
                            return;
                        }

                        editRowID = -1;
                        getFrameworkTableData();
                    }
                });
            }
        });

        $("body").on("click", ".competency-table-competency .addButton", function() {
            if (editRowID >= 0) {
                $(this).parent().parent().find('td').each(function() {
                    if ($(this).hasClass("hideRowId")) {
                        var id = $(this).html();
                        if (!frameworkTableObj[editRowID]) {
                            frameworkTableObj[editRowID] = [];
                        }
                        var i = 0;
                        $(".competency-frm-table tr:first th").each(function() {
                            var keyName = currentLang + "_name";
                            var name = decodeURIComponent(competencyObj[selectedGroupID][keyName]);
                            if ($(this).html() == name) {
                                if (!frameworkTableObj[editRowID][i]) {
                                    frameworkTableObj[editRowID][i] = [];
                                }
                                if (!frameworkTableObj[editRowID][i].includes(id)) {
                                    frameworkTableObj[editRowID][i].push(id);
                                }
                            }
                            i++;
                        });
                    }
                });
                updateFrameworkTable();
            }
        });

        $("body").on("change paste keyup", ".positionName", function() {
            if (editRowID >= 0) {
                if (!frameworkTableObj[editRowID]) {
                    frameworkTableObj[editRowID] = [];
                }
                frameworkTableObj[editRowID][0] = [$(this).val()];
            }
        });

        $("body").on("click", ".competency-delete-btn", function() {
            deleteRowId = $(this).parent().parent().parent().find(".hideRowId").html();
        });

        $("#deleteModal").on("click", ".confirm-delete", function() {
            if (deleteRowId >= 0) {
                $.ajax({
                    url: "assess360",
                    data: {
                        "ac": ac,
                        "a": "deleteFramework",
                        "id": deleteRowId,
                    },
                    method: "POST",

                    success: function(response) {
                        if (response.indexOf("<script>") >= 0) {
                            alert(lang['general_time_out']);
                            window.location = "logout";
                            return;
                        }

                        getFrameworkTableData();
                        deleteRowId = -1;
                    }
                });
            }
        });

        $("body").on("click", ".excel", function() {
            if (!excelForm) {
                excelForm = document.createElement('form');
                excelForm.style.visibility = 'hidden';
                excelForm.method = 'POST';
                excelForm.action = 'competency';

                var typeInput = document.createElement('input');
                typeInput.name = "a";
                typeInput.value = "excel";
                excelForm.appendChild(typeInput);

                document.body.appendChild(excelForm);
            }
            excelForm.submit();
        });

        $("body").on("click", ".export", function() {
            if (!exportForm) {
                exportForm = document.createElement('form');
                exportForm.style.visibility = 'hidden';
                exportForm.method = 'POST';
                exportForm.action = 'competency';

                var typeInput = document.createElement('input');
                typeInput.name = "a";
                typeInput.value = "pdf";
                exportForm.appendChild(typeInput);

                document.body.appendChild(exportForm);
            }
            exportForm.submit();
        });

        $("#ac").change(function() {
            var form = document.createElement('form');
            form.style.visibility = 'hidden';
            form.method = 'POST';
            form.action = 'competency';

            var typeInput = document.createElement('input');
            typeInput.name = "ac";
            typeInput.value = $("#ac").val();
            form.appendChild(typeInput);

            document.body.appendChild(form);
            form.submit();
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $(".competency-add-table").hide();
    });
};

var Raterlist = function() {
    var rowcounter = 1

    $("body").on("click", ".raterlist-add-btn", function() {
        var table = document.getElementById("raterlisttable");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell3.colSpan = "2";            //adjust the size of columns to fit the table
        var cell4 = row.insertCell(3);
        cell4.colSpan = "2";
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);


        
        cell1.innerHTML = ""; // row counter is added to give every column a unique name to assist in the php form handling
        cell2.innerHTML = "";
        cell3.innerHTML = "";
        cell4.innerHTML = "";
        cell5.innerHTML = "<input type='text' name='rows[" + rowcounter +"][Rater-first-name]' style='width: 75px;'>";
        cell6.innerHTML = "<input type='text' name='rows[" + rowcounter +"][Rater-last-name]' style='width: 75px;'>";
        cell7.innerHTML = "<select name='rows[" + rowcounter +"][Roles]' id='roles' style='width: 95px; -webkit-appearance: menulist;'><option value='Focus' name='focus_role'>"+ lang["listofraters_role_focus"] +"</option><option value='manager' name='manager_role'>"+ lang["listofraters_role_manager"] +"</option><option value='colleague' name='colleague_role'>"+lang["listofraters_role_colleague"]+"</option><option value='direct-report' name='direct_report_role'>"+lang["listofraters_role_directreport"]+"</option><option value='Other' name='other_role'>"+lang["listofraters_role_other"]+"</option></select>";
        cell8.innerHTML = "<select name='rows[" + rowcounter +"][Genders]' id='genders' style='width: 80px; -webkit-appearance: menulist;'><option value='Male' name='male_gender'>"+ lang["listofraters_gender_male"] +"</option><option value='Female' name='female_gender'>"+ lang["listofraters_gender_female"] +"</option><option value='Other Gender' name='other_gender'>"+ lang["listofraters_gender_other"] +"</option></select>";
        cell9.innerHTML = "<input type='text' name='rows[" + rowcounter +"][position]' style='width: 75px;'>";
        cell10.innerHTML = "<input type='text' name='rows[" + rowcounter +"][email]' style='width: 80px;'>";
        cell11.innerHTML = "<button class='btn btn-dark btn-sm addButton raterlist-delete-btn'>"+lang["listofraters_delete_button"]+"</button>";
        rowcounter++;
    });


    $("body").on("click", ".raterlist-delete-btn", function() {
        // get the parent row of the clicked button
        var row = $(this).closest('tr');

        // check if the row is not the first row
        if (!row.is(':first-child')) {
        // delete the row
        row.remove();
        }
    });

    /*
      function activate_button(){
          confirm("Are you sure");
      }*/

    jQuery(document).ready(function($) {
        ac = $("#ac").length > 0 ? $("#ac").val() : -1;

        $("#ac").change(function() {
            var form = document.createElement('form');
            form.style.visibility = 'hidden';
            form.method = 'POST';
            form.action = 'competency';

            var typeInput = document.createElement('input');
            typeInput.name = "ac";
            typeInput.value = $("#ac").val();
            form.appendChild(typeInput);

            document.body.appendChild(form);
            form.submit();
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });
};

var Questionnaire = function() {
    jQuery(document).ready(function($) {
        ac = $("#ac").length > 0 ? $("#ac").val() : -1;

        $("#ac").change(function() {
            var form = document.createElement('form');
            form.style.visibility = 'hidden';
            form.method = 'POST';
            form.action = 'competency';

            var typeInput = document.createElement('input');
            typeInput.name = "ac";
            typeInput.value = $("#ac").val();
            form.appendChild(typeInput);

            document.body.appendChild(form);
            form.submit();
        });
        // hide all pages except the first one
        $('.questionnaire-page:not(:first)').hide();

        // listen for click events on the link
        $('a[href="#intro-page"]').click(function(event) {
            event.preventDefault(); // prevent the link from navigating to the target

            // hide the current page and show the target page
            $('#intro-page').show();
            $('#importance-of-competency-page').hide();
            $('#competency-statements-page').hide();
            $('#open-end-question-page').hide();
        });
        $('a[href="#importance-of-competency-page"]').click(function(event) {
            event.preventDefault(); // prevent the link from navigating to the target

            // hide the current page and show the target page
            $('#intro-page').hide();
            $('#importance-of-competency-page').show();
            $('#competency-statements-page').hide();
            $('#open-end-question-page').hide();
        });
        $('a[href="#competency-statements-page"]').click(function(event) {
            event.preventDefault(); // prevent the link from navigating to the target

            // hide the current page and show the target page
            $('#intro-page').hide();
            $('#importance-of-competency-page').hide();
            $('#competency-statements-page').show();
            $('#open-end-question-page').hide();
        });
        $('a[href="#open-end-question-page"]').click(function(event) {
            event.preventDefault(); // prevent the link from navigating to the target

            // hide the current page and show the target page
            $('#intro-page').hide();
            $('#importance-of-competency-page').hide();
            $('#competency-statements-page').hide();
            $('#open-end-question-page').show();
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });
};