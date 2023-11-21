<?php

    if ($_GET['city']){

        $cityStr = str_replace(' ','', $_GET['city']);
        $foreCastPage = file_get_contents("https://www.weather-forecast.com/locations/".$cityStr."/forecasts/latest");
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$cityStr."/forecasts/latest");
        
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $errorVar = '<p>City not found. Please check your spelling and try again.</p>';
        }

        else {
            $pageArray = explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content">', $foreCastPage);
            $weather = explode("</span></p></td>", $pageArray[1]);
        }

    }

?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Weather scraper.</title>

        <style type ="text/css">
            html { 
                background: url(bg.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                text-align:center;
                margin-left: 0%;
                }
            .container {
                text-align:center;
                margin-top: 150px;
                
            }

            body{
                background:none;
                
            }

            #successDiv{
                width: 350px;
                margin-top: 50px;
                text-align:center;
            }

            #errorDiv{
                width: 350px;
                margin-top: 50px;
                text-align:center;
            }

        </style>

    </head>

    <body>
        
        <div class='container'>

            <h1>Weather scraper</h1>
            
            <form>

                <div class="form-group">
                    <label for="cityID">Enter the city name below:</label>
                    <input name="city" type="text" class="form-control" id="cityID" aria-describedby="emailHelp" placeholder="eg. London, Durban, Johannesburg, etc." value = "<?php echo $_GET['city']; ?>">
                    <small id="emailHelp" class="form-text text">Enter the city name, then hit search.</small>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>

            </form>
            
        </div>

        <div id='weatherID'>
            <?php
                if ($weather) {
                    echo '<div class="alert alert-success container" role="alert" id="successDiv">'.
                    'The weather for, '.$_GET['city']. ' is: ' .$weather[0].
                    '</div>';
                }

                if($errorVar != ""){
                    echo '<div class="alert alert-danger container" role="alert" id="errorDiv">'.
                    $errorVar.
                    '</div>';
                }

                if(!$_GET['city']){

                }
            ?>
        </div>
        

        <!-- Optional JavaSript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
        <script type="text/javascript">

                $("form").submit(function(){
                    if(errorVar == ""){
                        return false;
                    }
                    }else{
                        return true;
                    }
                });


        </script>
    
    </body>

</html>
