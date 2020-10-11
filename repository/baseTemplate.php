<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
         if(isset($title)){
             echo $title;
         }
         else
             echo "Business Process Modelling";
        ?>
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body class="bg-secondary">

    <div class="organization container bg-light rounded-sm border mt-5 p-2 w-50">
        <div style="display: flex; flex-direction: row; justify-content: center">
            <button id="add-organization-button" class="btn-primary rounded-sm">Add Organization </button>
        </div>
        <div class="mt-3 rounded-sm">
            <ul>

                <?php
                  if($controller->getSegments()){
                      foreach($controller->getSegments() as $organization) {
                          echo '
                           <li>
                             <div style="display: flex; flex-direction: row; justify-content: space-between; padding: 1% 1%">
                                 <h3>
                                     <a class="text-decoration-none" href='.$controller->getOrganizationTemplate().'?parent-id='.$organization->id.'>'.$organization->name.'</a> 
                                 </h3>
                                 <div class="d-flex flex-row"> 
                                     <button type="button" class="btn btn-outline-dark update-organization-button" data-id="'.$organization->id.'" data-name="'.$organization->name.'">Edit</button>
                                     <button type="button" class="btn btn-outline-dark delete-organization-button ml-1" data-id="'.$organization->id.'" data-name="'.$organization->name.'">X</button>
                                 </div>
                            </div>
                             
                           </li>
                        ';
                      }
                  }
                  ?>

            </ul>
        </div>
    </div>

    <div class="p-3 bg-info rounded-sm w-50" id="add-organization-div" style="display: none; position:absolute;">
        <form method="post" action="?create=organization">
            <div class="form-group">
                <label for="organisation">Organisation Name </label>
                <input type="text" class="form-control" id="organization" autocomplete="off" name="organization" required autofocus>
                <button class="btn btn-success" type="submit">Save</button>
                <button class="btn btn-dark" type="button" id="cancel-button">Cancel</button>
            </div>
        </form>
    </div>

    <div class="p-3 bg-info rounded-sm w-50" id="update-organization-div" style="display: none; position:absolute;">
        <form method="post" action="?update=organization">
            <div class="form-group">
                <label for="organisation">Update Organisation Name</label>
                <input type="text" class="form-control" id="update-name" autocomplete="off" name="update-name" required autofocus>
                <input type="hidden" name="id" id="hidden-id">
                <button class="btn btn-success" type="submit">Save</button>
                <button class="btn btn-dark" type="button" id="update-cancel-button">Cancel</button>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="\jquery-3.5.1.min.js"></script>
    <script>
        $("#add-organization-button").on("click",function () {
            $("body").children().not("#add-organization-div").css({
                "opacity": "0.1",
                "pointer-events": "none",
            });
            $("#add-organization-div").css({
                "display": "block",
                "z-index": "100",
                "margin-left":"25%"
            });
            $("#organization").focus();
        });
        $("#cancel-button").on("click",function () {
            $("body").children().not("#add-organization-div").css({
                "opacity": "1",
                "pointer-events": "auto",
            });
            $("#add-organization-div").css({
                "display": "none",
            });
        });

        $(".update-organization-button").on("click",function () {
            $("body").children().not("#update-organization-div").css({
                "opacity": "0.1",
                "pointer-events": "none",
            });
            $("#update-organization-div").css({
                "display": "block",
                "z-index": "100",
                "margin-left":"25%"
            });
            $("#update-name").focus();
            $("#update-name").val($(this).data("name"));
            $("#hidden-id").val($(this).data("id"));
        });
        $("#update-cancel-button").on("click",function () {
            $("body").children().not("#update-organization-div").css({
                "opacity": "1",
                "pointer-events": "auto",
            });
            $("#update-organization-div").css({
                "display": "none",
            });
        });

        $(".delete-organization-button").on("click",function () {
            var organization = $(this).data("name");
            if(confirm("Are you sure? "+ organization+ " will be deleted."))
            {
                let form = document.createElement("FORM");
                form.method = "POST";
                form.action="?delete=organization";
                document.body.appendChild(form);

                let input_id = document.createElement("INPUT");
                input_id.setAttribute("type","hidden");
                input_id.setAttribute("name","id");
                input_id.setAttribute("value",$(this).data("id"));

                form.appendChild(input_id);
                form.submit();
            }
        });
    </script>
</body>
</html>