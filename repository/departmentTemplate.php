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
             echo "Department";
        ?>
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body class="bg-secondary position-relative container-lg border p-3 overflow-auto">

    <div style="margin:auto" class="bg-white pb-1 rounded-sm">
        <h1 style="text-align: center"><?php
            if(isset($title))
                echo $title;
            else
                echo "Department";
            ?></h1>
    </div>

    <div class="d-flex flex-column justify-content-around">

            <?php
              $count =1;
              foreach($children as $child)
              {
                  echo '<div class="d-flex flex-row justify-content-around mt-2 border mt-2 pb-4 pt-4 rounded-sm bg-white">
                <form name="real-form" method="post" action="?update=participant" >

                    <div class="d-flex flex-row justify-content-between">
    
                        <div>'.$count.'. <b><input class="w-75 rounded-sm" type="text" name="update-name" value="'.$child->getName().'"> </b></div>

                        <div class="d-flex flex-column align-content-around ml-4">
                            <!--Text area input-->
                            <div class="form-group">
                                <label for="description-2">Description</label>
                                <textarea name="lol1" class="form-control" id="description-2" rows="3"></textarea>
                            </div>

                            <div>
                                <!--Image input -->
                                <div><input type="file" name="image" src="image-icon.png"></div>
                                <!--Submit button-->
                                <button type="submit" class="btn btn-success mt-1">Submit</button>
                            </div>
                        </div>

                    </div>

                </form>

                <div style="width: 20%;">
                    <h6>Image</h6>
                    <img src="\repository\image-icon.png" style="width: 100%; height:60%; min-width: 100px;">
                </div>

                <div>
                    <button type="button" class="btn btn-outline-dark delete-organization-button" style="margin-top: 210%;" data-id="'.$child->getId().'" data-name="'.$child->getName().'">X</button>
                </div>
            </div>';
                  $count++;
              }
            ?>

        </div>

</body>
</html>