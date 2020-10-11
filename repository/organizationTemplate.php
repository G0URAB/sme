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
    <style>
        html,body{
            width: 100%;
            height:100%;
        }
    </style>
    <title>
        <?php
         if(isset($title))
             echo $title;
         else
             echo "Business Process Modelling";
        ?>
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body class="bg-secondary position-relative">

    <div class="w-100 d-flex flex-row justify-content-between border">
        <a href="baseTemplate.php" type="button" class="btn btn-primary"><-Back</a>
        <button id="add-department-button" class="btn btn-success shadow-sm" type="button">Add department </button>
    </div>

    <div class="organization container bg-light rounded-sm border mt-5 p-2 w-50 position-relative" style="z-index: 1">
        <h1 style="text-align: center"><?php  echo $controller->parent->name ; ?></h1>
        <?php
        if($controller->getSegments()->children)
        {
            $departments = unserialize($controller->getSegments()->children);

            foreach ( $departments as $department)
            {
                echo '
                <a class="text-decoration-none text-dark" href='.$controller->getDepartmentTemplate().'?parent-id='. $department->getId().'&organization-id='.$parentId.'>
                    <div class="department mt-2 p-1 border rounded-sm shadow-sm">
                        <h3>'.$department->getName().'</h3>
                        <ul>';

                          foreach ($department->getChildren() as $child) {
                              echo '
                            <li>
                               ' . $child->getName() . '
                            </li>';
                          }
                           echo '
                        </ul>
                    </div>
                </a>';
            }
        }
        ?>
    </div>

    <div class="p-3 bg-warning rounded-sm w-50 position-absolute shadow-sm" style="z-index: 100; top:10%; left:20%; display: none" id="add-department-div">
        <form method="post" action="?create=department">

            <div class="col-auto">
                <label class="sr-only" for="Department">Department</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Department name  </div>
                    </div>
                    <input type="text" class="form-control" id="department" name="department" required autofocus autocomplete="off">
                </div>
            </div>
            <input type="hidden" name="parent-id" value="<?php echo $parentId; ?>">
            <div class="d-flex flex-column align-content-center mb-4">
                <button type="button" class="btn btn-info w-50 rounded-lg" id="add-participants-button">+ Add participants</button>
                <div id="participants" class="d-flex flex-column p-3">

                </div>

            </div>
            <div class="d-flex flex-row justify-content-center">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-dark ml-4" type="button" id="cancel-department-button">Cancel </button>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="\jquery-3.5.1.min.js"></script>
    <script>
        let participantTemplate = (counter) => `
        <div id="participant-${counter}" class="d-flex flex-row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon--${counter}">Participant </span>
                </div>
                <input type="text" class="form-control" required aria-label="Participant" aria-describedby="basic-addon1" name="participants[]" id="participant-${counter}">
            </div>
            <button type="button" class="btn btn-outline-dark ml-2 delete-participant-button h-25" data-counter="${counter}">X</button>
        </div>
        `;
        let counter = 1;
        $("#add-participants-button").on("click",function () {

            $("#participants").append(participantTemplate(counter));
            counter++;
        });
        $("#participants").on("click",".delete-participant-button",function () {
            $("#participant-"+$(this).data("counter")).remove();
        });

        $("#add-department-button").on("click",function () {
            $("body").children().not("#add-department-div").css({
                "opacity": "0.1",
                "pointer-events": "none",
            });
            $("#add-department-div").css({
                "display": "block",
                "z-index": "100",
                "left":"10%"
            });
            $("#department").focus();
        });
        $("#cancel-department-button").on("click",function () {
            $("body").children().not("#add-department-div").css({
                "opacity": "1",
                "pointer-events": "auto",
            });
            $("#add-department-div").css({
                "display": "none",
            });
        });

    </script>

</body>
</html>