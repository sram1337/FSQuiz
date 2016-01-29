<!DOCTYPE html>
<html>
<head>
    <title>Lojistic | Developer Challenge</title>
    <link rel="icon" type="image/png" href="https://www.lojistic.com/favicon.png"/>
    <link rel="shortcut icon" type="image/png" href="https://www.lojistic.com/favicon.png"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.13/vue.min.js"></script>
    <style>
        div.panel {
            font-size: 14px;
            color: black;
            min-height: inherit;
        }
    
        .table-topless > tr {
            border-top 0;
        }

        .row {
            display: table;
        }

        [class*="col-"] {
            float: none;
            display: table-cell;
            vertical-align: top;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="col-xs-12 col-sm-5 brand pull-left">
            <b>Lojistic</b> | Developer Challenge
        </div>
        <div class="col-xs-12 col-sm-7 pull-right">
            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a href="/">Instructions</a></li>
                <li role="presentation"><a href="/job-openings">Job Openings</a></li>
                <li role="presentation"><a href="/applicants">Applicants</a></li>
            </ul>
        </div>
    </div>
</nav>
<section>
    <div class="container">
        <a id="instructions"></a>
        <h1>{{ $title }}</h1>
        <div class="row row-eq-height">
            <div class="col-lg-3" id="createPanel">
                <div class="panel panel-default">
                    <div class='panel-body'>
                        <h4>Create New {{ $title }}</h4>
                        <br>
                        <form method='post'>
                        <?php
                            foreach($cols as $col){
                                echo "<div class='form-group'>";
                                $colTitle = $colTitles[array_search($col, $cols)];
                                echo "<label for='$col'>$colTitle</label>";
                                //If this column starts with 'is_' turn 1/0 into 'Yes'/'No'
                                if(preg_match("/^is_/", $col)){
                                    echo "<select class='form-control' name='$col'>",
                                         "<option value='1'>Yes</option>",
                                         "<option value='0'>No</option>",
                                         "</select>";
                                }elseif(preg_match("/_(at|date)$/", $col)){
                                    echo "<input type='datetime-local' class='form-control' name='$col'>";
                                //If this column is a foreign key, instead load foreign value instead of id
                                }elseif( in_array($col, $foreignKeys) ){
                                    echo "<select class='form-control' name='$col'>";
                                    foreach(array_keys((array)$foreignKeyToIdToValue[$col]) as $foreignId){
                                        //echo var_dump($foreignKeyToIdToValue[$col]);
                                        $foreignIdToValue = $foreignKeyToIdToValue[$col];
                                        $foreignValue = $foreignIdToValue[$foreignId];
                                        echo "<option value='$foreignId'>$foreignValue</option>";
                                    }
                                    echo "</select>";
                                }else{
                                    echo "<input type='text' class='form-control' name='$col'>";
                                }
                                echo "</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary pull-right">Save</button> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9" id="tablePanel">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Existing {{ $title }}</h4>
                        <br>
                        <table class="table table-topless">
                            <tbody>
                            <?php
                                echo "<tr>";
                                foreach( $colTitles as $colTitle){
                                    echo "<th>" . $colTitle . "</th>";//"<td>$attr</td>";
                                }
                                echo "<th>        </th><th>      </th>";
                                echo "</tr>";
                                foreach( $entries->toArray() as $entry){
                                    $id = $entry['id'];
                                    //Set up this enrty's display row
                                    echo "<tr class='display' id='display$id'>";
                                    foreach($cols as $col){
                                        echo "<td>";
                                        
                                        //If this column starts with 'is_' turn 1/0 into 'Yes'/'No'
                                        if(preg_match("/^is_/", $col)){
                                            echo $entry[$col]?"Yes":"No";
                                        //If this column is a foreign key, instead load foreign value instead of id
                                        }elseif( in_array($col, $foreignKeys) ){
                                            //dd($foreignKeyToIdToValue);
                                            echo $foreignKeyToIdToValue[$col][$entry[$col]];
                                        }else{
                                            echo $entry[$col];//"<td>$attr</td>";
                                        }
                                        echo "</td>";
                                    }
                                    echo "<td><button type='submit' form='delete' class='btn btn-danger' name='id' value='$id'>Delete</td>",
                                         "<td><button class='btn btn-success' onclick='edit($id)'>Edit</td>";
                                    echo "</tr>";

                                    //Set up this enrty's editting row
                                    echo "<tr class='edit' id='edit$id' hidden>";
                                    foreach($cols as $col){
                                        echo "<td>";

                                        //If this column starts with 'is_' turn 1/0 into 'Yes'/'No'
                                        if(preg_match("/^is_/", $col)){
                                            echo "<select form='update' class='form-control' name='$col' placeholder='", $entry[$col]?"1":"0"."'>",
                                                 "<option value='1'>Yes</option>",
                                                 "<option value='0'>No</option>",
                                                 "</select>";
                                        }elseif(preg_match("/_(at|date)$/", $col)){
                                            echo "<input form='update' type='datetime-local' class='form-control' name='$col' placeholder='".str_replace(" ","T", $entry[$col])."'>";
                                        //If this column is a foreign key, instead load foreign value instead of id
                                        }elseif( in_array($col, $foreignKeys) ){
                                            echo "<select form='update' class='form-control' name='$col' placeholder='".$foreignKeyToIdToValue[$col][$entry[$col]]."'>";
                                            foreach(array_keys((array)$foreignKeyToIdToValue[$col]) as $foreignId){
                                                //echo var_dump($foreignKeyToIdToValue[$col]);
                                                $foreignIdToValue = $foreignKeyToIdToValue[$col];
                                                $foreignValue = $foreignIdToValue[$foreignId];
                                                echo "<option value='$foreignId'>$foreignValue</option>";
                                            }
                                            echo "</select>";
                                        }else{
                                            echo "<input form='update' type='text' class='form-control' name='$col' placeholder='".$entry[$col]."'>";
                                        }
                                        echo "</td>";
                                    }
                                    $id = $entry['id'];
                                    echo "<td><button type='submit' form='update' class='btn btn-primary' name='id' value='$id'>Save</td>",
                                        "<td><button class='btn btn-primary' onclick='cancel($id)'>Cancel</td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form id='delete' action='{{$name}}/delete' method='post'></form>
<form id='update' action='{{$name}}/update' method='post'></form>
</body>
<script>
    function edit(id){
        $("tr.edit").toggle(false); //Hide all editting rows
        $("tr.display").toggle(true); //Show all static table row;
        $("tr#display"+id).toggle(false); //Hide this static table row
        $("tr#edit"+id).toggle(true); //Show this editting row
        $("#createPanel").toggle(false); //Hide creatingPanel
        $("#tablePanel").toggleClass("col-lg-12", true); //take full screen
        $("#tablePanel").toggleClass("col-lg-9", false);
    }
    function cancel(id){
        $("tr#edit"+id).toggle(false); //Hide this editting row
        $("tr#display"+id).toggle(true); //Show this static table row
        $("#tablePanel").toggleClass("col-lg-9", true); //Restore split screen
        $("#tablePanel").toggleClass("col-lg-12", false);
        $("#createPanel").toggle(true); //Show creatingPanel
    }
</script>
</html>
