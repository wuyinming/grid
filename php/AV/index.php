<?php
require_once '../include.php';
?>
<style>
div.pq-grid-toolbar-search { text-align: left; }
div.pq-grid-toolbar-search * { margin: 1px 5px 1px 0px; vertical-align: middle; }
div.pq-grid-toolbar-search .pq-separator { margin-left: 10px; margin-right: 10px; }
div.pq-grid-toolbar-search select { height: 18px; position: relative; }
div.pq-grid-toolbar-search input.pq-filter-txt { width: 180px; border: 1px solid #b5b8c8; height: 16px; padding: 0px 5px; }
div.pq-grid-title { text-align: center; }
td div.pq-td-div { height: 20px; overflow: hidden; line-height: 20px; padding: 0; text-align: center; }
</style>
<script class="ppjs">
$(function () {
    //var pqFilter = $.paramquery.pqFilter;
    var pqFilter = {
        search: function () {
            var txt = $("input.pq-filter-txt").val().toUpperCase(),
                dataIndx = $("select#pq-filter-select-column").val(),
                DM = $grid.pqGrid("option", "dataModel");
            DM.filterIndx = dataIndx;
            DM.filterValue = txt;
            $grid.pqGrid("refreshDataAndView");
        }
    }
    //define colModel
    var colM = [
		{ title: "SKU", width: 100, dataIndx: "sku", align: "center" },   
		{ title: "Length", width: 100, dataIndx: "length", align: "center" },  
		{ title: "Data Rate", width: 100, dataIndx: "rate", align: "center" },
		{ title: "Size", width: 100, dataIndx: "size", align: "center"},
		{ title: "Path", width: 100, dataIndx: "path", align: "center" },
		{ title: "Cover", width: 100, dataIndx: "cover", align: "center"},	
		{ title: "Type", width: 100,  dataIndx: "type", align: "center" },
		{ title: "Release Date", width: 130, dataIndx: "publish", align: "center"},
		{ title: "Genre", width: 200, dataIndx: "genre", align: "center" },       
		{ title: "Comments", width: 100, dataIndx: "comments", align: "center"},
		{ title: "Query", width: 100, dataIndx: "query", align: "center" }
	];
    //define dataModel
    var dataModel = {
        location: "remote",
        dataType: "JSON",
        method: "POST",
        paging: "local",
		rPP: 20,
        filterIndx: "",
        filterValue: "",
        getUrl: function () {
            var data = {};
            if (this.filterIndx && this.filterValue ) {
                  data['filterIndx']=this.filterIndx;
                  data['filterValue']=this.filterValue;
            }
            var obj = { url: "remote.php", data: data };
            //debugger;
            return obj;
        },
        getData: function (response) {
	alert(response);
            return { data: response };
        }
    }
    var obj = { width: 1280, height: 600,
        dataModel: dataModel,
        colModel: colM,
        editable: false,
        title: "Data Base Management System",
        topVisible: true,
        resizable: true,
        columnBorders: true,
        freezeCols: 1
    };
    //obj.render = pqFilter.pqgridrender;
    //append the filter toolbar in top section of grid
 
    obj.render = function (evt, obj) {
        var $toolbar = $("<div class='pq-grid-toolbar pq-grid-toolbar-search'></div>").appendTo($(".pq-grid-top", this));
 
        $("<span>Filter</span>").appendTo($toolbar);
 
        $("<input type='text' class='pq-filter-txt'/>").appendTo($toolbar)
            .change(function (evt) {            
                pqFilter.search();            
        });
 
        $("<select id='pq-filter-select-column'>\
        <option value='SKU'>SKU</option>\
        <option value='Genre'>Genre</option>\
        </select>").appendTo($toolbar)
           .change(function () {
            pqFilter.search();
        });
        $("<span class='pq-separator'></span>").appendTo($toolbar);
 
    };
    var $grid = $("#grid_php").pqGrid(obj);
});
</script>
</head>
<body>
<div id="grid_php" style="margin:5px auto;"></div>
</body>
</html>