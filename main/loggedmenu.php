<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link REL="SHORTCUT ICON" HREF="../css/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/loggedmenu.css" rel="stylesheet" type="text/css" />
<script src="../tools/jquery/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../tools/skinnytip_v2.0/skinnytip.js"></script>

<?php
	session_start();
	$_SESSION['title'] = "test test ppfinder.gr";

	echo "<title>$_SESSION[title]</title>";
?>

<div id="skinnytipDIV" style="position:absolute; visibility:hidden; z-index:10000;"></div>
</head>

<body onload="SKINNYTIP_captureMouse();">

<?php
	require_once ("chklog.php");

	if ($logged) {
        require_once ("dbconnect.php");
        require_once ("utility.php");
?>

<script type="application/javascript">
    $(document).ready(function(){
        OnSelectCategory();
    });

    function OnSave() {
        chkState = 0;
        if ($(readCHK).is(":checked"))
            chkState = 1;

        $.ajax({
            type: "POST",
            url: "actionmng.php?action=4",
            data: {
                id: $(titleSEL).val(),
                chkbox: chkState,
                comments: $(commentsTA).val()
            },
            dataType: "text",
            success: function(result){
                if (result != "1")
                    alert("Error in updating data");
            },
            error: function() {
                alert("An error occurred while inserting the bookmark.");
            }
        });
    }

    function OnVisit(url) {
        var win = window.open(url, '_blank');
        if (win)
            win.focus();
        else
            alert('Please allow popups for this website');
    }

    function OnDelete() {
        if (confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                type: "POST",
                url: "actionmng.php?action=5",
                data: {
                    id: $(titleSEL).val()
                },
                dataType: "text",
                success: function (result) {
                    if (result != "1")
                        alert("Error in deleting data");
                    else
                    {
                        $(controlsDIV).fadeOut("slow");
                        OnSelectCategory();
                    }
                },
                error: function () {
                    alert("An error occurred while inserting the bookmark.");
                }
            });
        }
    }

    function OnSelectPaper() {

        $.ajax({
            type: "POST",
            url: "actionmng.php?action=3",
            data: {
                id: $(titleSEL).val()
            },
            dataType: "text",
            success: function(result){
                //alert(result);
                $(controlsDIV).html(result);
            },
            error: function() {
                alert("An error occurred while inserting the bookmark.");
            }
        });

        $(controlsDIV).fadeIn("slow");
    }

    function OnSelectCategory() {
        //$("#addBK0").attr("src","second.jpg");
        //$(bookmarksDIV).html("");

        $.ajax({
            type: "POST",
            url: "actionmng.php?action=2",
            data: {
                catid: $(catSEL).val()
            },
            dataType: "text",
            success: function(result){
                //alert(result);
                $(controlsDIV).fadeOut("slow");
                $(bookmarksDIV).html(result);
            },
            error: function() {
                alert("An error occurred while inserting the bookmark.");
            }
        });
    }

    function addBookmark(elem) {
        //alert(elem.data('venue'));
        //alert($(catSEL).val());

        $.ajax({
            type: "POST",
            url: "actionmng.php?action=1",
            data: {
                title: elem.data('title'),
                authors: elem.data('authors'),
                venue: elem.data('venue'),
                year: elem.data('year'),
                pages: elem.data('pages'),
                ee: elem.data('ee'),
                url: elem.data('url'),
                catid: $(catSEL).val()
            },
            dataType: "text",
            success: function(result){
                if (result == -1)
                    alert("Already exists in this category");
                OnSelectCategory();
            },
            error: function() {
                alert("An error occurred while inserting the bookmark.");
            }
        });
    }

    function performSearch() {
        $(resultsDIV).html("");
        $(resultsDIV).append("<img src='../skins/default/ajax-loader.gif'><br><br>");

        $.ajax({
            type: "GET",
            //url: "http://dblp.org/search/publ/api",
            url: "http://dblp.org/search/publ/api?q=" + $(queryINPUT).val(),
            dataType: "text",
            success: function(xml){
                $(resultsDIV).html("");

                xmlDoc = $.parseXML(xml);
                $xml = $(xmlDoc);

                hitCnt = 0;
                $(xml).find("hit").each(function () {
                    authors = "";
                    title = $(this).find("title").text();
                    year = $(this).find("year").text();
                    venue = $(this).find("venue").text();
                    pages = $(this).find("pages").text();

                    $(resultsDIV).append("<span class='authors'>");
                    $(this).find("author").each(function () {
                        authors = authors + $(this).text() + ' ';
                    });

                    $(resultsDIV).append(authors);
                    $(resultsDIV).append("</span><br>");

                    $(resultsDIV).append("<span class='title'>" + title + '</span><br>');
                    $(resultsDIV).append("<span class='other'>" + venue + ' ' + year + ' pages: ' + pages + '</span><br>');
                    $(resultsDIV).append("<img id='addBK" + hitCnt + "' src='../skins/default/btn_add3.png'><br><br>");

                    varname = '#addBK' + hitCnt;

                    $(varname).data('title', title);
                    $(varname).data('authors', authors);
                    $(varname).data('venue', venue);
                    $(varname).data('year', year);
                    $(varname).data('pages', pages);
                    $(varname).data('ee', $(this).find("ee").text());
                    $(varname).data('url', $(this).find("url").text());

                    $(varname).click(function () {
                        //alert($(this).data('year'));
                        addBookmark($(this));
                    });

                    hitCnt++;
                });
            },
            error: function() {
                alert("An error occurred while processing XML file.");
            }
        });
    }
</script>
<?php
    }
?>

<div class="MAINBOX" style="width: 400px; height: 110px">
    <br><span>SEARCH</span><br>
    <input type="text" id="queryINPUT" value="" size="52">
    <img src="<?php echo '../skins/default/btn_add.png' ?>" onclick="performSearch();" onMouseOver="return tooltip('AA', '', 'width:100,border:2,textcolor:#007700');" onMouseOut="return hideTip();">
</div>

<div class="MAINBOX" style="width: 400px; height: 300px; top: 130px">
    <div id="resultsDIV" style="overflow: scroll; position: relative; top: 5px; left: 5px; width: 380px; height: 290px">
    </div>
</div>

<div class="MAINBOX" style="width: 400px; height: 500px; left: 440px">
    <h3>My Papers</h3>
    Category<br>
<?php
    $res = mysqli_query($con, "SELECT * FROM category");

    echo "<select id='catSEL' onchange='OnSelectCategory();'>";
        while($row = mysqli_fetch_array($res))
        {
            $id = $row['id'];
            $cat = $row['category'];
            echo "<option value='$id'>$cat</option>";
        }
        echo "</select>";

    mysqli_close($con);
?>

    <br><br>Paper List

    <div id="bookmarksDIV" position: relative; top: 5px; left: 5px; width: 380px; height: 190px">
    </div>

    <div id="controlsDIV" style="display: none">
    </div>
</div>


</body>
</html>
