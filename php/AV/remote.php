<?php
    require_once '../conf.php';

    $where = "";
    $filterValue ="";
    if(isset($_POST["filterIndx"]) && isset($_POST["filterValue"]) )
    {
        $filterIndx = $_POST["filterIndx"];
        if(isValidColumn($filterIndx)==false){
            throw("invalid filter column");
        }
        $filterValue = $_POST["filterValue"];
        $where  = " where ".$filterIndx." like CONCAT('%', ?, '%')";
    }            
        
    $dbh = getDatabaseHandle();
    
    $sql = "Select sku,length,rate,size,path,cover,type,genre,comments,publish,query from ct ".
            $where.
            " order by sku";

    //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($filterValue));    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);    
?>
